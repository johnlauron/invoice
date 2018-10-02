<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceInputTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_input', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('file_id')->nullable();
            $table->string('category_name', 100);
            $table->integer('xloc');
            $table->integer('yloc');
            $table->integer('height');
            $table->integer('width');
            $table->string('section');
            $table->string('alignment');
            $table->string('character');
            $table->unsignedInteger('form_name_id');
            $table->unsignedInteger('company_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_input');
    }
}
