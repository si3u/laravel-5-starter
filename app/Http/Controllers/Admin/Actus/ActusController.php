<?php

namespace App\Http\Controllers\Admin\Actus;

use Redirect;
use App\Http\Requests;
use App\Models\Actus;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

use App\Models\LogAdminActivity as Log;

class ActusController extends AdminController
{
	/**
	 * Display a listing of Actus.
	 *
	 * @return Response
	 */
	public function index(Actus $actus)
	{
		save_resource_url();
        return $this->view('actus.index')
					->withItems(Actus::get())
					->withTrash($actus->getDeleted());
	}

	/**
	 * Show the form for creating a new Actus.
	 *
	 * @return Response
	 */
	public function create()
	{
		$id = (Actus::get()->last()->id + 1); // pour créer le dossier contenant les images en relation

		return $this->view('actus.create_edit')->withId($id);
	}

	/**
	 * Store a newly created Actus in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
	    $this->validate($request, Actus::$rules);//, Actus::$messages);
		
		Actus::setSummary($request); // Obligatoire ici, ALORS QUE NON dans Article ??!!??

        $this->createEntry(Actus::class, $request->all());

        return redirect_to_resource();
	}

	/**
	 * Display the specified Actu.
	 *
	 * @param Actus $actu
	 * @return Response
	 */
	public function show(Actus $actus)
	{
		return $this->view('actus.show')->withItem($actus);
	}

	/**
	 * Show the form for editing the specified Actus.
	 *
	 * @param Actus $actus
     * @return Response
     */
    public function edit(Actus $actus)
	{
		save_resource_url();

		return $this->view('actus.create_edit')->with('item', $actus);
	}

	/**
	 * Update the specified Actus in storage.
	 *
	 * @param Actus  $actus
     * @param Request    $request
     * @return Response
     */
    public function update(Actus $actus, Request $request)
	{
		save_resource_url();
		
		$this->validate($request, Actus::$rules, Actus::$messages);
		//Actus::setSummary($request); // pas ici (sur update) pour pouvoir changer...
		
        $this->updateEntry($actus, $request->all());

        return redirect_to_resource();
	}

	/**
	 * Remove the specified Actus from storage.
	 *
	 * @param Actus  $actus
     * @param Request    $request
	 * @return Response
	 */
	public function destroy(Actus $actus, Request $request)
	{
		$this->deleteEntry($actus, $request);

        return redirect()->back();
	}
	
	
	
	
	/**
	 * Copy a Item
	 *  
	 * @param type $id
	 * @param Request $request
	 */
	public function copyItem($id, Actus $actus)
	{
		$this->duplicateEntry($id, $actus);
		
        return redirect()->back();
	}
	
	
	/**
	 * Force Deleted item(s)
	 * 
	 * @param Actus $actus
	 * @param Request $request
	 */
	public function forceDestroy(Actus $actus, Request $request)
	{
		$this->forceDeleteEntry($actus, $request);
		
        return redirect()->back();
	}
	
	
	/**
	 * Restore a item
	 * 
	 * @param type $id
	 * @param Actus $actus
	 */
	public function restore($id, Actus $actus)
	{
		$this->restoreEntry($actus, $id);
		
        return redirect()->back();
	}
}
