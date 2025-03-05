<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTokenServiceApiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_api', function (Blueprint $table) { 
            $table->string('user')->after('api_key')->nullable();
            $table->string('password')->after('api_key')->nullable();
            $table->string('token')->after('api_key')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_api', function (Blueprint $table) {
            $table->dropColumn('user');
            $table->dropColumn('password');
            $table->dropColumn('token');
        });
    }
}
