<?php

/**
 * Created by PhpStorm.
 * User: Jorge
 * Date: 18/04/2017
 * Time: 04:46
 */

use jjsquady\MikrotikApi\Core\Connector;
use jjsquady\MikrotikApi\Facades\MikrotikFacade;
use Orchestra\Testbench\TestCase;

class FacadeTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [jjsquady\MikrotikApi\MikrotikServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Mikrotik' => jjsquady\MikrotikApi\Facades\MikrotikFacade::class
        ];
    }

    public function test_if_get_a_facade()
    {
        $this->assertInstanceOf(Connector::class, MikrotikFacade::connect(['192.168.0.20', 'admin', '']));
    }


}
