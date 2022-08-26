<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInfoGuruIzinTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('izins', function (Blueprint $table) {
            $table->foreignIdFor(User::class, "guru_id")->constrained('users');
            $table->string('guru_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('izins', function (Blueprint $table) {
            $table->dropColumn("guru_id");
            $table->dropColumn("guru_name");
        });
    }
}
