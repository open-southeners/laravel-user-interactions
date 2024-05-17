<?php

namespace OpenSoutheners\LaravelUserInteractions\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\Concerns\WithWorkbench;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    use RefreshDatabase;
    use WithWorkbench;

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function defineEnvironment($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        $app['config']->set('user-interactions', include __DIR__.'/../config/user-interactions.php');
    }
}
