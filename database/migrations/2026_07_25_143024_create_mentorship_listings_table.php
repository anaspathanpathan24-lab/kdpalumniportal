<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mentorship_listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title'); // e.g., "Diploma to Degree Guidance"
            $table->string('expertise_areas'); // e.g., "IT, Software Engineering, Interview Prep"
            $table->text('description'); // Detailed bio about how they can help
            $table->boolean('is_available')->default(true); // Toggle for accepting mentees
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mentorship_listings');
    }
};