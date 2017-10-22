<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Models\ArticleCategory;
use Redirect;
use App\Http\Requests;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class ArticlesController extends AdminController
{
	/**
	 * Display a listing of article.
	 *
	 * @return Response
	 */
	public function index(Article $article)
	{
		save_resource_url();
		
        return $this->view('blog.index')
					->withItems(Article::with('category')->get())
					->withTrash($article->getDeleted());
	}

	/**
	 * Show the form for creating a new article.
	 *
	 * @return Response
	 */
	public function create()
	{
		$id = (( ! empty(Article::get()->last()) ? Article::get()->last()->id : 0) + 1);// pour pouvoir créer le dossier contenant les images en relation

		return $this->view('blog.create_edit')
					->withCategories( ArticleCategory::getAllList() )
					->withId($id);
	}

	/**
	 * Store a newly created article in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
	    $this->validate($request, Article::$rules, Article::$messages);
		
		$request->merge( ['keywords' => implode(',', getActiveKeywords($request->keywords))] ); // keywords[] to string
		
        $this->createEntry(Article::class, $request->all());

		notify()->info("Info", "Vous pouvez désormais attacher des &Eacute;tiquettes (Tags) à cette nouvelle Réalisation.");
		
        return redirect_to_resource();
	}

	/**
	 * Display the specified article.
	 *
	 * @param Article $article
	 * @return Response
	 */
	public function show(Article $article)
	{
		return $this->view('blog.show')
					->withItem($article);
	}

	/**
	 * Show the form for editing the specified article.
	 *
	 * @param Article $article
     * @return Response
     */
    public function edit(Article $article)
	{
		save_resource_url();
		
        $menuOthersItems = Article::with('category') ->select( 'id', 'title', 'category_id')
													->where('id', '!=', $article->id)
													->orderBy('category_id')->get();

		return $this->view('blog.create_edit')
					->withCategories(ArticleCategory::getAllList())
					->withItem($article)
					->withTags(Article::getAllTags())
					->withMenuOthersItems($menuOthersItems);
	}

	/**
	 * Update the specified article in storage.
	 *
	 * @param Article  $article
     * @param Request    $request
     * @return Response
     */
    public function update(Article $article, Request $request)
	{
		save_resource_url();
		
		$this->validate($request, Article::$rules, Article::$messages);

		// KEYWORDS - with Helpers/keywords_helpers.php
		$request->merge( ['keywords' => implode(',', getActiveKeywords($request->keywords))] );
		
        $this->updateEntry($article, $request->all());

        return redirect_to_resource();
	}

	/**
	 * Remove the specified article from storage.
	 *
	 * @param Article  $article
     * @param Request    $request
	 * @return Response
	 */
	public function destroy(Article $article, Request $request)
	{
		$this->deleteEntry($article, $request);

        return redirect()->back();
	}
	
	
	
	
	/**
	 * Copy a Item
	 *  
	 * @param type $id
	 * @param Request $request
	 */
	public function copyItem($id, Article $article)
	{
		$this->duplicateEntry($id, $article);
		
        return redirect()->back();
	}
	
	
	/**
	 * Force Deleted item(s)
	 * 
	 * @param Actus $actus
	 * @param Request $request
	 */
	public function forceDestroy(Article $article, Request $request) 
	{
		$this->forceDeleteEntry($article, $request);
		
        return redirect()->back();
	}
	
	/**
	 * Restore a item
	 * 
	 * @param type $id
	 * @param Actus $actus
	 */
	public function restore($id, Article $article)
	{
		$this->restoreEntry($article, $id);
		
        return redirect()->back();
	}
	
}
