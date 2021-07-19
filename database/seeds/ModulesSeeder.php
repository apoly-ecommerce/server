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
            'actions' => 'view,add,edit,delete'
        ],
        'Category' => [
            'access' => 'Platform',
            'actions' => 'view,add,edit,delete'
        ],
        'Category Group' => [
            'access' => 'Platform',
            'actions' => 'view,add,edit,delete'
        ],
        'Category Sub Group' => [
            'access' => 'Platform',
            'actions' => 'view,add,edit,delete'
        ],
        'Chat Conversation' => [
            'access' => 'Merchant',
            'actions' => 'view,reply,delete'
        ],
        'Config' => [
            'access' => 'Merchant',
            'actions' => 'view,edit'
        ],
        'Coupon' => [
            'access' => 'Merchant',
            'actions' => 'view,add,edit,delete'
        ],
        'Cart' => [
            'access' => 'Common',
            'actions' => 'view,add,edit,delete'
        ],
        'Customer' => [
            'access' => 'Platform',
            'actions' => 'view,add,edit,delete'
        ],
        'Inventory' => [
            'access' => 'Merchant',
            'actions' => 'view,add,edit,delete'
        ],
        'Manufacturer' => [
            'access' => 'Common',
            'actions' => 'view,add,edit,delete'
        ],
        'Message' => [
            'access' => 'Common',
            'actions' => 'view,add,edit,delete'
        ],
        'Order' => [
            'access' => 'Common',
            'actions' => 'view,add,fulfill,cancel,archive,delete'
        ],
        'Product' => [
            'access' => 'Common',
            'actions' => 'view,add,edit,delete'
        ],
        'System' => [
            'access' => 'Super Admin',
            'actions' => 'view,edit'
        ],
        'System Config' => [
            'access' => 'Platform',
            'actions' => 'view,edit'
        ],
        'Vendor' => [
            'access' => 'Platform',
            'actions' => 'view,add,edit,delete,login'
        ],
        'Utility' => [
            'access' => 'Platform',
            'actions' => 'view,add,edit,delete'
        ],
        'Role' => [
            'access' => 'Common',
            'actions' => 'view,add,edit,delete',
        ],
        'User' => [
            'access' => 'Common',
            'actions' => 'view,add,edit,delete'
        ],
        'Country' => [
            'access' => 'Common',
            'actions' => 'view'
        ],
        'State' => [
            'access' => 'Common',
            'actions' => 'view'
        ],
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