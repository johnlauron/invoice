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
        Schema::table('files', function($table)
        {
            $table->foreign('company_id')
                    ->references('id')->on('companies')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });
        Schema::table('invoice_input', function($table)
        {
            Schema::enableForeignKeyConstraints();
            $table->foreign('file_id')
                    ->references('id')->on('files')
                    ->onDelete('set null')
                    ->onUpdate('cascade');
        });
        Schema::table('forms', function($table)
        {
            $table->foreign('file_id')
                    ->references('id')->on('files')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });

        Schema::table('form_data', function($table)
        {
            $table->foreign('file_id')
                  ->references('id')->on('files')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
        Schema::table('invoice_input', function($table)
        {
            $table->foreign('company_id')
                  ->references('id')->on('companies')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
        // Schema::table('users', function($table)
        // {
        //     $table->foreign('company_id')
        //           ->references('id')->on('companies')
        //           ->onDelete('set null')
        //           ->onUpdate('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('files', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropForeign(['doc_id']);
            $table->dropForeign(['form_name_id']);
        });
    }
}
