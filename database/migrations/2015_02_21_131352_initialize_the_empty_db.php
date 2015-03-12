<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitializeTheEmptyDb extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

        Schema::create('meals', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name', 60)->unique();
            $table->enum('type', array('Lunch','Dinner', 'Snack'));
            $table->boolean('enabled')->default(1);
        });

        Schema::create('daily_menu', function(Blueprint $table)
        {
            $table->increments('id')->unsigned();
            $table->date('date')->unique();
            $table->text('note');
            $table->timestamps();
        });

        Schema::create('daily_menu_items', function(Blueprint $table)
        {
            $table->increments('id')->unsigned();
            $table->integer('menu_id')->unsigned();
            $table->integer('meal_id')->unsigned();
            $table->enum('period', array('Lunch', 'Dinner', 'Breakfast'));
        });

        Schema::create('reservations', function(Blueprint $table)
        {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('item_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('item_id')->references('id')->on('daily_menu_items');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('reservations');
        Schema::drop('daily_menu_items');
        Schema::drop('daily_menu');
        Schema::drop('meals');
	}

}
