<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDropzoneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dropzone', function (Blueprint $table) {
			
            $table->increments('id')->unique()->unsigned();
            $table->integer('relation_id')->unsigned()->index();
            $table->string('relation_type', 10);
            $table->string('original_name', 50);
            $table->string('filename');
			
            $table->timestamps();
            $table->softDeletes();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();
			
            $table->foreign('relation_id')
                ->references('id')->on('articles')
                ->references('id')->on('actus')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('dropzone');
    }
}