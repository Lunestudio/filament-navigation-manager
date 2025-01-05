<?php

namespace Lunestudio\FilamentNavigationManager\Tests;

use Illuminate\Database\Schema\Blueprint;
use Lunestudio\FilamentNavigationManager\Tests\MockModels\User;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    protected $testUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase($this->app);
    }

    protected function setUpDatabase($app)
    {
        $schema = $app['db']->connection()->getSchemaBuilder();

        $schema->create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->timestamps();
        });

        $this->testUser = User::create(['email' => 'test@user.com']);
    }
}
