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
            'fraud_case_id' => 3,
            'website_url' => 'unitybankng.com',
            'bank_id' => 16
        ];
        $data[] = 
        [
            'id' => 2,
            'fraud_case_id' => 3,
            'website_url' => 'http://iscam.com',
            'bank_id' => 15
        ];
        
        $this->truncateAndInsert('fraud_websites', $data);
    }
}
