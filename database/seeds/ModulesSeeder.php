<?php

use Carbon\Carbon;

class ModulesSeeder extends BaseSeeder
{

    private $modules = [
        'Appearance' => [
            'access' => 'Platform',
            'actions' => 'customize'
        ],
        'Attribute' => [
            'access' => 'Common',
            'actions' => 'view,add,update,delete'
        ],
        'Category' => [
            'access' => 'Platform',
            'actions' => 'view,add,update,delete'
        ],
        'Config' => [
            'access' => 'Merchant',
            'actions' => 'view,edit'
        ],
        'Customer' => [
            'access' => 'Platform',
            'actions' => 'view,add,update,delete'
        ],
        'Module' => [
            'access' => 'Super Admin',
            'actions' => 'view,add,update,delete'
        ],
        'Role' => [
            'access' => 'Common',
            'actions' => 'view,add,update,delete',
        ],
        'User' => [
            'access' => 'Common',
            'actions' => 'view,add,update,delete'
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->modules as $name => $attributes)
        {
            if (! \DB::table('modules')->where('name', $name)->first()) {
                \DB::table('modules')->insert([
                    'name'        => $name,
                    'description' => 'Management all '.strtolower($name).'.',
                    'access'      => $attributes['access'],
                    'actions'     => $attributes['actions'],
                    'active'      => 1,
                    'created_at'  => Carbon::Now(),
                    'updated_at'  => Carbon::Now()
                ]);
            }
        }
    }
}