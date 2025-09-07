<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUtilityColumnsToPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->boolean('is_author_visible')->default(1)->after('author');
            $table->boolean('is_thumbnail_visible')->default(1)->after('image');
//            $table->tinyInteger('watermark_position')->default(1)->after('has_watermark');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn([
                'is_author_visible',
                'is_thumbnail_visible',
//                'watermark_position',
            ]);
        });
    }
}
