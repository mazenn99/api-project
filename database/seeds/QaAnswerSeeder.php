<?php

use Illuminate\Database\Seeder;

class QaAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\qa_answers::class , 500)->create();
    }
}
