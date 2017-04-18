<?php
/**
 * Created by PhpStorm.
 * User: Jorge
 * Date: 17/04/2017
 * Time: 22:03
 */

namespace jjsquady\MikrotikApi\Commands;

/**
 * Class IP
 * @package MiKontrol\Http\MikrotikApi\Commands
 */
class IP extends Command
{

    /**
     * @var string
     */
    protected $base_command = '/ip';

    /**
     * @return $this
     */
    public function address()
    {
        $this->append('/address');
        return $this;
    }

    /**
     * @return $this
     */
    public function arp()
    {
        $this->append('/arp');
        return $this;
    }

    /**
     * @return $this
     */
    public function accouting()
    {
        $this->append('/accounting');
        return $this;
    }

}