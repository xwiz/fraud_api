<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BanksTableSeeder extends BaseSeeder
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
            'name' => 'Access Bank PLC'
        ];
        $data[] = [
            'id' => 2,
            'name' => 'Afribank Nigeria PLC'
        ];
        $data[] = [
            'id' => 3,
            'name' => 'Diamond Bank PLC'
        ];
        $data[] = [
            'id' => 4,
            'name' => 'Ecobank Nigeria PLC'
        ];
        $data[] = [
            'id' => 5,
            'name' => 'Enterprise Bank LTD'
        ];
        $data[] = [
            'id' => 6,
            'name' => 'Fidelity Bank PLC'
        ];
        $data[] = [
            'id' => 7,
            'name' => 'First Bank PLC'
        ];
        $data[] = [
            'id' => 8,
            'name' => 'GuarantyTrust Bank PLC'
        ];
        $data[] = [
            'id' => 9,
            'name' => 'Heritage Bank PLC'
        ];
        $data[] = [
            'id' => 10,
            'name' => 'Keystone Bank PLC'
        ];
        $data[] = [
            'id' => 11,
            'name' => 'Skye Bank PLC'
        ];
        $data[] = [
            'id' => 12,
            'name' => 'Stanbic IBTC Bank PLC'
        ];
        $data[] = [
            'id' => 13,
            'name' => 'Standered Chartered Bank Nigeria LTD'
        ];
        $data[] = [
            'id' => 14,
            'name' => 'Union Bank of Nigeria PLC'
        ];
        $data[] = [
            'id' => 15,
            'name' => 'United Bank for Africa PLC'
        ];
        $data[] = [
            'id' => 16,
            'name' => 'Unity Bank PLC'
        ];
        $data[] = [
            'id' => 17,
            'name' => 'Wema Bank PLC'
        ];
        $data[] = [
            'id' => 18,
            'name' => 'Zenith Bank PLC'
        ];
        
        $this->truncateAndInsert('banks', $data);
    }
}
