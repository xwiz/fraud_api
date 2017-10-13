<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FraudCasesTableSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data[] = [
            'id' => 1,
            'user_id' => 1,
            'scam_start_date' => '',
            'scam_realization_date' => '',
            'severity_id' => Config::get(),
            'amount_scammed_off' => '',
            'fraud_category_id' => '',
            'scammer_name' => '',
            'scammer_real_name' => '',
            'item_type_id' => '',
            'item_name' => '',

        ];
        $this->truncateAndInsert('fraud_cases', $data);
    }
}
