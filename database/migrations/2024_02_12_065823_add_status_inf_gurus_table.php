<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusInfGurusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inf_gurus', function (Blueprint $table) {
            $table->enum('status_masuk', ['masuk', 'tidak'])->default('masuk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inf_gurus', function (Blueprint $table) {
            $table->dropColumn('status_masuk');
        });
    }
}
