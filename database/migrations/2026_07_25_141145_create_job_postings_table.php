<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_postings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // The alumni posting the job
            $table->string('title');
            $table->string('company');
            $table->string('location')->nullable();
            $table->enum('employment_type', ['full-time', 'part-time', 'apprenticeship', 'internship', 'contract'])->default('full-time');
            $table->text('description');
            $table->string('application_link_or_email')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_postings');
    }
};