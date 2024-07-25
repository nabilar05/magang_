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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company')->constrained('clients')->onDelete('cascade');
            $table->string('contact_person',50)->nullable();
            $table->foreignId('product')->constrained('products')->onDelete('cascade');
            $table->string('version_program',255)->nullable();
            $table->foreignId('module')->constrained('modules')->onDelete('cascade');
            $table->enum('category', ['category1', 'category2', 'category3']); 
            $table->enum('urgent_level', ['level1', 'level2', 'level3']); 
            $table->string('database_name', 255)->nullable();
            $table->dateTime('date');
            $table->string('problem', 1000)->nullable();
            $table->string('attachment', 500)->nullable();
            $table->foreignId('assign_to')->constrained('users')->onDelete('cascade');
            $table->foreignId('assign_to_supervisor')->constrained('users')->onDelete('cascade');
            $table->dateTime('estimation_complation_date')->nullable();
            $table->string('program_version', 10)->nullable();
            $table->string('technical_note', 1000)->nullable();
            $table->boolean('is_done')->nullable()->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};