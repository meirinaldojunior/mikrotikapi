<?php
/**
 * Created by PhpStorm.
 * User: Jorge
 * Date: 17/04/2017
 * Time: 21:31
 */

namespace jjsquady\MikrotikApi\Commands;

use jjsquady\MikrotikApi\Core\Connector;
use jjsquady\MikrotikApi\Contracts\Command as CommandInterface;
use jjsquady\MikrotikApi\Exceptions\InvalidCommandException;

/**
 * Class Command
 * @package MiKontrol\Http\MikrotikApi\Commands
 */
abstract class Command implements CommandInterface
{
    /**
     * @var Connector
     */
    protected $connector;

    /**
     * @var
     */
    protected $entityClass;

    /**
     * @var
     */
    protected $base_command;

    /**
     * @var
     */
    protected $command;

    /**
     * Command constructor.
     * @param Connector $connector
     */
    public function __construct(Connector $connector)
    {
        $this->connector = $connector;
        $this->command = $this->base_command;
    }

    /**
     * @param bool $pretty
     * @return mixed
     */
    function send($pretty = true)
    {
        $this->connector->write($this->command);
        $this->command = $this->base_command;
        return $this->parseResponse($this->connector->read($pretty));
    }

    /**
     * @param bool $pretty
     * @return array
     */
    public function all($pretty = true)
    {
        $this->append('/print');
        return $this->send($pretty);
    }

    /**
     * @return mixed
     */
    public function get()
    {
        $collection = [];
        $entityClass = $this->getEntityClassName();
        foreach ($this->all() as $entity) {
            $collection[] = new $entityClass($entity);
        }
        return $collection;
    }

    //    public function __set($property, $value)
//    {
//        if (property_exists($this, $property)){
//            $this->{$property} = $value;
//            return;
//        }
//
//        throwException(new \Exception("Property {$property} does not exists in this Class."));
//    }

    /**
     * @return string
     */
    protected function getEntityClassName()
    {
        $classNameByCommand = __NAMESPACE__. '\\Entity\\' . $this->getLastCommand();
        $className = class_exists($classNameByCommand) ?
            $classNameByCommand :
            $this->entityClass;
        return $className;
    }

    /**
     * @return mixed
     */
    protected function getLastCommand()
    {
        return ucfirst(array_last(explode('/', $this->command)));
    }

    /**
     * @param $command
     */
    protected function append($command)
    {
        $this->command .= $command;
    }

    /**
     * @param $response
     * @return mixed
     * @throws InvalidCommandException
     */
    private function parseResponse($response)
    {
        if (array_key_exists('!trap', $response)){
            throw new InvalidCommandException($this->getCurrentCommand());
        }

        return $response;
    }

    /**
     * @return string
     */
    private function getCurrentCommand()
    {
        return $this->command;
    }
}