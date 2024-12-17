<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateBudgetForecastingTable extends Migration
{
    public function up()
    {
        Schema::create('budget_forecasting', function (Blueprint $table) {
            $table->id('Budget_id');
            $table->unsignedBigInteger('created_by'); // Match type with users table
            $table->string('forecast_period');
            $table->decimal('forecast_amount', 10, 2);
            $table->decimal('actual_amount', 10, 2)->nullable();
            $table->text('description')->nullable();
            $table->text('comment')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable(); // Match type with users table
            $table->timestamps();

            // Set foreign keys
            $table->foreign('created_by')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('approved_by')->references('user_id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('budget_forecasting');
    }
}