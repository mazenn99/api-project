<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fullName');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('twitter' , 45)->nullable();
            $table->string( 'bio' , '200')->nullable();
            $table->string('askfm' , '45')->nullable();
            $table->string('linkedin' , '45')->nullable();
            $table->text('imgPath')->nullable();
            $table->unsignedBigInteger('facebookID')->nullable();
            $table->unsignedBigInteger('twitterID')->nullable();
            $table->string('facebook' , 45)->nullable();
            $table->string('user_university' , 35)->nullable();
            $table->string('user_specialist' , 35)->nullable();
            $table->string('user_region' , 35)->nullable();
            $table->tinyInteger('agreement')->default(0);
            $table->string('user_faculity' , 50)->nullable()->comment('faculity of user');
            $table->integer('group')->default(1)->comment('user category group');
            $table->integer('user_level')->default(5);
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
        Schema::dropIfExists('users');
    }
}
