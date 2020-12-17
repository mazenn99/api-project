<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQaQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qa_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title' , 120);
            $table->text('description');
            $table->timestamp('post_date')->useCurrent();
            $table->integer('views_count')->default(1);
            $table->string('tags' , 200)->nullable();
            $table->tinyInteger('closed')->default(0);
            $table->integer('category')->default(1);
            $table->integer('points')->default(10);
            $table->timestamp('last_update')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('qa_questions');
    }
}
