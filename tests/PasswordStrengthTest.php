<?php
/**
 * Created by PhpStorm.
 * User: mwilgucki
 * Date: 21.07.2016
 * Time: 13:46
 */

namespace Wilgucki\LaravelAms\Tests;


use Wilgucki\LaravelAms\Validators\PasswordStrength;

class PasswordStrengthTest extends \PHPUnit_Framework_TestCase
{
    public function testValidate()
    {
        $validator = new PasswordStrength();
        $this->assertTrue($validator->validate(null, 'Aa.1'));
        $this->assertTrue($validator->validate(null, 'A.1'));
        $this->assertTrue($validator->validate(null, 'Aa1'));
        $this->assertTrue($validator->validate(null, 'Aa.'));
    }
}
