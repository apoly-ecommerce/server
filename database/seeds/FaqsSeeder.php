<?php

use Carbon\Carbon;

class FaqsSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('faq_topics')->insert([
            [
                'id' => 1,
                'name' => 'Overview',
                'for' => 'Merchant',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],[
                'id' => 2,
                'name' => 'Sell your items',
                'for' => 'Merchant',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],[
                'id' => 3,
                'name' => 'Pricing',
                'for' => 'Merchant',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);

        $faqs = json_decode(file_get_contents(__DIR__ . '/data/faqs.json'), true);

        foreach ($faqs as $faq) {
            \DB::table('faqs')->insert([
                'question' => $faq['question'],
                'answer' => $faq['answer'],
                'faq_topic_id' => $faq['faq_topic_id'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
