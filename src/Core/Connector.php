<?php
/**
 * Created by PhpStorm.
 * User: Jorge
 * Date: 18/04/2017
 * Time: 02:38
 */

namespace jjsquady\MikrotikApi\Core;

use jjsquady\MikrotikApi\Contracts\Connector as ConnectorInterface;
use jjsquady\MikrotikApi\Exceptions\ConnectionException;
use RouterosAPI;

/**
 * Class Connector
 * @package jjsquady\MikrotikApi\Core
 */
class Connector implements ConnectorInterface
{
    /**
     * @var RouterosAPI
     */
    protected $api;

    /**
     * @var Auth
     */
    protected $auth;

    /**
     * @var
     */
    protected $connected;

    /**
     * Connector constructor.
     * @param Auth $auth
     * @param RouterosAPI $api
     */
    function __construct(Auth $auth, RouterosAPI $api)
    {
        $this->auth = $auth;
        $this->api = $api;
    }


    /**
     * @return $this
     * @throws ConnectionException
     */
    public function connect()
    {
        if ($this->api->connect($this->auth->getHost(), $this->auth->getUsername(), $this->auth->getPassword(true))) {
            $this->connected = true;
            return $this;
        }

        throw new ConnectionException($this->auth->getHost());
    }

    /**
     * @return mixed
     */
    public function isConnected()
    {
        return $this->connected;
    }

    /**
     * @return RouterosAPI
     */
    public function api()
    {
        return $this->api;
    }

    /**
     * @param $command
     * @param bool $params
     * @return bool
     */
    public function write($command, $params = true)
    {
        return $this->api->write($command, $params);
    }

    /**
     * @param bool $pretty
     * @return array
     */
    public function read($pretty = true)
    {
        return $this->api->read($pretty);
    }
}