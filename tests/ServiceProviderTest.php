<?php

declare(strict_types=1);

namespace DarthSoup\Tests\Whmcs;

use DarthSoup\Whmcs\Auth\AuthFactory;
use DarthSoup\Whmcs\HttpClient\HttpClientBuilderFactory;
use DarthSoup\Whmcs\WhmcsFactory;
use DarthSoup\Whmcs\WhmcsManager;
use DarthSoup\WhmcsApi\Client;

class ServiceProviderTest extends AbstractTestCase
{
    public function testHttpClientFactoryIsInjectable(): void
    {
        $instance = $this->app->make('whmcs.httpclientfactory');

        $this->assertInstanceOf(HttpClientBuilderFactory::class, $instance);
    }

    public function testAuthFactory(): void
    {
        $instance = $this->app->make('whmcs.authfactory');

        $this->assertInstanceOf(AuthFactory::class, $instance);
    }

    public function testWhmcsFactory(): void
    {
        $instance = $this->app->make('whmcs.factory');

        $this->assertInstanceOf(WhmcsFactory::class, $instance);
    }

    public function testManager(): void
    {
        $instance = $this->app->make('whmcs');

        $this->assertInstanceOf(WhmcsManager::class, $instance);
    }

    public function testBindings(): void
    {
        $instance = $this->app->make('whmcs.connection');

        $this->assertInstanceOf(Client::class, $instance);

        $current = $this->app['whmcs.connection'];
        $this->app['whmcs']->reconnect();
        $new = $this->app['whmcs.connection'];

        $this->assertNotSame($current, $new);
        $this->assertEquals($current, $new);
    }
}
