<?php
/**
 * Created by PhpStorm.
 * User: Jorge
 * Date: 17/04/2017
 * Time: 21:15
 */

namespace jjsquady\MikrotikApi;

use jjsquady\MikrotikApi\Core\Auth;
use jjsquady\MikrotikApi\Core\Connector;
use jjsquady\MikrotikApi\Exceptions\WrongArgumentTypeException;
use jjsquady\MikrotikApi\Contracts\Connector as ConnectorInterface;
use RouterosAPI;

/**
 * Class Mikrotik
 * @package jjsquady\MikrotikApi
 */
class Mikrotik
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
     * @var ConnectorInterface
     */
    protected $connector;


    /**
     * Mikrotik constructor.
     * @param RouterosAPI $api
     * @param ConnectorInterface $connector
     */
    public function __construct(RouterosAPI $api, ConnectorInterface $connector = null)
    {
        $this->api       = $api;
        $this->connector = $connector;
    }


    /**
     * @param $auth
     * @return mixed
     */
    public function connect($auth)
    {
        $this->auth = $this->getAuth($auth);
        return $this->getConnection();
    }

    /**
     *
     */
    private function getConnection()
    {
        if (is_null($this->connector)) {
            $this->connector = new Connector($this->auth, $this->api);
        }

        $this->connector->connect();
        return $this->connector;
    }

    /**
     * @param $auth
     * @return Auth
     * @throws WrongArgumentTypeException
     */
    private function getAuth($auth)
    {
        if ($auth instanceof Auth) {
            return $auth;
        }

        if (is_array($auth)) {
            $auth = new Auth(...$auth);
            return $auth;
        }

        throw new WrongArgumentTypeException('Array or Auth::class', gettype($auth));
    }

    /**
     * @return mixed
     */
    public function connector()
    {
        return $this->connector;
    }

    /**
     * @return mixed
     */
    public function credentials()
    {
        return $this->auth;
    }

    /**
     * @return mixed
     */
    public function host()
    {
        return $this->auth->getHost();
    }

}