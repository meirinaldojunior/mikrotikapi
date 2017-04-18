<?php
/**
 * Created by PhpStorm.
 * User: Jorge
 * Date: 18/04/2017
 * Time: 05:25
 */

use jjsquady\MikrotikApi\Core\Auth;
use jjsquady\MikrotikApi\Core\Connector;
use jjsquady\MikrotikApi\Facades\MikrotikFacade as Mikrotik;
use Orchestra\Testbench\TestCase;

class MikrotikTest extends TestCase
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

    public function test_connection()
    {
        $this->assertInstanceOf(Connector::class, $this->getConn());
    }

    public function test_return_connector()
    {
        $this->getConn();
        $this->assertInstanceOf(Connector::class, Mikrotik::connector());
    }

    public function test_return_auth()
    {
        $this->getConn();
        $this->assertInstanceOf(Auth::class, Mikrotik::credentials());
    }

    public function test_return_host_address()
    {
        $this->getConn();
        $this->assertEquals('192.168.0.20', Mikrotik::host());
    }

    public function getConn()
    {
        $conn = Mikrotik::connect(['192.168.0.20','admin','']);
        return $conn;
    }
}
