<?php

namespace App\Services;

use Google\Client;
use Google\Service\AnalyticsData;
use Google\Service\AnalyticsData\RunReportRequest;
use Google\Service\AnalyticsData\DateRange;
use Google\Service\AnalyticsData\Metric;
use Google\Service\AnalyticsData\Dimension;

class GoogleAnalyticsService
{
    protected $analytics;

    public function __construct()
    {
        $jsonPath = base_path(env('GOOGLE_SERVICE_ACCOUNT_JSON', ''));

        if (!file_exists($jsonPath)) {
            throw new \RuntimeException('Google service account JSON not found at: ' . $jsonPath);
        }

        $client = new Client();
        $client->setAuthConfig($jsonPath);
        $client->addScope('https://www.googleapis.com/auth/analytics.readonly');

        $this->analytics = new AnalyticsData($client);
    }

    public function getReport(): array
    {
        $propertyId = env('GOOGLE_ANALYTICS_PROPERTY_ID');

        if (empty($propertyId)) {
            throw new \RuntimeException('GOOGLE_ANALYTICS_PROPERTY_ID not set in .env');
        }

        $property = 'properties/' . $propertyId;

        $request = new RunReportRequest([
            'dateRanges' => [
                new DateRange([
                    'startDate' => '7daysAgo',
                    'endDate' => 'today',
                ])
            ],
            'metrics' => [
                new Metric(['name' => 'activeUsers']),
                new Metric(['name' => 'sessions']),
                new Metric(['name' => 'screenPageViews']),
            ],
            'dimensions' => [
                new Dimension(['name' => 'date']),
            ],
        ]);

        $response = $this->analytics->properties->runReport($property, $request);
        return $response->getRows() ?? [];
    }
}
