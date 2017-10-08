<?php

namespace App\Http\Controllers\Admin\Settings\Admin;

use Redirect;
use App\Http\Requests;
use App\Models\Parameters;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

use Image;

// DES DOUBLES NOTIFICATIONS SONT POSSIBLES !!!
// grace aux modif dans :
//		une boucle pour chacun appelant $.notify() (js) dans resources/views/admin/vendor/notify/notify.blade.php
//		changer les ->flash()  par des  ->push()  dans /vendor/bpocallaghan/notify/src/Notify.php
// Voir /resources/assets/admin/js/titan/notify.js (appelée par la vue)
		

class ParametersController extends AdminController
{
	
	/**
	 * Tailles Minimales des images
	 * @var INT 
	 */
	private $sizeLogo	  = 300;
	private $sizeLogoMini = 120;
	private $sizeFavicon  = 152;
	
	
	/**
	 * Display a listing of parameters.
	 *
	 * @return Response
	 */
	public function index()
	{
		save_resource_url();
		
        return $this->view('settings.admin.parameters.index')
					->withKeywords	 ($this->getParams('keywords'))
					->withDescription($this->getParams('description'))
					->withHoraires	 ($this->getParams('horaires'))
					->withInfos		 ($this->getParams('infos'))
					->withSocials	 ($this->getParams('socials'))

					->withSizes([$this->sizeLogo, $this->sizeLogoMini, $this->sizeFavicon]); // envoie la variable $sizes à la vue !!
			
	}
	
	/**
	 * 
	 * @param STRING $param (keywords,...)
	 * @return OBJECT value param
	 */
	public function getParams($param)
	{
		$params = Parameters::getAllList($param);
		$params->value = json_decode($params->value);
		return $params;
	}

//-// UPDATE 
	
    /**
     * Update the specified faq in storage.
     * @param User    $user
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
    
    public function update($type, User $user, Request $request)
    {		
		$this->validate($request, [$type => Parameters::$rules[$type]]);
		
		// Autorisation
        if ($user->id > 2) {
            notify()->warning('Oops', 'Vous ne pouvez pas éditer ces paramètres.');
            return redirect_to_resource();
        }
		
		$this->type = $type;
	
		switch ($type)
		{
			case 'keywords':	$this->setBasic( strtolower(implode(',', $request->keywords)) ); break;	
			case 'description': $this->setBasic($request->description); break;
			case 'horaires':	$this->setHoraires($request); break;
			case 'logo':		$this->setLogo($request); break;
			case 'favicon':		$this->setFavicon($request); break;
			case 'infos':		$this->setJson($request); break;
			case 'socials':		$this->setJson($request); break;
		}
		
		if($this->result) {
			notify()->success('Succès', ucfirst($this->type) . ' mis à jour.');
		} else {
			notify()->error('Oops', 'Un problème est survenu à la mise à jour<br> de ' . ucfirst($this->type));
		}
		
        //event(new Parameters($row));
		
        return redirect_to_resource();
    } */
	/**
	 * Notifications after update parameter
	 * @param OBJECT $res
	 * @param STRING $type
	 
	private function notifications()
	{
		if($this->result) {
			notify()->success('Succès', ucfirst($this->type) . ' mis à jour.');
		} else {
			notify()->error('Oops', 'Un problème est survenu à la mise à jour<br> de ' . ucfirst($this->type));
		}

	}*/
	
	/**
     * Update the specified faq in storage.
     * @param User    $user
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($type, Parameters $parameters, Request $request)
    {
		$update = true;
			
		$request->validate(["$type" => Parameters::$rules[$type]]);

		if($type == 'logo') {
			$name = "logo_". str_slug(infos('societe'));
			$this->uploadPicture($request->file('logo'), $name);
			$update = false;
		}
		elseif($type == 'favicon') {
			$this->uploadPicture($request->file('favicon'), $type);
		}
		else {
			$input = $request->input($type);
		}

		if($update)
		{
			$parameters->id = $request->input('id'); // Modif dans CRUDNotify::updateEntry() pour accepter un id

			$value = [ 'value' => json_encode( !empty($input) ? $input : $request->except(['_token', 'id', '_method']) ) ];

			$this->updateEntry($parameters, $value);

		}
		notify()->info('&nbsp;', ucfirst($type) . ' modifié.');
		
        return redirect_to_resource();
    }
	
	
//-// GESTION IMAGES
	
    /**
     * Upload picture image
     *
     * @param        $file
     * @return string|void
     */
    private function uploadPicture($file, $name)
    {
       // $extension = $file->guessClientExtension();
        $filename = $name . '.png';// . $extension;
        $filenameMini = $name  . '-mini.png';//. $extension;
        $imageTmp = Image::make($file->getRealPath());

        if (!$imageTmp) { return notify()->error('Oops', 'Quelque chose ne va pas !', 'warning shake animated'); }

		if ($this->controlSizePictures($imageTmp->getWidth(), $name)) // controle des tailles minimales
		{
			if ($name == 'favicon') {
				$this->saveFavicon($name, $imageTmp);
			} else {
				$path = upload_path_images();

				// suppression de ceux du même jour...
				if (file_exists($path . $filename))		{ unlink($path . $filename); }
				if (file_exists($path . $filenameMini)) { unlink($path . $filenameMini); }

				// save logo
				$imageTmp->widen($this->sizeLogo)->save($path . $filename); // ratio largeur/hauteur pris en charge ( heighten() pour retailler sur la hauteur)
				// save mini logo
				$imageTmp->widen($this->sizeLogoMini)->save($path . $filenameMini);
			}
			return $filename;
			
		} else {
			notify()->warning('Oops', 'Les Dimensions minimales de l\'image fournie<br> ne correspondent pas aux recommendations.', 'warning shake animated');
		}
    }
	
	// Télécharge les favicons
	public function saveFavicon($name, $imageTmp)
	{
		$path = upload_path_images().'favicons/';
		// Toutes les tailles de favicon
		$sizes = ['16','32','57','64','72','114','120', $this->sizeFavicon]; // 152 le dernier..
		
		foreach ($sizes as $v) {
			$filename = "$name-$v.png";
			if(file_exists($path . $filename)) { unlink($path . $filename); }
			$imageTmp->fit($v, $v)->save($path . $filename); // on les force à la taille voulue
		}
		
		notify()->success('Succès', 'Le Favicon à été modifié.');
	}
	
	// Controle les tailles minimales des images fournis
	public function controlSizePictures($size, $type)
	{
//		if(strpos($type, 'logo') && $size < $this->sizeLogo) { return false; }
		if( preg_match('/logo/', $type) && $size < $this->sizeLogo) { return false; }
		elseif(($type == 'favicon') && $size < $this->sizeFavicon) { return false; }
		return true;
	}
	
}
