<?php

namespace Bpocallaghan\Sluggable;

use Illuminate\Database\Eloquent\Model;

trait HasSlug
{
    /** @var \Bpocallaghan\Sluggable\SlugOptions */
    protected $slugOptions;

    /**
     * Get the options for generating the slug.
     */
    protected function getSlugOptions()
    {
        return SlugOptions::create();
    }

    /**
     * Boot the trait.
     */
    protected static function bootHasSlug()
    {
        static::creating(function (Model $model) {
            $model->generateSlugOnCreate();
        });

        static::updating(function (Model $model) {
            $model->generateSlugOnUpdate();
        });
    }

    /**
     * Generate a slug on create
     */
    protected function generateSlugOnCreate()
    {
        $this->slugOptions = $this->getSlugOptions();

        if (!$this->slugOptions->generateSlugOnCreate) {
            return;
        }

        $this->createSlug();
    }

    /**
     * Handle adding slug on model update.
     */
    protected function generateSlugOnUpdate()
    {
        $this->slugOptions = $this->getSlugOptions();

        if (!$this->slugOptions->generateSlugOnUpdate) {
            return;
        }

        // check updating
        $slugNew = $this->generateNonUniqueSlug();
        $slugCurrent = $this->attributes[$this->slugOptions->slugField];

		
		// AJOUT sinon erreur de PHP strpos(slugCurrent, slugNew) 
		$slugNew = ($slugNew) ? $slugNew : ' ';
//dd('Ligne 66: '.__FILE__, $this->slugOptions, $slugCurrent, $slugNew);

        // if new base slug is in string as old slug (the slug source's value did not change)
        // see if the slug is still unique in database
        if (strpos($slugCurrent, $slugNew) === 0) {
            $slugUpdate = $this->checkUpdatingSlug($slugCurrent);
            // no need to update slug (slug is still unique)
            if ($slugUpdate !== false) {
                return;
            }
        }

        $this->createSlug();
    }

    /**
     * Handle setting slug on explicit request.
     */
    public function generateSlug()
    {
        $this->slugOptions = $this->getSlugOptions();

        $this->createSlug();
    }

    /**
     * Add the slug to the model.
     */
    protected function createSlug()
    {
        $slug = $this->generateNonUniqueSlug();

        if ($this->slugOptions->generateUniqueSlug) {
            $slug = $this->makeSlugUnique($slug);
        }
//dd($slug);
        $this->attributes[$this->slugOptions->slugField] = $slug;
    }

    /**
     * Generate a non unique slug for this record.
     */
    protected function generateNonUniqueSlug()
    {
        $slug = $this->getSlugSourceString();

        return str_slug($slug, $this->slugOptions->slugSeparator);
    }

    /**
     * Get the string that should be used as base for the slug.
     */
    protected function getSlugSourceString()
    {
        // if callback given
        if (is_callable($this->slugOptions->generateSlugFrom)) {
            $slug = call_user_func($this->slugOptions->generateSlugFrom, $this);

            return substr($slug, 0, $this->slugOptions->maximumLength);
        }

        // concatenate on the fields and implode on seperator
        $slug = collect($this->slugOptions->generateSlugFrom)
            ->map(function ($fieldName = '') {
            return $this->$fieldName;
        })->implode($this->slugOptions->slugSeparator);

        return substr($slug, 0, $this->slugOptions->maximumLength);
    }

    /**
     * @param $slug
     * @return string
     */
    protected function makeSlugUnique($slug)
    {
        // get existing slugs
        $list = $this->getExistingSlugs($slug);

        // slug is already unique
        if ($list->count() === 0) {
            return $slug;
        }

        // generate unique suffix
        return $this->generateSlugSuffix($slug, $list);
    }

    /**
     * Get existing slugs matching slug
     *
     * @param $slug
     * @return \Illuminate\Support\Collection|static
     */
    protected function getExistingSlugs($slug)
    {
        return static::whereRaw("{$this->slugOptions->slugField} LIKE '$slug%'")
            ->withoutGlobalScopes()// ignore scopes
            ->withTrashed()// trashed, when entry gets activated again
            ->orderBy($this->slugOptions->slugField)
            ->get()
            ->pluck($this->slugOptions->slugField);
    }

    /**
     * Suffix unique index to slug
     *
     * @param $slug
     * @param $list
     * @return string
     */
    private function generateSlugSuffix($slug, $list)
    {
        $seperator = $this->slugOptions->slugSeparator;

        // loop through list and get highest index number
        // incase the order is faulty
        $index = $list->map(function ($s) use ($slug, $seperator) {
            // str_replace instead of explode('-');
            return intval(str_replace($slug . $seperator, '', $s));
        })->sort()->last();

        return $slug . $seperator . ($index + 1);
    }

    /**
     * Check if we are updating
     * Find entries with same slug
     * Exlude current model's entry
     *
     * @param $slug
     * @return bool
     */
    private function checkUpdatingSlug($slug)
    {
        if ($this->id >= 1) {
            // find entries matching slug, exclude updating entry
            $exist = self::where($this->slugOptions->slugField, $slug)
                ->where('id', '!=', $this->id)
                ->first();

            // no entries, save to use current slug
            if (!$exist) {
                return $slug;
            }
        }

        // unique slug needed
        return false;
    }
}
