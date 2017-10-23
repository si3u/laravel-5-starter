<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dropzone extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'dropzone';
	
	// DROPZONE
    static $rules = [];
    static $messages = [];
}
