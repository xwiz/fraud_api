<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FraudWebsitesTableSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data[] = 
        [
            'id' => 1,
            'fraud_case_id' => 1,
            'website_url' => 'http://scamng.com',
            'bank_id' => 1
        ];
        $data[] = 
        [
            'id' => 2,
            'fraud_case_id' => 2,
            'website_url' => 'http://fraudatweb.ng',
            'bank_id' => 2
        ]; 
        $this->truncateAndInsert('fraud_websites', $data);
    }
}
