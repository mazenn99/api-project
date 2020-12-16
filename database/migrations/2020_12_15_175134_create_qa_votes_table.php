<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQaVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qa_votes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('qa_question_id')->nullable()->comment('foreign key for questions table');
            $table->unsignedBigInteger('qa_answer_id')->nullable()->comment('foreign key for answer table');
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('vote_code_down')->default(0);
            $table->tinyInteger('vote_code_up')->default(0);
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
        Schema::dropIfExists('qa_votes');
    }
}
