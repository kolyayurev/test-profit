<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $admin = User::factory()
            ->create([
                 'name' => 'Admin',
                 'email' => 'admin@site.com',
            ]);

        $admin->roles()->sync(Role::query()->where('name','Admin')->first());

        $editor = User::factory()
            ->create([
                'name' => 'Editor',
                'email' => 'editor@site.com',
            ]);

        $editor->roles()->sync(Role::query()->where('name','Editor')->first());

    }
}
