<?php

namespace App\Classes;

use Illuminate\Support\Collection;
use Spatie\Analytics\AnalyticsFacade as Analytics;
use Spatie\Analytics\Period;

class AnalyticsParser
{
    /**
     * Fetch data from Google based on given period
     *
     * @param Period $period
     * @return array
     */
    public static function fetchVisitorsAndPageViews(Period $period)
    {
        $error = null;
        $data = collect();

        try {
            $data = Analytics::fetchTotalVisitorsAndPageViews($period);
        } catch (\Exception $exception){
            $error = $exception->getMessage();
        }

        return self::processViewsAndPageViewsData($data, $error);
    }

    /**
     * Processes given data and returns formatted data for the visitors and page views graph
     *
     * @param Collection $data
     * @param String|null $error
     * @return array
     */
    private static function processViewsAndPageViewsData(Collection $data, String $error = null)
    {
        $output = [];

        if ($error){
            $output['error'] = $error;
            $output['visitors'] = collect(null);
            $output['pageViews'] = collect(null);
            $output['date'] = collect(null);
        }

        $data = self::formatDateField($data);

        $output['visitors'] = $data->pluck('visitors');
        $output['pageViews'] = $data->pluck('pageViews');
        $output['date'] = $data->pluck('date');

        return $output;
    }

    private static function formatDateField(Collection $data)
    {
        return $data->map(function ($item, $key){
            $item['date'] = $item['date']->format('d M');
            return $item;
        });
    }
}
