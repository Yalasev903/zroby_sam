<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TopicsCitiesSkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('topics')->insert([
            ['name' => 'Будівництво'],
            ['name' => 'Б’юті'],
        ]);

        DB::table('cities')->insert([
            ['name' => 'Київ'],
            ['name' => 'Львів'],
            ['name' => 'Одеса'],
        ]);

        DB::table('skills')->insert([
            ['name' => 'Майстер сантехнік'],
            ['name' => 'Майстер манікюру'],
            ['name' => 'Парикмахер'],
        ]);
    }
}
