<?php


use Illuminate\Database\Seeder;

class SourcesSeeder extends Seeder
{
    public function run()
    {
        DB::table('sources')->insert([
            [
                'id' => 1,
                'title' => 'affise'
            ],
            [
                'id' => 2,
                'title' => 'pliri'
            ]
        ]);
    }
}