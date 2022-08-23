<?php

namespace Database\Seeders;

use App\Models\ApiUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ApiUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('api_users')->delete();

        ApiUser::create([
            'name' => 'login',
            'login' => 'login',
            'password' => Hash::make('password')
        ]);

    }
}
