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
        Schema::table('newposts', function (Blueprint $table) {
            $table->binary('post_image')->after('post_des');
            $table->string('post_url')->after('post_des');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('newposts', function (Blueprint $table) {
            //
        });
    }
};
