<?php

namespace App\Models;

use App\User;
use Titan\Models\TitanCMSModel;
use Bpocallaghan\Sluggable\HasSlug;
use Bpocallaghan\Sluggable\SlugOptions;// AJOUT pour création SLUG auto
use Illuminate\Database\Eloquent\SoftDeletes;
use Titan\Models\Traits\ActiveTrait;

class Actus extends TitanCMSModel
{
    use SoftDeletes, HasSlug, ActiveTrait;

    protected $table = 'actus';

    protected $guarded = ['id'];

    protected $dates = ['active_form', 'active_to'];

    /**
     * Validation rules for this model
     */
    static public $rules = [
        'title'       => 'required|min:4:max:150',
        'content'     => 'required|min:5:max:5000',
    ];

	
	
	// Création SLUG
	/**
	 * Generate slug with title
	 * @return type
	 */
    protected function getSlugOptions()
    {
        return SlugOptions::create()->generateSlugFrom('title');
    }

	
    /**
     * Get the summary text
     *
     * @return mixed
     */
    public function getSummaryAttribute()
    {
        if($this->attributes['summary']) {
            return $this->attributes['summary'];
        }

        return substr(strip_tags($this->attributes['content']), 0, 200);
    }
	
	public static function setSummary($request)
	{
		if ( empty($request->summary) ) {
			$limit = ( strlen(strip_tags($request->input('content'))) > 200 ) ? 200 : strlen(strip_tags($request->input('content')));
			$request->merge(['summary' => substr(strip_tags($request->input('content')), 0, $limit)]);
		}
	}

    /**
     * Get the createdBy
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

	
    /**
     * Get the deleted Actus in Trash
    */
    public function getDeleted()
    {
        return $this->onlyTrashed()->where('deleted_by', user()->id)->get();
    } 

}