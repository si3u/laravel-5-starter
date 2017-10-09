<?php

namespace Titan\Controllers;

use App\Http\Controllers\Controller;
use Request;

use HTMLMin;

class TitanController extends Controller
{
    protected $baseViewPath = '';

    // html meta headers
    protected $title = "";

    protected $description = "";

    protected $image = 'images/logo.png';

    protected $parentNavs = [];

    protected $urlParentNavs = [];

    protected $selectedNavigation = false;

    /**
     * Get the HTML Title
     *
     * @return string
     */
    protected function getTitle()
    {
        return trim($this->title . (strlen($this->title) < 2 ? '' : ' | ') . config('app.name'));
    }

    /**
     * Get the HTML Description
     *
     * @return string
     */
    protected function getDescription()
    {
        return trim($this->description . (strlen($this->description) < 2 ? '' : ' | ') . config('app.description'));
    }

    /**
     * Get the HTML Share Image
     *
     * @return string
     */
    protected function getImage()
    {
        return $this->image;
    }

    /**
     * Return / Render the view
     *
     * @param            $view
     * @param array      $data
     * @return $this
     */
    protected function view($view, $data = [])
    {
        return $this->minifier(
					view($this->baseViewPath . $view, $data)
								->with('HTMLTitle', $this->getTitle())
								->with('HTMLDescription', $this->getDescription())
					);
    }

	/**
	 * Minifie les pages en mode en production
	 * 
	 * @param view
	 */
	public function minifier($view)
	{
		if(env('APP_ENV') != 'local' || env('APP_ENV') != 'dev') {
			return HTMLMin::html(HTMLMin::css($view)); // Compression
		} else {
			return $view;
		}
	}
	
    /**
     * Get the slug from the url (url inside website)
     *
     * @return string
     */
    protected function getCurrentUrl($prefix = '/')
    {
        //$url = substr(request()->url(), strlen(config('app.url')));
        // prefix (request can be http://xx and app.url is https)
        $url = request()->path();
        $url = $prefix . ltrim($url, $prefix);
        
        return $url;
    }

    /**
     * Explode the url into slug pieces
     *
     * @return array
     */
    protected function getCurrentUrlSections()
    {
        return explode('/', $this->getCurrentUrl());
    }
}
