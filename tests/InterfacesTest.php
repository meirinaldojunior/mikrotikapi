<?php
/**
 * Created by PhpStorm.
 * User: Jorge
 * Date: 18/04/2017
 * Time: 05:32
 */

use jjsquady\MikrotikApi\Commands\Entity\InterfaceEntity;
use jjsquady\MikrotikApi\Commands\InterfaceCommand;
use jjsquady\MikrotikApi\Facades\MikrotikFacade as Mikrotik;
use Orchestra\Testbench\TestCase;

class InterfacesTest extends TestCase
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

    public function getConn()
    {
        $conn = Mikrotik::connect(['192.168.0.20','admin','']);
        return $conn;
    }

    public function test_get_interfaces_array()
    {
        $conn = $this->getConn();
        $interfaces = new InterfaceCommand($conn);
        $this->assertEquals(true, is_array($interfaces->all()));
    }

    public function test_has_interface_object()
    {
        $conn = $this->getConn();
        $interfaces = new InterfaceCommand($conn);
        $this->assertInstanceOf(InterfaceEntity::class, $interfaces->get()[0]);
    }
}
