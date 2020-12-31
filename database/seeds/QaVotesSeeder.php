<?php

use Illuminate\Database\Seeder;

class QaVotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Qa_votes::class , 500)->create();
    }
}
