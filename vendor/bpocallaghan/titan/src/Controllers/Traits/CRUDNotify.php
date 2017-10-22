<?php

namespace Titan\Controllers\Traits;

use Illuminate\Http\Request;

trait CRUDNotify
{
    /**
     * Get Model class name, add space before all capital letters
     *
     * @param $model
     * @return mixed
     */
    private function formatModelName($model)
    {
		$strModel = preg_replace('/(?<!\ )[A-Z]/', ' $0', class_basename($model));
		
		$str = (preg_match('/user/i', $strModel))	 ? 'Utilisateur' : $strModel;
		$str = (preg_match('/param/i', $strModel))	 ? 'Paramètres'  : $strModel;
		$str = (preg_match('/actu/i', $strModel))	 ? 'Actualités'  : $strModel;
		$str = (preg_match('/article/i', $strModel)) ? 'Réalisations'  : $strModel;
		
		return ucfirst($str);
        //return preg_replace('/(?<!\ )[A-Z]/', ' $0', class_basename($model)); // ORIGINAL
    }

    /**
     * Create Entry
     *
     * @param $model
     * @param $inputs
     * @return mixed
     */
    public function createEntry($model, $inputs)
    {
		$inputs = fancyboxIntoContent($inputs); // view_helper.php // si besoin, ajoute liens fancybox à un lien contenant une image

        $row = $model::create($inputs);

        if ($row) {
            notify()->success('Succès', 'Un nouvel ' . $this->formatModelName($model) . ' a été créé.');
        }
        else {
            notify()->error('Oops', 'Quelque chose ne va pas !');
        }

        return $row;
    }

    /**
     * @param $model
     * @param $inputs
     * @return mixed
     */
    public function updateEntry($model, $inputs)
    {
		
		// AJOUT pour pouvoir modifier mots de passe depuis Profil
		if(!empty($inputs['password'])){
			$inputs['password'] = bcrypt($inputs['password']);
		}elseif (isset($inputs['password']) && empty($inputs['password'])) {
			unset($inputs['password']);
		}
		
		$inputs = fancyboxIntoContent($inputs); // view_helper.php

		unset($inputs['_token'], $inputs['_method']); // TODO voir pour enlever ça et se servir de   "_id"    encore...
	
		// UPDATE
		if(isset($model->id)) {
			$update = $model->where('id', $model->id)->update($inputs);
		} else {
			$update = $model->update($inputs);
		}
		
		if($update) {
			notify()->success('Succès', 'Le ' . $this->formatModelName($model) . ' a été mis à jour.');
		} else {
			notify()->error('Pardon', 'Un problème est survenu à la mise à jour de ' . $this->formatModelName($model));
		}

        return $model;
    }

    /**
     * @param         $model
     * @param Request $request
     */
    public function deleteEntry($model, Request $request)
    {
		// /!\ Pour pouvoir supprimer les entrées contenant des Tags (Laravel 5.5.14)
		// Il a fallu changer   ->lists()  par   ->pluck()   dans
		//   /estgroupe/laravel-taggable/src/Taggable.php   lignes: 105 et 116   @methods tagNames() et tagSlugs()
		
		
        // check if ids match (cant type random ids)
        if ($request->get('_id') == $model->id)
		{
            if ($model->delete() >= 1) {
                notify()->success('Succès',
                    'Le ' . $this->formatModelName($model) . ' a été supprimé');
            }
            else {
                notify()->error('Oops',
                    'Nous ne trouvons pas le ' . $this->formatModelName($model) . ' a supprimer.');
            }
        }
        else {
            notify()->error('Oops',
                'Le ' . $this->formatModelName($model) . ' id est introuvable.');
        }
    }
	
	
	
	/**
	 * Copy a Item
	 *  
	 * @param type $id
	 * @param Request $request
	 */
	public function duplicateEntry($id, $model)
	{
		$copy = $model->where('id', $id)->first();

		$title = $copy->title;

		if($copy)
		{
			unset($copy->id);
			$copy->title .= ' (copie)'; 
			
			$row = $model::create( $copy->toArray() );

			if ($row) {
				notify()->success('C\'est fait', "<b>$title</b> a été copiée.");
			}
			else {
				notify()->error('Oops', "Quelque chose c'est mal passé sur<br> la copie de <b>$title</b>");
			}
		}
        else {
            notify()->error('Oops', 'Le ' . $this->formatModelName($model) . ' ID est introuvable.');
        }
	}
	
	
	
	
	/**
	 * Force Delete Item or All
	 * @param OBJECT $model
	 * @param Request $request
	 */
	public function forceDeleteEntry($model, Request $request)
	{
		$id = !empty($request->get('_id')) ? $request->get('_id') : 0;

        if ($id != 0 )
		{
			$this->deleteDirMedias($id, $model);
			
			$model->onlyTrashed()->where('deleted_by', user()->id)->where('id', $id)->forceDelete();
			
			notify()->success('C\'est fait', $this->formatModelName($model) . ' (id:<b>'.$id.'</b>) supprimé définitivement.');
		}
		elseif($id == 0) { // Vidage de la corbeille

			$this->deleteDirMedias($id, $model);
		
			$model->where('deleted_by', '!=', NULL)->forceDelete();
			
            notify()->success('C\'est fait', 'Corbeille des '.$this->formatModelName($model, 's').' vidée.');
		}
        else {
            notify()->error('Oops', 'Le ' . $this->formatModelName($model) . ' ID est introuvable.');
        }
	}
	
	
	
	/**
	 * Delete One or Multiple directory images related
	 * Call by forceDestroy() since ActusController and ArticlesController
	 * 
	 * @param STR $type (ex: Actus ou Realisations)
	 * @param INT $id
	 */
	public function deleteDirMedias($id, $model)
	{
		if( ! preg_match("/article|actu/i", class_basename($model))) { return false; }
		
		$type = ( ! preg_match("/article/i", class_basename($model)) ) ? class_basename($model) : 'Realisations'; // transforme Arcticle en Realisations, c'est nul..	
		$folderName		 = config('lfm.images_folder_name'); // public/photos
		$folderShareName = config('lfm.shared_folder_name'); // public/photos/share
		$path = public_path("/$folderName/$folderShareName/$type/");
		
		$IDs = [$id];

		if ($id == 0) // SI Suppressions multiple
		{
			$IDs = $model->onlyTrashed()->select('id')->where('deleted_by', user()->id)->get();

			if( ! $IDs) { return false; }
		}
		
		if ( is_dir($path) )
		{
			$dir = scandir($path, 1); // ,1 : les .. et . sont en derniers dans le tableau

			foreach ($IDs as $id)
			{
				$id = ( ! is_object($IDs)) ? $id : $id->id; // si y en a plusieurs, c'est un objet..
		
				foreach ($dir as $k => $value) // chaque dossier dans $folderShareName
				{
					if($value == ".." || empty($value)) { return false; }
				
					if ( preg_match("/$id\_[A-Za-z0-9\-\_]+$/", $value) ) // Si il y a un dossier
					{
						$mimetypes = "/*.{jpg,jpeg,png,gif,svg,txt}";

						$images = glob($path . $value . $mimetypes, GLOB_BRACE);

						if( ! empty($images)) {
							foreach ($images as $img) { unlink($img); } // Suppression des images
						}

						$dirThumbs = "/".config('lfm.thumb_folder_name');
						$thumbs = glob($path . $value . $dirThumbs . $mimetypes, GLOB_BRACE);

						if( ! empty($thumbs)) {
							foreach ($thumbs as $tmb) { unlink($tmb); } // Suppression des miniatures
						}

						// les dossiers désormais vides, on les supprime
						if( is_dir($path . $value . $dirThumbs) ) {
							rmdir($path . $value . $dirThumbs); // Suppression du dossier des miniatures si il existe
						}
						rmdir($path . $value); // Suppression du dossier principal

						notify()->info('Médias supprimés :', "<b>$value</b>");
					}
				}			
			}
		}
	}
	
	
	/**
	 * Restore Item
	 * @param OBJECT $model
	 * @param Request $request
	 */
	public function restoreEntry($model, $id)
	{
		if($id)
		{
			$model->where('id', $id)->where('deleted_by', user()->id)->restore();
			$model->where('id', $id)->update(['deleted_by' => NULL]);
			
			notify()->success('C\'est fait', $this->formatModelName($model) . ' (id:<b>'.$id.'</b>) restaurée.');
		}
        else {
            notify()->error('Oops', 'Le ' . $this->formatModelName($model) . ' ID est introuvable.');
        }
	}
	
}
