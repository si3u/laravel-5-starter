<?php

namespace App\Http\Controllers\Admin;

use Redirect;
use App\Http\Requests;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;
use Titan\Controllers\Traits\UploadFile;

use App\Models\NavigationWebsite; // select2 for link

	
class BannersController extends AdminController
{
    use UploadFile;

    /**
     * Display a listing of banner.
     *
     * @return Response
     */
    public function index()
    {
        save_resource_url();

        return $this->view('banners.index')->with('items', Banner::all());
    }

    /**
     * Show the form for creating a new banner.
     *
     * @return Response
     */
    public function create()
    {
        return $this->view('banners.add_edit')
			->withSelectNavigation(NavigationWebsite::getAllLists(false));
    }

    /**
     * Store a newly created banner in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Banner::$rules, Banner::$messages);

        $photo = $this->uploadBanner($request->file('photo'));
        if ($photo) {
            $request->merge(['image' => $photo]);
            $banner = $this->createEntry(Banner::class, $request->except('photo'));
        }

        log_activity('Bannière Créée', 'Bannière ' . $banner->title. ' a été créée');

        return redirect_to_resource();
    }

    /**
     * Display the specified banner.
     *
     * @param Banner $banner
     * @return Response
     */
    public function show(Banner $banner)
    {
        return $this->view('banners.show')->with('item', $banner);
    }

    /**
     * Show the form for editing the specified banner.
     *
     * @param Banner $banner
     * @return Response
     */
    public function edit(Banner $banner)
    {
        return $this->view('banners.add_edit')
			->withItem($banner)
			->withSelectNavigation(NavigationWebsite::getAllLists(false));
    }

    /**
     * Update the specified banner in storage.
     *
     * @param Banner  $banner
     * @param Request $request
     * @return Response
     */
    public function update(Banner $banner, Request $request)
    {
        if (is_null($request->file('photo'))) {
            $this->validate($request, array_except(Banner::$rules, 'photo'), Banner::$messages);
        }
        else {
            $this->validate($request, Banner::$rules, Banner::$messages);

            $photo = $this->uploadBanner($request->file('photo'));
            $request->merge(['image' => $photo]);
        }

        $this->updateEntry($banner, $request->except('photo'));

        log_activity('Bannière Mise à jour', 'Bannière ' . $banner->title).' a été mis à jour.';

        return redirect_to_resource();
    }

    /**
     * Remove the specified banner from storage.
     *
     * @param Banner  $banner
     * @param Request $request
     * @return Response
     */
    public function destroy(Banner $banner, Request $request)
    {
        $this->deleteEntry($banner, $request);

        return redirect_to_resource();
    }
	
	
}
