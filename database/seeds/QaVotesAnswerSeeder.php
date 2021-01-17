<?php

use Illuminate\Database\Seeder;

class QaVotesAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\qa_votes_answer::class , 50)->create();
    }
}
