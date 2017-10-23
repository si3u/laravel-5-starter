<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actus', function (Blueprint $table) {
            $table->increments('id')->unique()->index();
            $table->string('title');
            $table->string('summary')->nullable();
            $table->string('keywords')->nullable();
			$table->enum('is_tagged', array('yes', 'no'))->default('no'); // ajout laravel-taggable
            $table->text('content');
            $table->string('slug');
            $table->timestamp('active_from')->nullable(); // aka posted_at (default now)
            $table->timestamp('active_to')->nullable(); 
            $table->bigInteger('total_views')->unsigned()->default(0);
            $table->bigInteger('facebook_shares')->unsigned()->default(0);
            $table->bigInteger('twitter_shares')->unsigned()->default(0);
            $table->bigInteger('pinterest_shares')->unsigned()->default(0);
            $table->bigInteger('googleplus_shares')->unsigned()->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('actus');
    }
}