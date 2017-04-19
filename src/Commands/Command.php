<?php
/**
 * Created by PhpStorm.
 * User: Jorge
 * Date: 17/04/2017
 * Time: 21:31
 */

namespace jjsquady\MikrotikApi\Commands;

use jjsquady\MikrotikApi\Contracts\CommandContract as CommandInterface;
use jjsquady\MikrotikApi\Core\Client;
use jjsquady\MikrotikApi\Core\QueryBuilder;
use jjsquady\MikrotikApi\Core\Request;
use jjsquady\MikrotikApi\Exceptions\InvalidCommandException;

/**
 * Class Command
 * @package MiKontrol\Http\MikrotikApi\Commands
 */
abstract class Command extends Request implements CommandInterface
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var
     */
    protected $entityClass;

    /**
     * @var
     */
    protected $base_command;

    /**
     * @var \PEAR2\Net\RouterOS\Request
     */
    protected $request;

    /**
     * @var array
     */
    protected $commands = [];

    /**
     * @var array
     */
    protected $commandsAlias = [];

    /**
     * @var
     */
    protected $query;

    /**
     * Command constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client  = $client;
        $this->request = parent::__construct($this->base_command);
    }

    /**
     * @return mixed
     */
    public function getBaseCommand()
    {
        return $this->base_command;
    }

    /**
     * @param array $args
     * @return string
     */
    protected function buildCommandPath(array $args)
    {
        if (!is_array($args)) {
            //TODO: throw exception
        }

        if (empty(array_last($args))) {

            return implode('', $args);

        }

        return implode("/", $args);
    }

    /**
     * @param $name
     * @param $arguments
     * @return QueryBuilder
     * @throws InvalidCommandException
     */
    public function __call($name, $arguments)
    {
        if (array_key_exists($name, $this->commands)) {

            $command = array_key_exists($name, $this->commandsAlias) ? $this->commandsAlias[$name] : $name;

            $fullCommand = $this->buildCommandPath([$this->base_command, $command]);

            return $this->buildNewQuery($this->commands[$name], $fullCommand);
        }

        throw new InvalidCommandException($name);
    }

    /**
     * @param $entityClass
     * @param $command
     * @return QueryBuilder
     */
    protected function buildNewQuery($entityClass, $command)
    {
        $this->query = new QueryBuilder($entityClass, $command, $this->client);
        return $this->query;
    }

}