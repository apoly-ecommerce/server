<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class BaseSeeder extends Seeder
{
    protected $disk;

    protected $dir;

    protected $demo_dir;

    public function __construct()
    {

    }


    /**
     * return random array elements
     *
     * @return void
     */
    public function array_random($array, $amount = 1)
    {
        $keys = array_rand($array, $amount);

        if ($amount == 1) {
            return $array[$keys];
        }

        $results = [];
        foreach ($keys as $key) {
            $results[] = $array[$key];
        }

        return $results;
    }
}