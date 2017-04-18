<?php
/**
 * Created by PhpStorm.
 * User: Jorge
 * Date: 17/04/2017
 * Time: 21:26
 */

namespace jjsquady\MikrotikApi\Contracts;


interface Command
{
    function send($pretty = true);
}