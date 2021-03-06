<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_us', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('article_id')->comment('رقم التجربة اللي عليها البلاغ');
            $table->unsignedBigInteger('user_id')->comment('رقم المستخدم الذي قدم البلاغ');
            $table->string('description')->nullable()->comment('وصف البلاغ');
            $table->string('status', 45)->default('pending')->comment('حالة البلاغ');
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
        Schema::dropIfExists('notices');
    }
}
