<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        factory(\Wilgucki\LaravelAms\Models\Role::class)->create([
            'name' => 'Admin'
        ]);
    }
}
