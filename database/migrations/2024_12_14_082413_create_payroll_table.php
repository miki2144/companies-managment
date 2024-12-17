<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollTable extends Migration
{
    public function up()
    {
        Schema::create('payroll', function (Blueprint $table) {
            $table->id('Payroll_id');
            $table->unsignedBigInteger('user_id'); // Reference user_id in the users table
            $table->string('pay_period');
            $table->decimal('basic_salary', 10, 2);
            $table->decimal('allowances', 10, 2)->nullable();
            $table->decimal('deductions', 10, 2)->nullable();
            $table->decimal('net_salary', 10, 2);
            $table->string('status', 20);
            $table->unsignedBigInteger('Prepared_by'); // Foreign key to users table
            $table->unsignedBigInteger('approved_by')->nullable(); // Foreign key to users table
            $table->timestamps();

            // Add the 'company_id' column and foreign key constraint
            $table->unsignedBigInteger('company_id');  // Foreign key to companies table
            $table->foreign('company_id')->references('company_id')->on('companies')->onDelete('cascade'); // Change to company_id

            // Add the foreign key constraints for users
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade'); // Updated here
            $table->foreign('Prepared_by')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('approved_by')->references('user_id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('payroll');
    }
}
