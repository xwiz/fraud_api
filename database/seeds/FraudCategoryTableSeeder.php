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
                'description' => ''
            ],
            [
                'id' => Config::get('constants.fraud_categories.partial_poor_quality_products_delivery'),
                'name' => 'Partial/Poor Quality Products Delivery',
                'description' => ''
            ],
            [
                'id' => Config::get('constants.fraud_categories.fake_undelivered_product_service_offerings'),
                'name' => 'Fake/Undelivered Product/Service Offerings',
                'description' => ''
            ],
            [
                'id' => Config::get('constants.fraud_categories.phising_websites'),
                'name' => 'Fake/Phising Websites',
                'description' => ''
            ],
            [
                'id' => Config::get('constants.fraud_categories.yahoo_yahoo_scam'),
                'name' => 'Product',
                'description' => 'Yahoo/African Prince Scam'
            ],
            
        ];
        $this->truncateAndInsert('fraud_categories', $data);
    }

}
