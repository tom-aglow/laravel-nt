<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToPrivilegeRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('privilege_role', function (Blueprint $table) {
//            $table->foreign('role_id')->references('id')->on('roles');
//            $table->foreign('privilege_id')->references('id')->on('privileges');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('privilege_role', function (Blueprint $table) {
//            $table->dropForeign('privilege_role_role_id_foreign');
//            $table->dropForeign('privilege_role_privilege_id_foreign');
        });
    }
}
