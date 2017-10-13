<?php
/**
 * Returns application constants
 */
return [
    //in minutes, 1 hour
    'API_TOKEN_EXPIRY_VALUE' => 60,
    'severity' => [
        'low' => 1,
        'average' => 2,
        'high' => 3,
    ],
    'item_types' => [
        'product' => 1,
        'service' => 2,
    ],
    'fraud_categories' => [
        'fake_events_programs' => 1,
        'partial_poor_quality_products_delivery' => 2,
        'fake_undelivered_product_service_offerings' => 3,
        'phising_websites' => 4,
        'yahoo_yahoo_scam' => 5,
    ],
];