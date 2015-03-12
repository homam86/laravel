<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class InitDbSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        $date = '';
        $users = array(
            array('Houmam', 'houmam@useinsider.com', '1234'),
            array('Ömer', 'omer@useinsider.com', '1234'),
            array('Bünyamin', 'bunyamin@useinsider.com', '1234'),
            array('Evren:', 'evren@useinsider.com', '1234'),
            array('Cholpon', 'cholpon@useinsider.com', '1234'),
        );
        foreach($users as $u) {
            DB::table('users')->insert(array(
                'name' => $u[0],
                'email' => $u[1],
                'password' => Hash::make($u[2]),
                'created_at' => DB::raw('CURRENT_TIMESTAMP')
            ));
        }

        $meals = array(
            array('Etli Taze Fasulye','Lunch'),
            array('Etli Nohut Yemeği','Lunch'),
            array('Salçali Patatesli Misket Köfte','Lunch'),
            array('Etli Patlican','Lunch'),
            array('Kiymali Firin Patates','Lunch'),
            array('Firin Pirzola','Lunch'),
            array('Mantarli Etli Sebzeli Kebab','Lunch'),
            array('Etli Kabak Sote','Lunch'),
            array('Yumurtali Firin Ispanak','Lunch'),
            array('Pirinç Pilavi','Lunch'),
            array('Bulgur Pilavi','Lunch'),
            array('Salçali Makarna','Lunch'),
            array('Mercimek Çorbasi','Snack'),
            array('Şehriyeli Domates Çorbasi','Snack'),

            array('Adana Dürüm','Dinner'),
            array('Urfa Dürüm','Dinner'),
            array('Tavuk Şiş Dürüm','Dinner'),
            array('Adana Porsiyon','Dinner'),
            array('Urfa Porsiyon','Dinner'),
            array('Tavuk Şiş Porsiyon','Dinner'),
            array('Izgara Kanat','Dinner'),
            array('Domatesli Kebap','Dinner'),
            array('Yoğurtlu Kebap','Dinner'),
            array('Tavuk Bonfile','Dinner'),
            array('Tavuklu Salata','Dinner'),
            array('Akdeniz Salata','Dinner'),
            array('Ton Balıklı Salata','Dinner'),
            array('Üç Peynirl Salata ','Dinner'),
            array('Izgara Tavuklu Salata','Dinner'),
            array('Sezar Salata','Dinner'),
            array('Tavuklu Fetuçini','Dinner'),
            array('Mantarlı Fetuçini','Dinner'),
            array('Tavuklu Mantarlı Fetuçini','Dinner'),
            array('Acılı Penne Arabiata','Dinner'),
            array('Domates Soslu Spagetti','Dinner'),
            array('Bolonez Soslu Spagetti','Dinner'),
            array('Naneli Yoğurtlu Makarna','Dinner'),
            array('Ev Mantısı','Dinner'),
            array('Izgara Köfte','Dinner'),

            array('Mevsim Salata','Snack'),
            array('Çoban Salata','Snack'),

            array('Firin Sütlaç','Snack'),
        );
        foreach($meals as $m) {
            DB::table('meals')->insert(array(
                'name' => $m[0],
                'type' => $m[1],
                'enabled' => 1,
            ));
        }

	}

}
