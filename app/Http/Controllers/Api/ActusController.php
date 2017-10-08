<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Models\Actus;
//use Illuminate\Support\Facades\File;

class ActusController extends ApiController
{
	
	/**
	 * Créer un dossier dans public/photos/shares/Actus/
	 * @param STRING $dir passée par Ajax Api
	 * @return notify
	 */
	public function createDirectory($dir = "0-inconnu")
	{
		$path = public_path().'/photos/shares/Actus/';
		
		if( ! is_dir($path . $dir) )
		{
			mkdir( $path . $dir, 0777 );
//			File::makeDirectory( $path . $dir, 0777, false, true);
			
			return "Dossier <b>$dir</b> créé dans :<br><br>$path";
		}
		return false;
	}
	
	
}