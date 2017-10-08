<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Titan\Controllers\TitanAdminController;

use Titan\Controllers\TitanWebsiteController as WebsiteController; // pour navigation Website

use App\Http\Controllers\Admin\History\HistoryController as History; // Pour Vidage auto des Activités

class DashboardController extends AdminController
{
	
	public function index()
	{
		return $this->view('dashboard')->withWebsiteDashboardNavigation( $this->createNavigationWebsiteForAdmin() );
//		return $this->view('dashboard');
	}
	
	
	public function createNavigationWebsiteForAdmin() {
		
		$websiteCtrl = new WebsiteController;
		
		return $websiteCtrl->generateNavigation();
	}
	
	
	
// Fonctionne mais je me demande si c'est necéssaire
	 // Vidage auto des Activités
//	public function __destruct()
//	{
//		$this->destroyHistory(); // Vidage auto des Activités
//	}
//	
//	
//	public function destroyHistory($limit = 25) //  en laisse 25
//	{
//		$history = new History();
//		//					type	 limit	 directAccess
//		$history->destroy('admin',   $limit, false);
//		$history->destroy('website', $limit, false);
//	}
	
}
