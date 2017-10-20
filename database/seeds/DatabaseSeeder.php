<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UsersTableSeeder::class);
        $this->call(FraudCategoryTableSeeder::class);
        $this->call(ItemTypesTableSeeder::class);
        $this->call(BanksTableSeeder::class);
        $this->call(SeverityTableSeeder::class);
        $this->call(FraudCasesTableSeeder::class);
        $this->call(FraudEmailsTableSeeder::class);
        $this->call(FraudWebsitesTableSeeder::class);
        $this->call(FraudMobilesTableSeeder::class);
        $this->call(FraudAccountsTableSeeder::class);
        $this->call(FraudCaseFilesTableSeeder::class);

        Model::reguard();
    }
}
