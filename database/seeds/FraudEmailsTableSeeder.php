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
            'email' => 'fraudatweb@hotmail.com',
            'bank_id' => 2
        ];
        $data[] = 
        [
            'id' => 2,
            'fraud_case_id' => 2,
            'email' => 'scammed@yahoo.com',
            'bank_id' => 8
        ];
        $this->truncateAndInsert('fraud_emails', $data);
    }
}
