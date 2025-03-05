<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChannelSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('token_telegram')->after('color')->nullable()->default('6159396277:AAGEQ3KjI227tvYKu6K53xQpqC7IxPS0HIQ');
            $table->string('channel_post')->after('color')->nullable()->default('1001949676824');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('token_telegram');
            $table->dropColumn('channel_post');
        });
    }
}
