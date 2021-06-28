<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('TimezonesSeeder');
        $this->call('CurrenciesSeeder');
        $this->call('CountriesSeeder');
        $this->call('StatesSeeder');
        $this->call('RolesSeeder');
        $this->call('UsersSeeder');
        $this->call('ModulesSeeder');
        $this->call('PermissionsSeeder');
        $this->call('AddressTypesSeeder');
        $this->call('CategoryGroupsSeeder');
        $this->call('CategorySubGroupsSeeder');
        $this->call('CategoriesSeeder');
        $this->call('ManufacturersSeeder');
        $this->call('ProductsSeeder');
        $this->call('SystemsSeeder');
        $this->call('BannerGroupsSeeder');
        $this->call('DemoSeeder');
        $this->call('FaqsSeeder');

        $this->command->info('====Lux.===// SEEDING COMPLETE ! //=======');

        Model::reguard();
    }
}
