<?php
/**
 * Created by PhpStorm.
 * User: Jorge
 * Date: 17/04/2017
 * Time: 21:30
 */

namespace jjsquady\MikrotikApi\Commands\Entity;

/**
 * Class Address
 * @package MiKontrol\Http\MikrotikApi\Commands\Entity
 */
class Address extends Entity
{
    /**
     * @var array
     */
    protected $fillable = [
        '.id',
        'address',
        'network',
        'interface',
        'actual-interface',
        'invalid',
        'dynamic',
        'disabled',
        'comment'
    ];
}