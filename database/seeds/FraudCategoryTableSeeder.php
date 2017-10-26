<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FraudCategoryTableSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => Config::get('constants.fraud_categories.fake_events_programs'),
                'name' => 'Fake Event/Programs',
                'description' => "An event/program that never occured or wasn't scheduled."
            ],
            [
                'id' => Config::get('constants.fraud_categories.partial_poor_quality_products_delivery'),
                'name' => 'Partial/Poor Quality Products Delivery',
                'description' => 'A delivered product/service that is substandard or of poor quality compared to as Ordered/Proposed.'
            ],
            [
                'id' => Config::get('constants.fraud_categories.fake_undelivered_product_service_offerings'),
                'name' => 'Fake/Undelivered Product/Service Offerings',
                'description' => 'This describes a product that is never delivered.'
            ],
            [
                'id' => Config::get('constants.fraud_categories.phising_websites'),
                'name' => 'Fake/Phising Websites',
                'description' => 'This describes a website that disguises as a legitimate website to collect private information of a user.'
            ],
            [
                'id' => Config::get('constants.fraud_categories.yahoo_yahoo_scam'),
                'name' => 'Yahoo/African Prince Scam',
                'description' => 'A mail/message from an African to deceive/scam a recepient.'
            ]
            
        ];
        
        $this->truncateAndInsert('fraud_categories', $data);
    }

}
