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
        Schema::create('ar_countries', function (Blueprint $table) {
            $table->id();
            $table->string("fips");
            $table->string("iso");
            $table->string("domain");
            $table->string("fa_name");
            $table->string("en_name");
            $table->boolean("status")->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ar_countries');
    }
};
