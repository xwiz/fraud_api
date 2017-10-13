<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FraudMobilesTableSeeder extends BaseSeeder
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
            'phone_number' => '07039000000'
        ];
        $data[] = 
        [
            'id' => 2,
            'fraud_case_id' => 3,
            'phone_number' => '07038888888'
        ];
        $data[] = 
        [
            'id' => 3,
            'fraud_case_id' => 4,
            'phone_number' => '09023456789'
        ];
        $this->truncateAndInsert('fraud_mobiles', $data);
    }
}
