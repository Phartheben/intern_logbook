<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends EntityTestCase
{
    use DatabaseTransactions;

    protected function setup()
    {
        parent::setup();

        $this->className = '\App\Models\User';
    }

    public function testSuite()
    {
        // $this->validateTestSuite($this->className);
    }

    // ---- relationship

    // ---- attributes

    // ---- methods

    // ---- resources

    /**
     *
     */
    public function testToResource()
    {
        $user = \App\Models\User::first();
        var_dump($user->toArray());
    }

    // ---- statics

    // ---- scopes

    // ---- crud

    /**
     *
     */
    public function testCreate()
    {
        $this->assertTrue(true);
    }

    /**
     *
     */
    public function testUpdate()
    {
        $this->assertTrue(true);
    }

    /**
     *
     */
    public function testDelete()
    {
        $this->assertTrue(true);
    }
}
