<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNavsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navs', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('parent_id')->default(0);
            $table->tinyInteger('section')->default(\Foundation\Lib\Nav::PRIMARY_MENU);
            $table->tinyInteger('nav_li_type')->default(\Foundation\Lib\Nav::TYPE_CUSTOM_LINK);

            $table->string('label')->nullable();
            $table->string('value')->nullable()->comment('id/link');
            $table->integer('sort')->default(0);
            $table->string('class')->nullable();
            $table->string('icon')->nullable();
            $table->tinyInteger('target')->default(0);
            $table->lang();
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
        Schema::dropIfExists('navs');
    }
}
