<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyAccessTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('access_tokens', function (Blueprint $table) {
            $table->dropForeign('access_tokens_FK1');

            $table->foreign('user_id', 'access_tokens_FK1')
                ->references('user_id')->on('user_authentications')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('access_tokens', function (Blueprint $table) {
            $table->dropForeign('access_tokens_FK1');
        });
    }
}
