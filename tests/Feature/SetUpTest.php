<?php

namespace Lunestudio\FilamentNavigationManager\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Lunestudio\FilamentNavigationManager\Tests\TestCase;

class SetUpTest extends TestCase
{
    use RefreshDatabase;

    public function test_check_if_tests_works(): void
    {
        $this->assertDatabaseCount('users', 1);
        $this->assertDatabaseHas('users', ['email' => $this->testUser->email]);
        $this->assertTrue(true);
    }
}
