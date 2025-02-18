<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pages', function (Blueprint $table) {
            $table->id('page_id');
            $table->string('page_slug')->unique(); // e.g., "about", "contact"
            $table->string('page_url')->nullable(); // Optional URL
            $table->longText('page_body'); // Store full page HTML
            $table->string('locale')->default(value: 'en'); // Language
            $table->integer('rela_page')->default(null); // Language
            $table->boolean('status')->default(true); // Language
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('pages');
    }
};
