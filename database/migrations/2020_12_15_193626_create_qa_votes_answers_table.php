<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQaVotesAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qa_votes_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('qa_answer_id');
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('vote_code_up')->nullable();
            $table->tinyInteger('vote_code_down')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('qa_votes_answers');
    }
}
