<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::factory()->create([
            'name' => 'admin'
        ]);
        Role::factory()->create([
            'name' => 'editor'
        ]);
    }
}
