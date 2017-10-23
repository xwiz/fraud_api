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
            'scam_start_date' => date("Y-m-d"),
            'scam_realization_date' => date("Y-m-d"),
            'severity_id' => 1,
            'amount_scammed_off' => '50000.00',
            'fraud_category_id' => 5,
            'scammer_name' => 'Prince Alabi',
            'scammer_real_name' => '',
            'item_type_id' => 1,
            'item_name' => 'Airport'

        ];
        $data[] = [
            'id' => 2,
            'user_id' => 2,
            'scam_start_date' => date("Y-m-d H:i:s"),
            'scam_realization_date' => date("Y-m-d H:i:s"),
            'severity_id' => 3,
            'amount_scammed_off' => '900000.00',
            'fraud_category_id' => 4,
            'scammer_name' => 'Diamond',
            'scammer_real_name' => '',
            'item_type_id' => 2,
            'item_name' => ''

        ];
        $data[] = [
            'id' => 3,
            'user_id' => 3,
            'scam_start_date' => date("Y-m-d H:i:s"),
            'scam_realization_date' => date("Y-m-d H:i:s"),
            'severity_id' => 1,
            'amount_scammed_off' => '1000.00',
            'fraud_category_id' => 2,
            'scammer_name' => 'pablo escobar',
            'scammer_real_name' => 'Alhaji Pablo George',
            'item_type_id' => 1,
            'item_name' => 'Phone Charger'

        ];
        $data[] = [
            'id' => 4,
            'user_id' => 3,
            'scam_start_date' => date("Y-m-d H:i:s"),
            'scam_realization_date' => date("Y-m-d H:i:s"),
            'severity_id' => 1,
            'amount_scammed_off' => '1500.00',
            'fraud_category_id' => 2,
            'scammer_name' => 'Diamond',
            'scammer_real_name' => 'Dotun James',
            'item_type_id' => 1,
            'item_name' => 'Phone Charger'

        ];
        $this->truncateAndInsert('fraud_cases', $data);
    }
}
