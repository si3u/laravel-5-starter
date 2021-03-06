<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    public function run(Faker\Generator $faker)
    {
        User::truncate();
        DB::delete('TRUNCATE role_user');

        //-------------------------------------------------
        // ADMIN
        //-------------------------------------------------
        $user = User::create([
            'firstname'    => 'Admin',
            'lastname'     => 'Admin',
            'cellphone'    => '01 23 45 67 89',
            'email'        => 'admin@mail.com',
            'gender'       => 'male',
            'password'     => bcrypt('12345678'),
            'confirmed_at' => Carbon::now()
        ]);

        $user->syncRoles([
            \App\Models\Role::$ADMIN,
            \App\Models\Role::$ADMIN_SUPER,
            \App\Models\Role::$DEVELOPER,
            \App\Models\Role::$ANALYTICS,
        ]);

        //-------------------------------------------------
        // Ben-Piet
        //-------------------------------------------------
        $user = User::create([
            'firstname'    => 'Ben-Piet',
            'lastname'     => 'O\'Callaghan',
            'cellphone'    => '123456789',
            'email'        => 'bpocallaghan@gmail.com',
            'gender'       => 'ninja',
            'password'     => bcrypt('password'),
            'confirmed_at' => Carbon::now()
        ]);

        $user->syncRoles([
            \App\Models\Role::$ADMIN,
            \App\Models\Role::$ADMIN_SUPER,
            \App\Models\Role::$DEVELOPER,
        ]);

        //-------------------------------------------------
        // GitHub
        //-------------------------------------------------
        $user = User::create([
            'firstname'    => 'Github',
            'lastname'     => 'Administrator',
            'cellphone'    => '123456789',
            'email'        => 'github@bpocallaghan.co.za',
            'gender'       => 'male',
            'password'     => bcrypt('github'),
            'confirmed_at' => Carbon::now()
        ]);

        $user->syncRoles([
            \App\Models\Role::$ADMIN,
            \App\Models\Role::$ADMIN_SUPER,
            \App\Models\Role::$DEVELOPER,
        ]);

        //-------------------------------------------------
        // Default Admin
        //-------------------------------------------------
        $user = User::create([
            'firstname'    => 'Admin',
            'lastname'     => 'Laravel Starter',
            'cellphone'    => '123456789',
            'email'        => 'admin@laravel-admin.dev',
            'gender'       => 'male',
            'password'     => bcrypt('admin'),
            'confirmed_at' => Carbon::now()
        ]);

        $user->syncRoles([
            \App\Models\Role::$ADMIN,
            \App\Models\Role::$ADMIN_SUPER,
            \App\Models\Role::$DEVELOPER,
        ]);

       /*for ($i = 0; $i < 30; $i++) {
            $user = User::create([
                'firstname'    => $faker->firstName,
                'lastname'     => $faker->lastName,
                'cellphone'    => $faker->phoneNumber,
                'email'        => $faker->email,
                'gender'       => $faker->randomElement(['male', 'female']),
                'password'     => bcrypt('secret'),
                'confirmed_at' => Carbon::now()
            ]);

            $user->syncRoles([
                \App\Models\Role::$ADMIN,
                \App\Models\Role::$ANALYTICS,
            ]);
        }*/
    }
}
