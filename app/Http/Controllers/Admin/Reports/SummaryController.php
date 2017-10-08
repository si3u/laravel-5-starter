<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Http\Requests;
use App\Models\FAQ;
use App\Models\FeedbackPurchase;
use Illuminate\Http\Request;
use App\Models\FeedbackArtwork;
use App\Models\FeedbackGigapan;
use App\Models\FeedbackPackage;
use App\Models\FeedbackContactUs;
use App\Models\FeedbackWeddingPackage;
use Titan\Controllers\TitanAdminController;

class SummaryController extends TitanAdminController
{
    public function index()
    {
        $items = $this->getData();

        return $this->view('reports.summary', compact('items'));
    }

    private function getData()
    {
        $result = [];

		$actionsContactUs = [];
		foreach (FeedbackContactUs::all() as $v) {
			$actionsContactUs[] = [$v->fullname, $v->email];
		}

        $result[] = ['', ''];
        $result[] = ['<strong>Formulaires</strong>', ''];
        $result[] = ['Contact', FeedbackContactUs::count(), $actionsContactUs];

//        $result[] = ['', ''];
//        $result[] = ['<strong>Item 2</strong>', ''];
//        $result[] = ['Total xx', '0'];

        return $result;
    }
}