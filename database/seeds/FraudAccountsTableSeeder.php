<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FraudAccountsTableSeeder extends BaseSeeder
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
            'account_no' => '3031234567',
            'bank_id' => 1,
            'account_name' => 'Aliko David',
            'fraud_case_id' => 1
        ];
        $data[] = [
            'id' => 2,
            'account_no' => '3037654321',
            'bank_id' => 1,
            'account_name' => 'Aliko Daniel',
            'fraud_case_id' => 1
        ];
        $data[] = [
            'id' => 3,
            'account_no' => '3031234567',
            'bank_id' => 1,
            'account_name' => 'Aliko David',
            'fraud_case_id' => 2
        ];
        $data[] = [
            'id' => 4,
            'account_no' => '2000191022',
            'bank_id' => 7,
            'account_name' => 'Barry Moore',
            'fraud_case_id' => 3
        ];
    }
}
