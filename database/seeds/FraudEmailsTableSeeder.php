<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FraudEmailsTableSeeder extends BaseSeeder
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
            'email' => 'fraudweb@hotmail.com'
        ];
        $data[] = 
        [
            'id' => 2,
            'fraud_case_id' => 2,
            'email' => 'scammed@yahoo.com'
        ];
        $data[] = 
        [
            'id' => 3,
            'fraud_case_id' => 2,
            'email' => 'banks@outlook.com'
        ];
        $data[] = 
        [
            'id' => 5,
            'fraud_case_id' => 4,
            'email' => 'chargerseller@yahoo.com'
        ];
        $data[] = 
        [
            'id' => 6,
            'fraud_case_id' => 5,
            'email' => 'chargerseller@yahoo.com'
        ];

        $this->truncateAndInsert('fraud_emails', $data);
    }
}
