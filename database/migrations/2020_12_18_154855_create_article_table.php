<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('environment' , 200)->comment('بيئة التدريب');
            $table->string('specialize' , 200)->comment('التخصص');
            $table->string('companyName' , 200)->comment('اسم جهة التدريب');
            $table->string('requirements' , 300)->comment('متطلبات التدريب');
            $table->string('contactRule' , 100)->comment('طريقة التواصل مع جهة التدريب');
            $table->integer('period')->comment('فترة التدريب بالاشهر');
            $table->longText('description')->comment('وصف التجربة');
            $table->string('category' , 45)->default('summer');
            $table->string('title' , 250)->nullable();
            $table->integer('numLikes')->default(0);
            $table->string('tags' , '35')->nullable();
            $table->integer('draft')->default('0')->comment('draft');
            $table->integer('view_count')->default(0)->comment('عداد المشاهدات للتجربة');
            $table->text('picture')->comment('صورة عرض التجربة - المقالة');
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
        Schema::dropIfExists('article');
    }
}
