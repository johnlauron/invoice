<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveFileId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoice_input', function (Blueprint $table) {
            $table->dropForeign('invoice_input_file_id_foreign');
            $table->dropColumn('file_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoice_input', function (Blueprint $table) {
            $table->unsignedInteger('file_id')->nullable();
        });
    }
}
