<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;



class CreateArchivedDocumentsTable extends Migration
{
    public function up()
    {
        Schema::create('archived_documents', function (Blueprint $table) {
            $table->id('Document_id'); // Primary key
            $table->string('document_name');
            $table->string('document_type');
            $table->unsignedBigInteger('document_owner'); // Match type with users table
            $table->text('description')->nullable();
            $table->unsignedBigInteger('company_id'); // Match type with companies table
            $table->timestamps();

            // Set foreign keys explicitly
            $table->foreign('document_owner')->references('user_id')->on('users')->onDelete('cascade'); // Reference user_id
            $table->foreign('company_id')->references('company_id')->on('companies')->onDelete('cascade'); // Reference company_id
        });
    }

    public function down()
    {
        Schema::dropIfExists('archived_documents');
    }
}