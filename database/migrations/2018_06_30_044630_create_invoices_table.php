<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('invoices')){
            Schema::create('invoices', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('company_id');
                $table->string('invoice_name','191');
                $table->string('file_location','191');
                $table->unique(['company_id','invoice_name','file_location']);
                $table->unsignedInteger('form_name_id')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
