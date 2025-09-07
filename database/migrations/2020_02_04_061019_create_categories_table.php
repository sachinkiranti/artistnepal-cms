<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('unique_identifier')->nullable()->unique();

            $table->unsignedInteger('parent_id')->default(0);
            $table->string('category_name')->unique();
            $table->string('slug')->unique();

            $table->text('description')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->boolean('status')->default(1);

            $table->foreign('created_by')->references('id')
                ->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('categories');
    }
}
