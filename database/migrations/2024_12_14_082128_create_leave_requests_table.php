<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateLeaveRequestsTable extends Migration
{
    public function up(): void
    {
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id('LeaveRequest_id');
            $table->unsignedBigInteger('user_id'); // Match the type with users table
            $table->date('start_date');
            $table->date('end_date');
            $table->text('reason');
            $table->string('status', 20);
            $table->unsignedBigInteger('approved_by')->nullable(); // Match the type with users table
            $table->timestamps();

            // Set foreign keys
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('approved_by')->references('user_id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leave_requests');
    }
}