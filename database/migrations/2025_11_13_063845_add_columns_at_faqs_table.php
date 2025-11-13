<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('faqs', function (Blueprint $table) {
            $table->text('secondary_body')->after('body')->nullable();
            $table->tinyInteger('type')->after('secondary_body')->default(\Foundation\Enums\FaqType::GENERAL);
            $table->tinyInteger('priority')->after('type')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('faqs', function (Blueprint $table) {
            $table->dropColumn([
                'secondary_body',
                'type',
                'priority',
            ]);
        });
    }
};
