<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class Userseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'firstName'=>'Vinicius',
            'lastName'=>'Goes',
            'email'=>'ramos.raphael0507@gmail.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
