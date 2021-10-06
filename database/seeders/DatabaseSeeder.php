<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\Department;
use App\Models\State;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'first_name' => 'Julião',
            'last_name' => 'Kataleko',
            'username' => 'juliaokataleko',
            'email' => 'juliofeli78@gmail.com',
            'password' => bcrypt(123456),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        \App\Models\User::factory(1000)->create();

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

        for ($kata=0; $kata < 2; $kata++) {
            Department::insert([
                'name' => "Department #$kata",
                'manager_id' => 1
            ]);
        }

        // permissions
        $role = Role::create(['name' => 'super_admin']);
        $role1 = Role::create(['name' => 'admin']);

        $add = Permission::create(['name' => 'add employees']);
        $edit = Permission::create(['name' => 'edit employees']);
        $delete = Permission::create(['name' => 'delete employees']);
        $show = Permission::create(['name' => 'show employees']);

        $role->givePermissionTo($add);
        $role->givePermissionTo($edit);
        $role->givePermissionTo($delete);
        $role->givePermissionTo($show);

        $role1->givePermissionTo($add);
        $role1->givePermissionTo($edit);
        $role1->givePermissionTo($delete);
        $role1->givePermissionTo($show);

        // Roles permissions
        $add = Permission::create(['name' => 'add roles']);
        $show = Permission::create(['name' => 'show roles']);
        $edit = Permission::create(['name' => 'edit roles']);
        $delete = Permission::create(['name' => 'delete roles']);

        $role->givePermissionTo($add);
        $role->givePermissionTo($show);
        $role->givePermissionTo($edit);
        $role->givePermissionTo($delete);

        // permissions permissions
        $add = Permission::create(['name' => 'add permissions']);
        $show = Permission::create(['name' => 'show permissions']);
        $edit = Permission::create(['name' => 'edit permissions']);
        $delete = Permission::create(['name' => 'delete permissions']);

        $role->givePermissionTo($add);
        $role->givePermissionTo($show);
        $role->givePermissionTo($edit);
        $role->givePermissionTo($delete);

        // add permissions to super_admin
        $admin = User::find(1);
        $admin->assignRole('super_admin');
    }
}
