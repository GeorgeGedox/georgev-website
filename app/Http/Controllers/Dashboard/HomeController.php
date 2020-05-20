<?php

namespace App\Http\Controllers\Dashboard;

use App\Classes\AnalyticsParser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Analytics\AnalyticsFacade as Analytics;
use Spatie\Analytics\Period;

class HomeController extends Controller
{
    public function index()
    {
        return view('dashboard.home.index', [
            'lastWeek' => AnalyticsParser::fetchVisitorsAndPageViews(Period::days(6)),
            'lastMonth' => AnalyticsParser::fetchVisitorsAndPageViews(Period::months(1)),
        ]);
    }
}
