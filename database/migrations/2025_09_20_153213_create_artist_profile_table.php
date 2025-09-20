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
        Schema::create('artist_profile', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->unique();
            $table->string('username')->unique()->nullable();

            $table->unsignedBigInteger('profession_id')->nullable();

            $table->text('banner_image')->nullable();
            $table->year('start_year')->nullable();
            $table->unsignedBigInteger('country_id')->nullable()->comment('Treat as birthplace');

            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();

            $table->string('email_address')->nullable();
            $table->string('telephone')->nullable();
            $table->string('mobile')->nullable();

            $table->json('social_links')->nullable();
            $table->longText('bio')->nullable();
            $table->longText('experiences')->nullable();

            $table->json('awards')->nullable();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('profession_id')
                ->references('id')
                ->on('categories')
                ->nullOnDelete();

            $table->tinyInteger('is_public')->default(0);
            $table->timestamp('verified_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artist_profile');
    }
};
