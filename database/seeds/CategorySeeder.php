<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
	        ['name' => 'Action', 'slug' => 'action'],
	        ['name' => 'Comedy', 'slug' => 'comedy'],
	        ['name' => 'Crime', 'slug' => 'crime'],
	        ['name' => 'Drama', 'slug' => 'drama']
	    ];
        DB::table('categories')->insert($data);
	    // foreach($data as $row){
	    // 	DB::table('categories')->insert($row);
	    // }
    }
}
