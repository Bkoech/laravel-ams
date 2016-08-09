<?php

namespace Wilgucki\LaravelAms\Tests;

use Faker\Factory;
use Faker\Generator;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Wilgucki\LaravelAms\Models\AclResource;

class AclResourceTest extends \TestCase
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

    public function testToTree()
    {
        $controller1 = $this->faker->word;
        $controller2 = $this->faker->word;

        factory(AclResource::class, 5)->create([
            'controller' => $controller1
        ]);

        factory(AclResource::class, 3)->create([
            'controller' => $controller2
        ]);

        $tree = AclResource::toTree();

        $this->assertArrayHasKey($controller1, $tree);
        $this->assertArrayHasKey($controller2, $tree);
        $this->assertCount(2, $tree);
        $this->assertCount(5, $tree[$controller1]);
        $this->assertCount(3, $tree[$controller2]);
    }
}
