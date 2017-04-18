<?php
/**
 * Created by PhpStorm.
 * User: Jorge
 * Date: 18/04/2017
 * Time: 00:17
 */

namespace jjsquady\MikrotikApi\Commands;


use jjsquady\MikrotikApi\Commands\Entity\InterfaceEntity;

/**
 * Class InterfaceCommand
 * @package MiKontrol\Http\MikrotikApi\Commands
 */
class InterfaceCommand extends Command
{
    /**
     * @var string
     */
    protected $base_command = '/interface';

    /**
     * @var string
     */
    protected $entityClass = InterfaceEntity::class;

    /**
     * @return $this
     */
    public function ethernet()
    {
        $this->append('/ethernet');
        return $this;
    }

    /**
     * @return $this
     */
    public function bridge()
    {
        $this->append('/bridge');
        return $this;
    }

    /**
     * @return $this
     */
    public function bonding()
    {
        $this->append('/bonding');
        return $this;
    }
}