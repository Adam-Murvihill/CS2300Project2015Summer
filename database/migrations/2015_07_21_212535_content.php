<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Content extends Migration
{
    /**
     * Run the migrations.
     
     * @return void
     */
    public function up()
    {
        Schema::create('contentdb',function(Blueprint $table)
         {
	$table ->string('contentname',30);
	$table ->integer('FileeID')->unsigned();
	$table ->string('name');
	$table ->float('rating');
	$table ->integer('num_ratrs');
	$table ->increments('filenumber');
	$table ->string('contentlink',75) ->unique();
	$table->foreign('name') ->references('name')->on('users')->onDelete('cascade');
       });

        Schema::table('contentdb', function($table) {
            $table->foreign('FileeID')->references('FileID')->on('contentfolderdb')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('contentdb');
    }
}
