<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
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
            $id = Country::insertGetId($country);

            for ($i=0; $i < 10; $i++) {
                $state_code = State::insertGetId([
                    'name' => "State $i-$id",
                    'country_id' => $id
                ]);

                for ($ju=0; $ju < 10; $ju++) {
                    City::insert([
                        'name' => "City $ju-$state_code",
                        'state_id' => $state_code,
                        'country_id' => $id
                    ]);
                }
            }
        }
    }
}
