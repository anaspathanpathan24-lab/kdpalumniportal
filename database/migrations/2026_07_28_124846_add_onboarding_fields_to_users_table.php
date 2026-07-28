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
        Schema::table('users', function (Blueprint $table) {
            // We removed 'role' because it already exists in your database.
            
            $table->string('phone')->nullable()->after('email');
            $table->string('degree')->nullable();
            $table->string('department')->nullable();
            $table->string('year_joining')->nullable();
            $table->string('graduation_year')->nullable();
            $table->string('entry_no')->nullable();
            
            // Adding the professional fields for the Alumni Directory (Option 3)
            $table->string('company')->nullable();
            $table->string('designation')->nullable();
            $table->string('work_industry')->nullable();
            $table->string('skills')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'degree',
                'department',
                'year_joining',
                'graduation_year',
                'entry_no',
                'company',
                'designation',
                'work_industry',
                'skills'
            ]);
        });
    }
};