<?php

namespace App\Http\Controllers\Admin\Reports;

use DataTables;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\FeedbackContactUs;
use Titan\Controllers\TitanAdminController;
use Titan\Controllers\Traits\ReportChartTable;

class ContactUsController extends TitanAdminController
{
    use ReportChartTable;

    /**
     * Return the view
     * @return $this
     */
    public function index()
    {
        return $this->view('reports.contactus');
    }

    /**
     * Return the data formatted for chart
     * @return \Illuminate\Http\JsonResponse
     */
    public function getChartData()
    {
        $rows = FeedbackContactUs::selectRaw('count(id) as total, DATE_FORMAT(created_at, "%d %b %Y ") as date')
            ->where('created_at', '>=', $this->inputDateFrom() . '%')
            ->where('created_at', '<=', $this->inputDateTo() . '  23:59:59')
            ->groupBy(\DB::raw('DAY(created_at)'))
            ->orderBy('created_at')
            ->get();

        // format and add to response
        $response = ['labels' => [], 'total' => 0];
        $line = [];
        foreach ($rows as $key => $row) {
            $response['total'] += $row->total;
            $response['labels'][] = $row->date;

            $line[] = $row->total;
        }

        $response['datasets'][] = $this->getDataSet('Total', $line);
		
        return json_encode($response);
    }

    /**
     * Get the data - datatables
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTableData()
    {
        $items = FeedbackContactUs::selectRaw('*, DATE_FORMAT(created_at, "%d %b, %Y \à %H:%i:%s") as date')
            ->where('created_at', '>=', $this->inputDateFrom() . '%')
            ->where('created_at', '<=', $this->inputDateTo() . '  23:59:59')
            ->orderBy('created_at')
            ->get();

        return Datatables::of($items)->addColumn('fullname', function ($row) {
            return $row->fullname;
        })->make(true);
    }
	
	public function destroy()
	{
		$del = FeedbackContactUs::truncate();
		
		if($del) {
			notify()->success('Succès', 'Entrées de Contact supprimées.');
		} else {
			notify()->error('Pardon', 'Un problème est survenu à la suppression.');
		}
        return redirect()->back();
	}
	
}