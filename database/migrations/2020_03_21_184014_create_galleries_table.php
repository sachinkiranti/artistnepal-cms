<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name', 100);
            $table->bigInteger('unique_identifier')->nullable()->unique();
            $table->string('slug')->nullable()->unique();
            $table->string('thumbnail')->nullable();
            $table->text('content')->nullable();
            $table->boolean('status')->default(1);

            $table->unsignedBigInteger('created_by');
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
        Schema::dropIfExists('galleries');
    }
}
