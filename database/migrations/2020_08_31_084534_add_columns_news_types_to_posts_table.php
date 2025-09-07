<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsNewsTypesToPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->boolean('is_default_news')->default(0)->after('lang');
            $table->boolean('is_flash_news')->default(0)->after('is_default_news');
            $table->boolean('is_bises_news')->default(0)->after('is_flash_news');
            $table->boolean('is_pramukh_news')->default(0)->after('is_bises_news');
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
                'is_default_news', 'is_flash_news', 'is_bises_news', 'is_pramukh_news',
            ]);
        });
    }
}
