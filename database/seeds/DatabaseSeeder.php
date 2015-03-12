<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

include_once 'InitDbSeeder.php';


class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

        $this->command->info('Executing DB initialization seeder:');
		$this->call('InitDbSeeder');
	}

}
