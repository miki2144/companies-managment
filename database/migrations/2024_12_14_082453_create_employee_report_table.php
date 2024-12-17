<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateEmployeeReportTable extends Migration
{
    public function up()
    {
        Schema::create('employee_report', function (Blueprint $table) {
            $table->id('report_id');
            $table->unsignedBigInteger('employee_id'); // Match type with users table
            $table->string('week');
            $table->text('report');
            $table->text('comment')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();

            // Set foreign keys
            $table->foreign('employee_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('employee_report');
    }
}