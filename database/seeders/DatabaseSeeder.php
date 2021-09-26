<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        User::insert([
            'first_name' => 'Julião',
            'last_name' => 'Kataleko',
            'username' => 'juliaokataleko',
            'email' => 'juliofeli78@gmail.com',
            'password' => bcrypt(123456),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        $countries = [
            [
                'name' => 'Angola',
                'country_code' => 'AO',
            ],
            [
                'name' => 'Brasil',
                'country_code' => 'Br',
            ],
            [
                'name' => 'Portugal',
                'country_code' => 'PT',
            ],
            [
                'name' => 'United States of America',
                'country_code' => 'US',
            ],
            [
                'name' => 'United Kingdom',
                'country_code' => 'UK',
            ],
            [
                'name' => 'South Africa',
                'country_code' => 'SA',
            ],
        ];

        foreach ($countries as $key => $country) {
            Country::insert($country);
        }
    }
}
