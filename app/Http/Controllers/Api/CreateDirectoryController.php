<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
//use Illuminate\Support\Facades\File;

class CreateDirectoryController extends ApiController
{
	
	/**
	 * Créer un dossier dans public/photos/shares/Actus/
	 * @param STRING $dir passée par Ajax Api
	 * @return notify
	 */
	public function create($type, $dir = "0-unknow")
	{
		$path = public_path().'/photos/shares/'.ucfirst($type).'/';
		
		if( ! is_dir($path . $dir) )
		{
			mkdir( $path . $dir, 0777 );
//			File::makeDirectory( $path . $dir, 0777, false, true);
			
			return "Dossier <b>$dir</b> créé dans :<br><br>$path";
		}
		return false;
	}
	
	
}