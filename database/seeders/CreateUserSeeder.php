<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $admin = User::create([
            'email' => 'admin@mail.test',
            'password' => bcrypt('rahasia')
        ]);

        $roleAdmin = Role::create(['name' => 'admin']);

        $admin->assignRole([$roleAdmin->id]);

        $customer = User::create([
            'email' => 'customer@mail.test',
            'password' => bcrypt('rahasia')
        ]);

        $roleCustomer = Role::create(['name' => 'customer']);

        $customer->assignRole([$roleCustomer->id]);
    }
}
