<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreatePurchaseRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('purchase_requests', function (Blueprint $table) {
            $table->id('purchaseRequest_id');
            $table->unsignedBigInteger('user_id'); // Match type with users table
            $table->string('item_name');
            $table->integer('quantity');
            $table->decimal('estimated_cost', 10, 2);
            $table->string('status', 20);
            $table->text('comment')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable(); // Match type with users table
            $table->timestamps();

            // Set foreign keys
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('approved_by')->references('user_id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('purchase_requests');
    }
}