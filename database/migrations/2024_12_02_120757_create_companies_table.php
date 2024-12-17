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
        Schema::create('companies', function (Blueprint $table) {
            // Define the primary key
            $table->bigIncrements('company_id');
            $table->string('name'); // Ensure the 'name' column exists
            $table->string('country');
            $table->string('city');
            $table->unsignedBigInteger('created_by')->nullable(); // Optional column
            $table->string('contact_email');
            $table->string('contact_phone');
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};