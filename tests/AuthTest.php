<?php
/**
 * Created by PhpStorm.
 * User: Jorge
 * Date: 18/04/2017
 * Time: 05:05
 */

use jjsquady\MikrotikApi\Core\Auth;
use Orchestra\Testbench\TestCase;

class AuthTest extends TestCase
{
    public function test_is_istanciable()
    {
        $this->assertInstanceOf(Auth::class, new Auth('192.168.0.20', 'admin', ''));
    }

    public function test_if_auth_accepts_array_args()
    {
        $array = ['192.168.0.20','admin', ''];
        $this->assertInstanceOf(Auth::class, new Auth(...$array));
    }
}
