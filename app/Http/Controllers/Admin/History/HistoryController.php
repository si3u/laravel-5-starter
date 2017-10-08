<?php

namespace App\Http\Controllers\Admin\History;

use App\Http\Requests;
use App\Models\LogActivity;
use App\Models\LogLogin; // AJOUT pour vider ça en meme temps que les activités
use App\Models\LogAdminActivity;
use Titan\Controllers\TitanAdminController;

class HistoryController extends TitanAdminController
{
    public function website()
    {
        $actions = LogActivity::getLatest();

        return $this->view('history.website', compact('actions'));
    }

    public function admin()
    {
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
			
			/*$countLog = LogAdminActivity::count();
			
			if($countLog > $offset) {
				// on en laisse 10 au minimum
				$del = LogAdminActivity::offset($offset)->take($countLog - $offset)->delete();
			//	LogLogin::offset($offset)->take($countLogAdmin - $offset)->delete(); // logs Login
			}
			if($del){ notify()->info('Info', 'Activités Administration supprimées.' , 'trash-o rotateIn animated'); }
			else { notify()->error('Erreur', 'Une erreur est survenue<br> à la suppression des activités.'); }
dd($del);*/
			if($directAccess) { return $this->admin(); }
		}
		elseif($type == 'website')
		{
			$this->modelLog = new LogActivity();
			$this->deleteLog($type);
			$this->modelLog = new LogLogin();
			$this->deleteLog('login');
			
			/*$countLog = LogActivity::count();
			
			if($countLog > $offset) {
				// on en laisse 10 au minimum
				$del = LogActivity::offset($offset)->take($countLog - $offset)->delete();

			}
			if($del){ notify()->info('Info', 'Activités Website supprimées.' , 'trash-o rotateIn animated'); }
			else { notify()->error('Erreur', 'Une erreur est survenue<br> à la suppression des activités.'); }
dd($del);*/
			if($directAccess) { return $this->website(); }
		}
	}
	
	/**
	 * SUPPRESSION des activités (call by destroy() )
	 * @param STR $type
	 * @param INT $offset
	 */
	public function deleteLog($type, $offset = 0)
	{
		$del = false;
		$typesText = ['admin' => 'd\'Administration', 'website' => 'du Site', 'login' => 'de Connexions'];
		
		$countLog = $this->modelLog->count();

		if($countLog > $offset) {
			// on en laisse 10 au minimum
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