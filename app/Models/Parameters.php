<?php

namespace App\Models;

use Titan\Models\TitanCMSModel;
//use Bpocallaghan\Sluggable\HasSlug;
//use Bpocallaghan\Sluggable\SlugOptions;// AJOUT pour création SLUG
use Illuminate\Database\Eloquent\SoftDeletes;
use Titan\Models\Traits\ActiveTrait;

class Parameters extends TitanCMSModel
{

    protected $table = 'parameters';

    protected $guarded = ['id'];
	
    /**
     * Validation rules for this model
     */
    static public $rules = [
		'keywords' => 'required|min:2',
    	'description' => 'required|between:40,200',
    	'horaires' => '',
		'logo' => 'image|max:800000|mimes:png',//jpg,jpeg,
		'favicon' => 'image|max:800000|mimes:png',//gif,
		'infos' => '',
		'socials' => '',
    ];
    
    /**
     * Get all the rows as an array (ready for dropdowns)
     *
     * @return array
     */
    public static function getAllList($param)
    {
    	return self::select('value', 'created_at', 'updated_at')->where('params', $param)->first();//->value;/*->pluck('value')->toArray()*/;
    }

}