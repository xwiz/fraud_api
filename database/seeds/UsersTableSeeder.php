<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'first_name' => 'Harry',
                'last_name' => 'Moses',
                'email' => 'harrymoses@gmail.com',
                'phone_number'=> '07031111111',
                'password' => bcrypt('qwerty')
            ],
            [
                'id' => 2,
                'first_name' => 'Marcos',
                'last_name' => 'Boanventure',
                'email' => 'marcos@yahoo.com',
                'phone_number'=> '08030000000',
                'password' => bcrypt('qwerty')
            ],
            [
                'id' => 3,
                'first_name' => 'Akintunde',
                'last_name' => 'Anike',
                'email' => 'a.anike@yahoo.com',
                'phone_number'=> '07032345678',
                'password' => bcrypt('qwerty')
            ],
            [
                'id' => 4,
                'first_name' => 'Alvaro',
                'last_name' => 'Santos',
                'email' => 'morata@yahoo.com',
                'phone_number'=> '2347030989898',
                'password' => bcrypt('qwerty')
            ],
            
        ];
        
        $this->truncateAndInsert('users', $data);
    }
    
}
