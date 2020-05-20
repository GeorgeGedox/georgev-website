<?php

namespace App\Providers;

use App\Setting;
use Spatie\Analytics\Analytics;
use Spatie\Analytics\AnalyticsClient;
use Spatie\Analytics\AnalyticsClientFactory;
use Spatie\Analytics\Exceptions\InvalidConfiguration;

class AnalyticsServiceProvider extends \Spatie\Analytics\AnalyticsServiceProvider
{
    public function register()
    {
        $this->app->bind(AnalyticsClient::class, function () {
            $analyticsConfig = config('analytics');

            return AnalyticsClientFactory::createForConfig($analyticsConfig);
        });

        $this->app->bind(Analytics::class, function () {
            $analyticsConfig = config('analytics');

            $this->guardAgainstInvalidConfiguration($analyticsConfig);

            $client = app(AnalyticsClient::class);

            return new Analytics($client, Setting::get('general_analytics_view'));
        });

        $this->app->alias(Analytics::class, 'laravel-analytics');
    }

    protected function guardAgainstInvalidConfiguration(array $analyticsConfig = null)
    {
        if (!Setting::get('general_analytics_view')) {
            throw InvalidConfiguration::viewIdNotSpecified();
        }

        if (is_array($analyticsConfig['service_account_credentials_json'])) {
            return;
        }

        if (! file_exists($analyticsConfig['service_account_credentials_json'])) {
            throw InvalidConfiguration::credentialsJsonDoesNotExist($analyticsConfig['service_account_credentials_json']);
        }
    }
}
