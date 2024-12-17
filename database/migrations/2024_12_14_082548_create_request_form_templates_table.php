<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestFormTemplatesTable extends Migration
{
    public function up()
    {
        Schema::create('request_form_templates', function (Blueprint $table) {
            $table->id('Form_id'); // Primary key
            $table->string('form_name');
            $table->text('fields');
            $table->unsignedBigInteger('created_by'); // Match type with users table
            $table->unsignedBigInteger('company_id'); // Match type with companies table
            $table->timestamps();

            // Set foreign keys
            $table->foreign('created_by')->references('user_id')->on('users')->onDelete('cascade'); // Reference user_id
            $table->foreign('company_id')->references('company_id')->on('companies')->onDelete('cascade'); // Reference company_id
        });
    }

    public function down()
    {
        Schema::dropIfExists('request_form_templates');
    }
}