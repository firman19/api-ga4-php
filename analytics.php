<?php
require 'vendor/autoload.php';

use Google\Analytics\Data\V1beta\BetaAnalyticsDataClient;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Dimension;
use Google\Analytics\Data\V1beta\Filter;
use Google\Analytics\Data\V1beta\FilterExpression;
use Google\Analytics\Data\V1beta\Metric;

$property_id = '<PROPERTY_ID>';
$url = '\/';
$client = new BetaAnalyticsDataClient();

$response2 = $client->runReport([
    'property' => 'properties/' . $property_id,
    'dateRanges' => [
        new DateRange([
            'start_date' => '2022-05-10',
            'end_date' => '2022-06-08',
        ]),
    ],
    'dimensions' => [
        new Dimension([
            'name' => 'pagepath',
        ]),
    ],
    'dimensionFilter' => 
        new FilterExpression([
            'filter' => 
                new Filter([
                    'field_name' => 'pagepath',
                    'string_filter' => 
                        new Filter\StringFilter(
                            [
                                'match_type' => Filter\StringFilter\MatchType::FULL_REGEXP,
                                'value' => $url,
                            ]
                        )
                ])
        ])
    ,
    'metrics' => [
        new Metric([
            'name' => 'screenPageViews',
        ])
    ],
    'limit' => 10
]);

print 'Report result: ' . PHP_EOL;
foreach ($response2->getRows() as $row) {
    print $row->getDimensionValues()[0]->getValue()
        . ' ' . $row->getMetricValues()[0]->getValue() . PHP_EOL;
}
