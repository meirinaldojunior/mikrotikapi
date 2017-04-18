<?php
/**
 * Created by PhpStorm.
 * User: Jorge
 * Date: 18/04/2017
 * Time: 01:57
 */

namespace jjsquady\MikrotikApi\Commands\Entity;


/**
 * Class Bridge
 * @package MiKontrol\Http\MikrotikApi\Commands\Entity
 */
class Bridge extends Entity
{
    /**
     * @var array
     */
    protected $fillable = [
        '.id',
        'name',
        'mtu',
        'l2mtu',
        'arp',
        'mac-address',
        'protocol-mode',
        'priority',
        'auto-mac',
        'admin-mac',
        'max-message-age',
        'forward-delay',
        'transmit-hold-count',
        'ageing-time',
        'running',
        'disabled',
        'comment'
    ];
}