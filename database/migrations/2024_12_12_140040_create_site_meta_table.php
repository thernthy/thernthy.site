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
        Schema::create('site_meta', function (Blueprint $table) {
            $table->id('meta_s_id');
            $table->string('meta_key'); // Key for the meta tag (e.g., 'keywords', 'description')
            $table->text('meta_value'); // Value for the meta tag
            $table->enum('locale', ['en', 'kh'])->default('en');
            $table->timestamps(); // For created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_meta');
    }
};
