<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('signature')->nullable()->comment('Digital Device Signature');
            $table->string('full_name')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->text('comment');
            $table->bigInteger('commentable_id')->unsigned();
            $table->string('commentable_type');
            $table->boolean('status')->default(0);
            $table->timestamp('approved_at')->nullable();
            $table->unsignedBigInteger('approved_by')->index()->nullable();

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
        Schema::dropIfExists('comments');
    }
}
