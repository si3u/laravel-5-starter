<?php

namespace Titan\Controllers\Traits;

use Carbon\Carbon;
use Illuminate\Http\Request;
use LaravelAnalytics;

// AIDE GOOGLE DIMENSIONS / METRICS : https://developers.google.com/analytics/devguides/reporting/core/dimsmets

use Spatie\Analytics\Period as Period;

/**
 * https://github.com/spatie/laravel-analytics
 * http://www.colorhexa.com
 *
 * Class Analytics
 * @package Titan\Controllers\Traits
 */
trait AnalyticsHelper
{
    protected $datasets = [
        [
            'label'                => "",
            'fillColor'            => "rgba(60, 141, 188, 0.1)",
            'strokeColor'          => "rgba(60, 141, 188, 1)",
            'pointColor'           => "#3b8bba",
            'pointStrokeColor'     => "rgba(60,141,188,1)",
            'pointHighlightFill'   => "#fff",
            'pointHighlightStroke' => "rgba(220, 220, 220, 1)",
            'data'                 => [],
        ],
        [
            'label'                => "",
            'fillColor'            => "rgba(0, 141, 76, 0.1)",
            'strokeColor'          => "rgba(0, 141, 76, 1)",
            'pointColor'           => "rgba(0, 141, 76, 1)",
            'pointStrokeColor'     => "#fff",
            'pointHighlightFill'   => "#fff",
            'pointHighlightStroke' => "rgba(220, 220, 220, 1)",
            'data'                 => [],
        ],
        [
            'label'                => "",
            'fillColor'            => "rgba(60, 141, 188, 0.1)",
            'strokeColor'          => "rgba(60, 141, 188, 1)",
            'pointColor'           => "#3b8bba",
            'pointStrokeColor'     => "rgba(60,141,188,1)",
            'pointHighlightFill'   => "#fff",
            'pointHighlightStroke' => "rgba(220, 220, 220, 1)",
            'data'                 => [],
        ]
    ];

    protected $pieData = [
        [
            'color'     => "#dd4b39",
            'highlight' => "#e15f4f",
        ],
        [
            'color'     => "#00a65a",
            'highlight' => "#00c068",
        ],
        [
            'color'     => "#f39c12",
            'highlight' => "#f4a62a",
        ],
        [
            'color'     => "#00c0ef",
            'highlight' => "#09cfff",
        ],
        [
            'color'     => "#ff2e9f",
            'highlight' => "#ff3434",
        ],
        [
            'color'     => "#307095",
            'highlight' => "#367ea8",
        ],
        [
            'color'     => "#d2d6de",
            'highlight' => "#c3c9d3",
        ],
    ];

    /**
     * Get this months Visitors
     * @return \Illuminate\Http\JsonResponse|int
     */
    public function getVisitors()
    {
        return $this->monthlyComparison('ga:users');
    }

    /**
     * Get this months Unique Visitors
     * @return int|string
     */
    public function getUniqueVisitors()
    {
        return $this->monthlyComparison('ga:newUsers');
    }

    /**
     * Get this months Visitors
     * @return \Illuminate\Http\JsonResponse|int
     */
    public function getBounceRate()
    {
        return $this->monthlyComparison('ga:bounceRate');
    }

    /**
     * Get this months average page load time
     * @return \Illuminate\Http\JsonResponse|int
     */
    public function getAvgPageLoad()
    {
        return json_response($this->monthlySummary('ga:avgPageLoadTime', 'year'));
    }

    /**
     * Get the top keywords for duration
     * @return \Spatie\LaravelAnalytics\Collection
     */
    public function getKeywords()
    {
        $dates = $this->getStartEndDate();
		
        $items = LaravelAnalytics::performQuery($dates['dates'], 'ga:organicSearches', [
            'dimensions'  => 'ga:keyword',
        ]);
        return $items->rows;
    }

    /**
     * Get the top referrers for duration
     * @return \Spatie\LaravelAnalytics\Collection
     */
    public function getReferrers()
    {
        $dates = $this->getStartEndDate();

        $items = LaravelAnalytics::performQuery($dates['dates'], 'ga:organicSearches', [
            'dimensions'  => 'ga:fullReferrer',
            'max-results' => 30
        ]);

        return $items->rows;
    }

    /**
     * Get the active users currently viewing the website
     * @return int
     */
    public function getActiveVisitors()
    {
        $total = LaravelAnalytics::performQuery(Period::create(Carbon::now()->subMinute(), Carbon::now()), 'ga:users', [
            'dimensions'  => 'ga:sessionCount',
        ]);

        return json_response($total->rows);
    }

    /**
     * Get the visitors and page views for duration
     * Format result for CartJS
     * @return string
     */
    public function getVisitorsAndPageViews()
    {
        $dates = $this->getStartEndDate();

		$data = LaravelAnalytics::fetchTotalVisitorsAndPageViews($dates['dates']);
		
        $totalViews = ['labels' => []];
        $visitors = [];
        $pageviews = [];
        foreach ($data as $k => $item) {
            array_push($totalViews['labels'], $item['date']->format('d M'));

            array_push($visitors, $item['visitors']);
            array_push($pageviews, $item['pageViews']);
        }

        $totalViews['datasets'][] = $this->getDataSet('Pages Vues', $pageviews, 0);
        $totalViews['datasets'][] = $this->getDataSet('Visiteurs', $visitors, 1);

        return json_encode($totalViews);
    }

    /**
     * Get the most visited pages for duration
     * @return \Spatie\LaravelAnalytics\Collection
     */
    public function getVisitedPages()
    {
        $dates = $this->getStartEndDate();

        $items = LaravelAnalytics::performQuery($dates['dates'], 'ga:pageviews', [
            'dimensions'  => 'ga:pageTitle',
        ]);

        return $items->rows;
    }

    /**
     * Get the top browsers for duration
     * Format results for pie chart
     * @return \Spatie\LaravelAnalytics\Collection
     */
    public function getBrowsers()
    {
        $dates = $this->getStartEndDate();

        $data = LaravelAnalytics::performQuery($dates['dates'], 'ga:sessions', [
            'dimensions'  => 'ga:browser',
            'max-results' => 7
        ]);

        $items = [];
        shuffle($data->rows); // shuffle results / randomimize chart color sections
        foreach ($data->rows as $k => $item) {
            $items[] = $this->getPieDataSet($item[0], $item[1], $k);
        }

        return $items;
    }

    /**
     * Get the gender comparisons
     * @return array
     */
    public function getUsersGender()
    {
        $dates = $this->getStartEndDate();

        $data = LaravelAnalytics::performQuery($dates['dates'], 'ga:users',
            ['dimensions' => 'ga:userGender']);

        $items = [];
        $rows = $data->rows;
        if (is_null($rows)) {
            return [];
        }
        shuffle($rows); // shuffle results / randomimize chart color sections
        foreach ($rows as $k => $item) {
            $items[] = $this->getPieDataSet(ucfirst($item[0]), $item[1]);
        }

        return $items;
    }

    /**
     * Get the users' age comparisons
     * @return array
     */
    public function getUsersAge()
    {
        $dates = $this->getStartEndDate();

        $data = LaravelAnalytics::performQuery($dates['dates'], 'ga:users',
            ['dimensions' => 'ga:userAgeBracket']);

        $labels = [];
        $datasets = [];
        $rows = $data->rows;
        if (is_null($rows)) {
            return ['labels' => [], 'datasets' => []];
        }
        foreach ($rows as $k => $item) {
            $labels[] = ucfirst($item[0]);
            $datasets[] = $item[1];
        }

        $datasets = [$this->getDataSet('Ages', $datasets, 0)];

        return ['labels' => $labels, 'datasets' => $datasets];
    }
	
	public function getUsersPositions()
	{
        $dates = $this->getStartEndDate();
		
        $data = LaravelAnalytics::performQuery($dates['dates'], 'ga:users',
            ['dimensions' => 'ga:city, ga:latitude, ga:longitude']);

		return $data->rows;
	}

    /**
     * Get the the users interests - affinity
     * @return \Spatie\LaravelAnalytics\Collection
     */
    public function getInterestsAffinity()
    {
        return $this->getInterests('ga:interestAffinityCategory');
    }

    /**
     * Get the the users interests - market
     * @return \Spatie\LaravelAnalytics\Collection
     */
    public function getInterestsMarket()
    {
        return $this->getInterests('ga:interestInMarketCategory');
    }

    /**
     * Get the the users interests - affinity
     * @return \Spatie\LaravelAnalytics\Collection
     */
    public function getInterestsOther()
    {
        return $this->getInterests('ga:interestOtherCategory');
    }

    /**
     * Get all the devices by sessions
     * @return mixed
     */
    public function getDevices()
    {
        $dates = $this->getStartEndDate();

        $data = LaravelAnalytics::performQuery($dates['dates'], 'ga:sessions', [
            'dimensions'  => 'ga:mobileDeviceInfo',
            'sort'        => '-ga:sessions',
            'max-results' => 30
        ]);

        if ($data->rows) {
            return $data->rows;
        }

        return [];
    }

    /**
     * Get the desktop vs mobile vs tablet
     */
    public function getDeviceCategory()
    {
        $dates = $this->getStartEndDate();

        $data = LaravelAnalytics::performQuery($dates['dates'], 'ga:sessions', [
            'dimensions' => 'ga:deviceCategory'
        ]);
		$items = [];
        foreach ($data->rows as $k => $item) {
            $items[] = $this->getPieDataSet($item[0], $item[1]);
        }

        return $items;
    }

    /**
     * Get the the users interests
     * @param $dimensions
     * @return \Spatie\LaravelAnalytics\Collection
     */
    public function getInterests($dimensions)
    {
        $dates = $this->getStartEndDate();

        $data = LaravelAnalytics::performQuery($dates['dates'], 'ga:sessions', [
            'dimensions'  => $dimensions,
            'sort'        => '-ga:sessions',
            'max-results' => 30
        ]);

        if (is_null($data->rows)) {
            return [];
        }

        return $data->rows;
    }

    /**
     * Helper to get the months analytics
     * @param string $metrics
     * @param string $month
     * @return \Illuminate\Http\JsonResponse|int
     */
    private function monthlySummary($metrics = 'ga:users', $period = 'month')
    {
        if ($period == '-month_1') { // le mois dernier
            $end = Carbon::now()->subMonth()->endOfMonth();
            $start = Carbon::now()->subMonth()->startOfMonth();
        }
        elseif ($period == 'year') {
            $end = Carbon::now();
            $start = Carbon::now()->subYear();
        }
        else {
            $end = Carbon::now();
            $start = Carbon::now()->startOfMonth();
        }

        $data = LaravelAnalytics::performQuery(Period::create($start->startOfDay(), $end->endOfDay()), $metrics)->rows;

        if ($data && count($data) >= 1 && count($data[0]) >= 1) {
            return $data[0][0];
        }

        return 0;
    }

    /**
     * Get this and last month of the metrics for a comparison
     * @param string $metrics
     * @return \Illuminate\Http\JsonResponse
     */
    private function monthlyComparison($metrics = 'ga:users')
    {
        $thisMonth = $this->monthlySummary($metrics);
        $lastMonth = $this->monthlySummary($metrics, '-month_1');

        return json_response([
            'month'      => [
                'value'     => $thisMonth,
                'color'     => "#00c0ef",
                'highlight' => "#00a7d0",
                'label'     => "En cours"
            ],
            'last_month' => [
                'value'     => $lastMonth,
                'color'     => "#00a65a",
                'highlight' => "#008d4c",
                'label'     => "Précédent"
            ]
        ]);
    }

    /**
     * Get the start and end duration
     * @return array
     */
    private function getStartEndDate()
    {
        $start = input('start', date('Y-m-d', strtotime('-29 days')));
        $end = input('end', date('Y-m-d'));

		$start = \DateTime::createFromFormat('Y-m-d', $start);
		$end = \DateTime::createFromFormat('Y-m-d', $end);
		
		$interval = Period::create($start, $end);
		
		$dates['dates'] = $interval;
		$dates['start'] = $interval->startDate;
		$dates['end'] = $interval->endDate;
		
		
        return $dates;//compact('start', 'end');
    }

    /**
     * Get the line dataset opbject
     * @param     $label
     * @param     $data
     * @param int $index
     * @return mixed
     */
    private function getDataSet($label, $data, $index = 0)
    {
        $set = $this->datasets[$index];
        $set['label'] = $label;
        $set['data'] = $data;

        return $set;
    }

    /**
     * Get the pie chart data
     * @param     $label
     * @param     $data
     * @param int $index
     * @return mixed
     */
    private function getPieDataSet($label, $data, $index = -1)
    {
        if ($index < 0) {
            $index = rand(0, count($this->pieData) - 1);
        }

		if($label == "desktop") {
			$label = "ordinateur";
		}
		if($label == "tablet") {
			$label = "tablette";
		}
        $set = $this->pieData[$index];
        $set['label'] = ucfirst($label);
        $set['value'] = $data;

        return $set;
    }
}
