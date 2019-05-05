<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('links')->truncate();
        $data = array(
            array('type' => 'b1', 'url' => ''),
            array('type' => 'b2', 'url' => ''),
            array('type' => 'b3', 'url' => ''),
            array('type' => 'b4', 'url' => ''),
            array('type' => 'b5', 'url' => ''),
            array('type' => 'p1', 'url' => ''),
            array('type' => 'p2', 'url' => ''),
            array('type' => 'p3', 'url' => ''),
            array('type' => 'p4', 'url' => ''),
            array('type' => 'p5', 'url' => ''),
            array('type' => 'e', 'url' => ''),
        );
        DB::table('links')->insert($data);
    }
}
