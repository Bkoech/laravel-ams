<?php

namespace Wilgucki\LaravelAms\Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Wilgucki\LaravelAms\Models\Role;

class RoleTest extends \TestCase
{
    use DatabaseMigrations;

    public function testForSelect()
    {
        factory(Role::class, 10)->create();
        $roles = Role::forSelect();
        $this->assertCount(10, $roles);
        $this->assertTrue(is_int(array_keys($roles)[0]));
        $this->assertTrue(is_string(array_values($roles)[0]));
    }
}
