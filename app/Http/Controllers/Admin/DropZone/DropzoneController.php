<?php

// DROPZONE

namespace App\Http\Controllers\Admin\DropZone;

use App\Http\Controllers\Controller;

use App\Logic\DropzoneRepository;
use Illuminate\Support\Facades\Input;

use File;
use App\Models\Dropzone;

class DropZoneController extends Controller
{
    protected $image;

    public function __construct(DropzoneRepository $Repository)
    {
        $this->image = new $Repository();
    }

    /*public function getUpload()
    {
        return view('pages.upload');
    }*/

    public function postUpload()
    {
        $image = Input::all();
        $response = $this->image->upload($image);
        return $response;

    }

    public function deleteUpload()
    {
        $filename = Input::get('id');

        if(!$filename) { return 0; }

        $response = $this->image->delete( $filename );

        return $response;
    }
	
	/**
	 * Vue dans Modal
	 */
    public function getServerImagesPage($type, $id)
    {
        return view('admin.partials.dropzone.upload')
				->withId($id)
				->withType($type);
    }
	
	
    public function getServerImages($type, $id)
    {
        $images = Dropzone::select('relation_id', 'relation_type', 'original_name', 'filename')
							->where('relation_type', $type)
							->where('relation_id', $id)
							->get();
		
        $imageAnswer = [];

        foreach ($images as $image) {
        	
        	if($image->relation_id == $id) // si celui voulu
			{
	            $imageAnswer[] = [
	                'original' => $image->original_name,
	                'server' => $image->filename,
	                'size' => File::size(config('dropzone.path_images') . config('dropzone.full_size') . $image->filename),
	            ];
			}
        }

        return response()->json([
            'images' => $imageAnswer,
        ]);
    }
	
	
}
