<?php

namespace Tests;

use Orchestra\Testbench\TestCase;
use AhmedWaleed\QueryFilter\Tests\Models\User;
use AhmedWaleed\QueryFilter\Tests\Models\Queries\ScopeActiveUsers;

class QueryFilterTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setup();
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->withFactories(__DIR__ . '/database/factories');

        factory("AhmedWaleed\QueryFilter\Tests\Models\User")->create([
            'active' => 1
        ]);

        factory("AhmedWaleed\QueryFilter\Tests\Models\User")->create([
            'active' => 0
        ]);
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    protected function getPackageProviders($app)
    {
        return ['AhmedWaleed\QueryFilter\QueryFilterServiceProvider'];
    }

    /** @test */
    public function it_applies_query_filter()
    {
        $this->assertSame(2, User::count());
        $this->assertSame(1, User::addQuery((new ScopeActiveUsers())->when(true))->count());
    }

    /** @test */
    public function it_applies_query_filter_if_without_invoking_when_method()
    {
        $this->assertSame(2, User::count());
        $this->assertSame(1, User::addQuery(new ScopeActiveUsers())->count());
    }

    /** @test */
    public function it_will_not_apply_query_filter_when_condition_is_false()
    {
        $this->assertSame(2, User::count());
        $this->assertSame(2, User::addQuery((new ScopeActiveUsers())->when(false))->count());
    }
}