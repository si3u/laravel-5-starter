<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserInvitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_invites', function (Blueprint $table) {
            $table->increments('id')->unique()->index();
            $table->string('email')->unique()->index();
            $table->string('roles', '30');
            $table->string('token', '70');
            $table->integer('invited_by')->unsigned();
            $table->timestamp('created_at');
            $table->timestamp('claimed_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_invites');
    }
}