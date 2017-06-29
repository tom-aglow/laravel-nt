<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddActiveStatusToArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->tinyInteger('is_active')->after('content');
            $table->timestamp('active_from')->default(\Carbon\Carbon::now())->after('is_active');
            $table->timestamp('active_to')->nullable()->after('active_from');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('is_active');
            $table->dropColumn('active_from');
            $table->dropColumn('active_to');

        });
    }
}
