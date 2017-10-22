<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTagsTable extends Migration {

	public function up()
	{
		// Ne veut pas atteindre config/taggable[] !?! Donc Modifs..
		
		// TAGS table

//		Schema::create(config('taggable.tags_table_name'), function(Blueprint $table) {
		Schema::create('tags', function(Blueprint $table) {
			$table->increments('id');
			$table->string('slug')->unique();
			$table->string('name')->unique();
			$table->text('description')->nullable();
			$table->boolean('suggest')->default(false);
			$table->integer('count')->unsigned()->default(0); // count of how many times this tag was used

			// For: Baum Nested Set
			// See: https://github.com/etrepat/baum#migration-configuration
			$table->integer('parent_id')->nullable();
			$table->integer('lft')->nullable();
			$table->integer('rgt')->nullable();
			$table->integer('depth')->nullable();
			
			// If Use SoftDelete
            $table->softDeletes();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();
		});

		// TAGGABLE table
		
//		Schema::create(config('taggable.taggables_table_name'), function(Blueprint $table) {
		Schema::create('taggables', function(Blueprint $table) {
			$table->increments('id');
			if(config('taggable.primary_keys_type') == 'string') {
				$table->string('taggable_id', 36)->index();
			} else {
				$table->integer('taggable_id')->unsigned()->index();
			}
			$table->string('taggable_type')->index();
			$table->integer('tag_id')->unsigned()->index();
			
            $table->foreign('tag_id')
//                ->references('id')->on(config('taggable.tags_table_name'))
                ->references('id')->on('tags')
                ->onDelete('cascade');
		});
	}

	public function down()
	{
//		Schema::drop(config('taggable.tags_table_name'));
//		Schema::drop(config('taggable.taggables_table_name'));
		Schema::drop('tags');
		Schema::drop('taggables');
	}
}
