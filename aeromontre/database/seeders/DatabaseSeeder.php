<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use illuminate\Support\Facades\DB;
use illuminate\support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /* User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',

        ]);*/
        DB::table('users')->insert([
            'name'=>'Ernesto de Dios',
            'email'=>'ernet99@hotmail..com',
            'password'=>Hash::make('Fil797178#')
        ]);


    }
}
