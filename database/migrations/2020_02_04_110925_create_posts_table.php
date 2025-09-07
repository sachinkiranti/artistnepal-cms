<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('unique_identifier')->nullable()->unique();
            $table->string('title');
            $table->string('secondary_title')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->longText('content')->nullable();
            $table->bigInteger('views')->default(0);
            $table->string('image')->nullable();
            $table->tinyInteger('post_type')->default(0);
            $table->unsignedBigInteger('category_id')->default(0);
            $table->boolean('status')->default(1);
            $table->unsignedBigInteger('created_by');
            $table->string('seo_title', 150)->nullable();
            $table->string('seo_slug', 150)->nullable();
            $table->string('seo_desc', 150)->nullable();
            $table->string('seo_keywords', 150)->nullable();

            $table->tinyInteger('type')->default(0)->comment('normal/flash/hotnews');
            $table->dateTimeTz('published_date')->nullable();

            $table->boolean('disable_facebook_comment')->default(0);
            $table->boolean('disable_site_comment')->default(0);
            $table->boolean('disable_reaction')->default(0);

            $table->string('author')->nullable();
            $table->tinyInteger('media_display_type')
                ->default(\Foundation\Lib\PostType::MEDIA_TYPE_IMAGE);
            $table->longText('video_url')->nullable();

            $table->foreign('category_id')->references('id')
                ->on('categories')->onDelete('cascade');
            $table->foreign('created_by')->references('id')
                ->on('users')->onDelete('cascade')->nullable();

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
        Schema::dropIfExists('posts');
    }
}
