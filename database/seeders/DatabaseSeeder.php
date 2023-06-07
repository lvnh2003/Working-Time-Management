<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        DB::table('users')->insert(
            [
                'name'=>'admin',
                'activeToken'=>bcrypt('admin@gmail.com'),
                'email'=>'admin@gmail.com',
                
            ]
           
        ) ;

        DB::table('logins')->insert(
            [
                'email'=>'admin@gmail.com',
                'password'=>bcrypt('123456'),
                'role'=>'0',
                'idUser'=>'1',
                'isActive'=>1
            ]
           
        ) ;
       
    }
}
