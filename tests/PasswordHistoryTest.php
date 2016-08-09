<?php
namespace Wilgucki\LaravelAms\Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Wilgucki\LaravelAms\Models\Admin;
use Wilgucki\LaravelAms\Models\Role;
use Wilgucki\LaravelAms\Validators\PasswordHistory;

class PasswordHistoryTest extends \TestCase
{
    use DatabaseMigrations;

    public function testValidate()
    {
        $role = factory(Role::class)->create();
        $admin = factory(Admin::class)->create([
            'role_id' => $role->id,
            'password' => 'Haslo.123'
        ]);

        for ($i=0; $i<3; $i++) {
            $admin->password = str_random();
            $admin->save();
            sleep(1); // TODO sprawdzic jak ustawic created_at co sekunde bez sleep
        }

        $validator = new PasswordHistory();
        $this->assertFalse($validator->validate(null, 'Haslo.123', ['admin_id', $admin->id]));

        for ($i=0; $i<3; $i++) {
            $admin->password = str_random();
            $admin->save();
        }

        $this->assertTrue($validator->validate(null, 'Haslo.123', ['admin_id', $admin->id]));
    }
}
