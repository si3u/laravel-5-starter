<?php

namespace App\Http\Controllers\Admin\History;

use App\Http\Requests;
use App\Models\LogActivity;
use App\Models\LogLogin; // AJOUT pour vider les Logins en meme temps que les activités
use App\Models\LogAdminActivity;
use Titan\Controllers\TitanAdminController;

class HistoryController extends TitanAdminController
{
    public function website()
    {
		save_resource_url();
		
        $actions = LogActivity::getLatest();

        return $this->view('history.website', compact('actions'));
    }

    public function admin()
    {
		save_resource_url();
		
        $activities = LogAdminActivity::getLatest();

        return $this->view('history.admin', compact('activities'));
    }
	
	
	private $modelLog;
	
	/**
	 *  SUPPRESSION des activités
	 * @param STR $type
	 * @param BOOL $directAccess
	 */
	public function destroy($type, $directAccess = true)
	{
		$del = false;
		
		if($type == 'admin')
		{
			$this->modelLog = new LogAdminActivity();
			$this->deleteLog($type);
			
			if($directAccess) {	return redirect_to_resource(); }
		}
		elseif($type == 'website')
		{
			$this->modelLog = new LogActivity();
			$this->deleteLog($type);
			$this->modelLog = new LogLogin();
			$this->deleteLog('login');
			
			if($directAccess) { return redirect_to_resource(); }
		}
	}
	
	/**
	 * SUPPRESSION des activités (call by destroy() )
	 * @param STR $type
	 * @param INT $offset si on veut en laisser
	 */
	public function deleteLog($type, $offset = 0)
	{
		$del = false;
		$typesText = ['admin' => 'd\'Administration', 'website' => 'du Site', 'login' => 'de Connexions'];
		
		$countLog = $this->modelLog->count();

		if($countLog > $offset) {
			$del = $this->modelLog
				->orderBy('created_at', 'DESC')
				->offset($offset)
				->take($countLog - $offset)
				//->latest()
				->delete();
		}
		else {
			return notify()->warning('Pas moins...', "Le nombre minimal est déjà atteint pour<br> les activités $typesText[$type] !");
		}
		
		if($del){ notify()->info('Info', "Activités $typesText[$type] supprimées."); }
		else { notify()->error('Erreur', "Une erreur est survenue à la suppression<br> des activités $typesText[$type]."); }
	}
}