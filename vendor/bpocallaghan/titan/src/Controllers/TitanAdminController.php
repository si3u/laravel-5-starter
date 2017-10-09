<?php

namespace Titan\Controllers;

use App\Models\NavigationAdmin;
use Titan\Controllers\Traits\CRUDNotify;

class TitanAdminController extends TitanController
{
    use CRUDNotify;

    protected $baseViewPath = 'admin.';

    // name of the resource we are viewing / modify
    protected $resource = '';

    function __construct()
    {
        $this->setSelectedNavigation();
        $this->breadcrumb = $this->getBreadCrumb();
        $this->pagecrumb = $this->getPageCrumb();

        // check role if user have role for navigation
        $this->middleware('role:' . $this->selectedNavigation->id);

        $this->middleware(function ($request, $next) {
            $this->navigation = NavigationAdmin::getAllByParentGrouped();

            return $next($request);
        });
    }

    /**
     * Get the html title (check for crud reserve word)
     *
     * @return string
     */
    protected function getTitle()
    {
        if (strlen($this->title) <= 5) {
            if ($word = $this->checkIfReservedWordInUrl()) {
                $this->title .= ucfirst($word) . ' ';
            }

            $navigation = array_reverse($this->urlParentNavs);
            foreach ($navigation as $key => $nav) {
                $this->title .= $nav->title . ($key + 1 < count($navigation) ? ' - ' : '');
            }
        }

        return $this->title . ' - Admin | ' . config('app.name');
    }

    /**
     * Return / Render the view
     *
     * @param       $view
     * @param array $data
     * @return $this
     */
    protected function view($view, $data = [])
    {
        return parent::view($view, $data)
           /* ->with('navigation', $this->navigation)
            ->with('selectedNavigationParents', $this->urlParentNavs)
            ->with('breadcrumb', $this->breadcrumb)
            ->with('pagecrumb', $this->pagecrumb)
            ->with('resource', $this->resource)
            ->with('selectedNavigation', $this->selectedNavigation);*/
            ->withNavigation($this->navigation)						// Array navigations
            ->withSelectedNavigationParents($this->urlParentNavs)	// Array position parente ou actuelle si principale
            ->withBreadcrumb($this->breadcrumb)						// ex : <ol class="breadcrumb"><li>.....</ol>
            ->withPagecrumb($this->pagecrumb)						// ex: <h1><i class="fa fa-cube"></i> Actualités</h1>
            ->withResource($this->resource)							// ex: Actualité
            ->withSelectedNavigation($this->selectedNavigation);	// Array Position actuelle
    }

    /**
     * Generate the breadcrumbs
     * TODO: check for reserved words and some parent links are only for show (not
     * clickable)
     *
     * @return string
     */
    protected function getBreadCrumb()
    {
        $navigation = $this->urlParentNavs;
        $url = config('app.url');
        $html = '<ol class="breadcrumb"><li><a href="/admin">Tableau de Bord</a></li>';

        // for dashboard, only add home
        if (count($navigation) == 1 && $navigation[0]->title == 'Tableau de Bord') {
            $html .= '<li><a href="' . $url . '"><i class="fa fa-home"></i> Tableau de Bord</a></li>';
        }
        else {
            foreach ($navigation as $key => $nav) {
                $html .= '<li>';
                $icon = (strlen($nav->icon) > 2 ? '<i class="fa fa-' . $nav->icon . '"></i> ' : '');
                $html .= '<a href="' . url($nav->url) . '">' . $icon . '' . $nav->title . '</a>';
                $html .= '</li>';
            }

            // TODO: show edit / create, etc icon ?
            if ($word = $this->checkIfReservedWordInUrl()) {
                $html .= '<li>';
                $html .= ucfirst($word);
                $html .= '</li>';
            };
        }

        return $html . '</ol>';
    }

    public function getPageCrumb()
    {
        $navigation = $this->urlParentNavs;
        $html = '<h1>';

        // for dashboard, only add home
        if (count($navigation) == 1 && $navigation[0]->title == 'Tableau de Bord') {
            $html .= '<i class="fa fa-home"></i> Tableau de Bord';
        }
        else {

            //foreach ($navigation as $key => $nav) {
            //    $html .= '<li>';
            //    $html .= '<i class="fa fa-' . $nav->icon . '"></i> ' . $nav->title;
            //    $html .= '</li>';
            //}

            $html .= '<i class="fa fa-' . $this->selectedNavigation->icon . '"></i> ' . $this->selectedNavigation->title;

            // TODO: show edit / create, etc icon ?
            if ($word = $this->checkIfReservedWordInUrl()) {
                $html .= '<small>';
                $html .= ucfirst($word);
                $html .= '</small>';
            };
        }

        return $html . '</h1>';
    }

    /**
     * Check if one of the keywords are in the url
     *
     * @param bool $url
     * @return bool
     */
    protected function checkIfReservedWordInUrl($url = false)
    {
        $sections = $this->getCurrentUrlSections();
        if (count($sections) >= 1) {
            $last = intval($sections[count($sections) - 1]);
        }

        $keywords = [
            'show',
            'create',
            'edit',
        ];

// SANS CA, il n'y a plus les "Edit", "Create" et "Show" dans les titres de pages
    /*    foreach ($sections as $key => $slug) {
            if (in_array($slug, $keywords)) {
                return $slug;
            }
        }

        // resource ID
        if ($last >= 1) {
            return 'show';
        }*/

        return false;
    }

    /**
     * Set the Current Navigation
     * Find the navigations parents and url parents
     *
     * @return bool
     */
    protected function setSelectedNavigation()
    {
        $url = $this->getCurrentUrl();
        $sections = $this->getCurrentUrlSections();

        // laravel removes last /
        if ($url === false) {
            // dahboard (substring from the /, laravel removes last /)
            $nav = NavigationAdmin::whereSlug('/')->get()->last();
        }
        else {
            // find nav with url - get last (parent can have same url)
            $nav = NavigationAdmin::where('url', '=', $url)
                ->orderBy('is_hidden', 'DESC')//->orderBy('url_parent_id')
                ->orderBy('list_order')
                ->get()
                ->last();
        }

        // we assume some params / reserved word is at the end
        if (!$nav && strlen($url) > 2) {
            // keep cutting off from url until we find him in the db
            foreach ($sections as $key => $slug) {
                $url = substr($url, 0, strripos($url, '/'));

                // find nav with url - get last (parent can have same url)
                $nav = NavigationAdmin::whereUrl($url)->get()->last();
                if ($nav) {
                    break;
                }
            }
        }

        // development testing
        if (config('app.env') == 'dev' && !$nav) {
            dd('Oops. Navigation non trouvée - voir si l\'url est dans la base de données (navigation_admin) - Message d\'erreur de TitanAdminController.php ligne:212 - voir pour changer app.env  "local"  par  "dev"...');
        }

        $this->selectedNavigation = $nav;

        // get all navigations -> ON parent_id
        $this->parentNavs = $nav->getParentsAndYou();

        // get all navigations -> ON url_parent_id
        $this->urlParentNavs = $nav->getUrlParentsAndYou();

        // name of resource - used on page to, eg, Add new 'resource', enter title of 'resource'
        $this->resource = str_singular($nav->title); // TODO: - maybe add a 'resource' field on the table

        $mode = $this->checkIfReservedWordInUrl();

        $this->selectedNavigation->mode = $mode == false ? 'index' : $mode;

        return $this->selectedNavigation;
    }

    /**
     * Get the items, check if we use ajax or send items to view
     * Return the index view
     * @param string $view
     * @return mixed
     */
    protected function showIndex($view = '')
    {
        $items = $this->getTableRows();
        $ajax = count($items) > 150 ? 'true' : 'false';

        return $this->view($view, compact('ajax'))->with('items', $ajax == 'true' ? [] : $items);
    }

    /**
     * Return the data formatted for the table
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTableData()
    {
        $items = $this->getTableRows();

        return Datatables::of($items)->addColumn('action', function ($row) {
            return action_row($this->selectedNavigation->url, $row->id, $row->title,
                ['edit', 'delete']);
        })->make(true);
    }
}
