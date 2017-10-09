<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Http\Requests;
use Titan\Controllers\TitanWebsiteController;
 use HTMLMin;
class WebsiteController extends TitanWebsiteController
{
    protected $showPageBanner = false;

    /**
     * Return / Render the view
     * @param       $view
     * @param array $data
     * @return $this
     */
    protected function view($view, $data = [])
    {
        $banners = $this->getBanners();

        $view = parent::view($view, $data)
            ->with('showPageBanner', $this->showPageBanner)
            ->with('banners', $banners);

	return $this->minifier($view);
    }

	/**
	 * Minifie les pages publiques en mode en production
	 * 
	 * @param view
	 */
	public function minifier($view)
	{
		if(env('APP_ENV') != 'local' || env('APP_ENV') != 'dev') {
			return HTMLMin::html(HTMLMin::css($view)); // Minification
		} else {
			return $view;
		}
	}

    protected function getBanners()
    {
        $items = Banner::active()->get();

        return $items;
    }
}
