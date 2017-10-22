<?php

namespace App\Http\Controllers\Api;

use App\Models\Tag;
use EstGroupe\Taggable\Taggable;

use App\Models\Article;

class TagsController extends ApiController
{
	use Taggable;

	private $model;
	
	public function toggleStatus($model, $item_id, $tag_slug)
	{
		
		// /!\ Il a fallu commenter  dans   /estgroupe/laravel-taggable/src/Util.php  ligne:156
		//--> $str = app()->make(Pinyin::class)->permlink($str); // Problème avec permlink()
		// Rapport au langage Chinois...
		
		// /!\ Pour pouvoir supprimer les entrées contenant des Tags (Laravel 5.5.14)
		// Il a fallu changer   ->lists()  par   ->pluck()   dans
		//   /estgroupe/laravel-taggable/src/Taggable.php   lignes: 105 et 116   @methods tagNames() et tagSlugs()
		
		$this->model = "\\App\\Models\\$model";
		
		// vérification existence Tag Name
		$existingTags = Tag::all();
		if( ! in_array( $tag_slug, $existingTags->pluck('slug')->all() ) ) {
			return ["error", "Le Tag spécifié n'existe pas."];
		}
		
		
		$item = $this->model::with('tags')->where('id', $item_id)->first();
		
		if( in_array( $tag_slug, $item->tags->pluck('slug')->all() ) )
		{
			$item->untag($tag_slug);
			return ["success", "Tag $tag_slug <b>détaché</b> de $item->title"];
		}
		else
		{
			$item->tag($tag_slug);
			return ["success", "Tag $tag_slug <b>attaché</b> à $item->title"];
		}
	}
	
}