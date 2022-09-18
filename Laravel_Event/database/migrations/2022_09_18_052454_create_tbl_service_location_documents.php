<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblServiceLocationDocuments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_service_location_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('location_id');
            $table->unsignedBigInteger('document_id');
            $table->foreign('service_id')->references('id')->on('tbl_services')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('location_id')->references('id')->on('tbl_locations')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('document_id')->references('id')->on('tbl_documents')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_service_location_documents');
    }
}
