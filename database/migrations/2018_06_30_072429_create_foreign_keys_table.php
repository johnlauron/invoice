<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::table('invoices', function($table)
        {
            $table->foreign('company_id')
                    ->references('id')->on('companies')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });
        Schema::table('invoice_input', function($table)
        {
            Schema::enableForeignKeyConstraints();
            $table->foreign('invoice_id')
                    ->references('id')->on('invoices')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });
        Schema::table('forms', function($table)
        {
            $table->foreign('invoice_id')
                    ->references('id')->on('invoices')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });

        Schema::table('form_data', function($table)
        {
            $table->foreign('invoice_id')
                  ->references('id')->on('invoices')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foreign_keys');
    }
}
