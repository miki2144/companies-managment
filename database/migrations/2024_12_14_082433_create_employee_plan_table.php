<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateEmployeePlanTable extends Migration
{
    public function up()
    {
        Schema::create('employee_plan', function (Blueprint $table) {
            $table->id('Plan_id');
            $table->unsignedBigInteger('employee_id'); // Match type with users table
            $table->string('week');
            $table->text('plan');
            $table->timestamp('submitted_at')->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();

            // Set foreign keys
            $table->foreign('employee_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('employee_plan');
    }
}