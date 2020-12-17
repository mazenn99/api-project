<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQaAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qa_answers', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->tinyInteger('correct')->default(0)->comment('the only one answer should be correct for question \n0 : not correct choisen - default\n1 : correct choiced .');
            $table->timestamp('post_date')->useCurrent();
            $table->unsignedBigInteger('qa_question_id');
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('notify_answer')->default(0)->comment('record for notification , 0 not readed  , 1 is readed from user ');
            $table->tinyInteger('notify_correct')->default(0)->comment('notify the user was wrote the answer , when his answer is choosed as a correct answer , \n0 not readed\n1 is readed');
            $table->integer('points_answer')->default(20);
            $table->integer('points_correct')->default(50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('qa_answers');
    }
}
