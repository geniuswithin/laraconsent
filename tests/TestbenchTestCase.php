<?php

namespace Ekoukltd\LaraConsent\Tests;

use Orchestra\Testbench\TestCase as TestBench;
use Ekoukltd\LaraConsent\LaraConsentServiceProvider;

abstract class TestbenchTestCase extends TestBench
{
    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate', ['--database' => 'testbench'])->run();
    }
    
    
    protected function getPackageProviders($app)
    {
        return [
            LaraConsentServiceProvider::class,
        ];
    }
    
    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }
}
