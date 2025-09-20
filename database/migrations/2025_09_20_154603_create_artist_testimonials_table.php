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
        Schema::create('artist_testimonials', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('artist_profile_id');
            $table->foreign('artist_profile_id')
                ->references('id')
                ->on('artist_profile')
                ->onDelete('cascade');

            $table->longText('content')->nullable();
            $table->string('endorser');
            $table->string('endorser_title')->nullable();

            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('priority')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artist_testimonials');
    }
};
