<?php

use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
	        ['name' => 'English', 'slug' => 'english'],
	        ['name' => 'Korea', 'slug' => 'english'],
	        ['name' => 'Japan', 'slug' => 'english']
	    ];
        DB::table('languages')->insert($data);
	    // foreach($data as $row){
	    // 	DB::table('languages')->insert($data);
	    // }
    }
}
