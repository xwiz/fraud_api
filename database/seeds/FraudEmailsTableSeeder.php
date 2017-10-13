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
            'email' => 'fraudatweb@hotmail.com'
        ];
        $data[] = 
        [
            'id' => 2,
            'fraud_case_id' => 2,
            'email' => 'scammed@yahoo.com'
        ];
        $this->truncateAndInsert('fraud_emails', $data);
    }
}
