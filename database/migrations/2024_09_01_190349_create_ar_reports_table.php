<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ar_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'created_by')->nullable()->constrained('users')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignIdFor(User::class, 'updated_by')->nullable()->constrained('users')->cascadeOnUpdate()->nullOnDelete();
            $table->string('reportable_type');
            $table->string('reportable_resource');
            $table->string('title');
            $table->json('header')->nullable();
            $table->json('data')->nullable();
            $table->string('query')->nullable();
            $table->string('grouping_rows')->nullable();
            $table->string('font')->nullable();
            $table->string('export_type')->nullable();
            $table->string('header_description')->nullable();
            $table->string('report_date')->nullable();
            $table->string('logo')->nullable();
            $table->string('footer_description')->nullable();
            $table->text('description')->nullable();
            $table->integer('records_count')->nullable();
            $table->tinyInteger('step')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ar_reports');
    }
};
