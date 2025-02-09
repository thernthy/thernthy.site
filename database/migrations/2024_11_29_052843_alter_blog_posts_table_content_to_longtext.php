<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->longText('content')->change(); // Change content column to longText
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->text('content')->change(); // Revert back if necessary
        });
    }
};
