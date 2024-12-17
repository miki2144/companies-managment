<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryTable extends Migration
{
    public function up()
    {
        Schema::create('inventory', function (Blueprint $table) {
            $table->id('inventory_id');  // The custom primary key
            $table->string('item_name');
            $table->integer('quantity');
            $table->text('description')->nullable();
            $table->date('stock_in_date')->nullable();
            $table->date('stock_out_date')->nullable();
            $table->unsignedBigInteger('managed_by'); // Foreign key to users table
            $table->unsignedBigInteger('approved_by')->nullable(); // Foreign key to users table
            $table->timestamps();
    
            // Foreign keys with correct column references
            $table->foreign('managed_by')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('approved_by')->references('user_id')->on('users')->onDelete('set null');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('inventory');
    }
}
