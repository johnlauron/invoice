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
            // $table->unsignedInteger('invoice_id');
            // $table->string('name', 100)->unique();
            $table->integer('xloc');
            $table->integer('yloc');
            $table->integer('height');
            $table->integer('width');
            $table->unsignedInteger('form_name_id');
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
