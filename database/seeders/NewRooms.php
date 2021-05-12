<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewRooms extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('chat_rooms')->insert([
            'name'=> 'Główny 1'
            'owner'=> 'Server'
        ]);
        DB::table('chat_rooms')->insert([
            'name'=> 'Główny 2'
            'owner'=> 'Server'
        ]);
    }
}
