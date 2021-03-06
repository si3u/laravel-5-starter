<?php

namespace App\Models;

use App\User;
use Titan\Models\TitanCMSModel;
use Bpocallaghan\Sluggable\HasSlug;
use Bpocallaghan\Sluggable\SlugOptions;// AJOUT pour création SLUG STRING auto
use Illuminate\Database\Eloquent\SoftDeletes;
use Titan\Models\Traits\ActiveTrait;


//Laravel-Taggable - https://github.com/summerblue/laravel-taggable
use EstGroupe\Taggable\Taggable;
use \EstGroupe\Taggable\Model\Tag as Tag; // pour getAllTags()

class Article extends TitanCMSModel
{
    use SoftDeletes, HasSlug, ActiveTrait, Taggable;

    protected $table = 'articles';

    protected $guarded = ['id'];

    protected $dates = ['active_form', 'active_to'];

    /**
     * Validation rules for this model
     */
    static public $rules = [
        'title'       => 'required|min:4:max:150',
        'content'     => 'required|min:5:max:5000',
        'category_id' => 'required|exists:article_categories,id',
    ];

	
	/**
	 * Generate slug string with title
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
	

    /**
     * Get the createdBy
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /**
     * Get the category
     */
    public function category()
    {
        return $this->belongsTo(ArticleCategory::class, 'category_id', 'id');
    }
	
	
    /**
     * Get the Tags
     */
    public static function getAllTags()
    {
		return Tag::where('deleted_by', 0)->get();
    }

	
	
    /**
     * Get the deleted Articles in Trash
    */
    public function getDeleted()
    {
        return $this->onlyTrashed()->where('deleted_by', user()->id)->get();
    } 

}