<?php

namespace Wilgucki\LaravelAms\Tests;

use Faker\Factory;
use Faker\Generator;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Wilgucki\LaravelAms\Models\Admin;
use Wilgucki\LaravelAms\Models\Role;

class AmsAdminTest extends \TestCase
{
    use DatabaseMigrations;

    /**
     * @var Generator
     */
    protected $faker;

    public function setUp()
    {
        parent::setUp();
        $this->faker = Factory::create();
    }

    public function testCreateAdmin()
    {
        \Cache::shouldReceive('get')
            ->twice()
            ->with('ams_modules')
            ->andReturn([]);

        $role = factory(Role::class)->create();
        $admin = factory(Admin::class)->create([
            'role_id' => $role->id,
            'password' => 'Haslo.123',
            'is_superadmin' => true
        ]);

        $this->actingAs($admin);
        $this->visit('/ams/admin/create');
        $this->type($this->faker->name, 'name');
        $this->type($this->faker->email, 'email');
        $this->type('Haslo.123', 'password');
        $this->type('Haslo.123', 'password_confirmation');
        $this->press('btn_save');
        $this->seePageIs('/ams/admin');
    }

    public function testUpdateAdminWithoutPassword()
    {
        \Cache::shouldReceive('get')
            ->twice()
            ->with('ams_modules')
            ->andReturn([]);

        $role = factory(Role::class)->create();
        $admin = factory(Admin::class)->create([
            'role_id' => $role->id,
            'password' => 'Haslo.123',
            'is_superadmin' => true
        ]);

        $this->actingAs($admin);
        $this->visit('ams/admin/'.$admin->id.'/edit');
        $this->type($this->faker->name, 'name');
        $this->type($this->faker->email, 'email');
        $this->press('btn_save');
        $this->seePageIs('/ams/admin');
    }
}
