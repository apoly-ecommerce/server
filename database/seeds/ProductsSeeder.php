<?php

class ProductsSeeder extends BaseSeeder
{

    private $longCount = 30;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Product::class, $this->longCount)->create();
    }
}
