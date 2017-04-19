<?php
/**
 * Created by PhpStorm.
 * User: Jorge
 * Date: 19/04/2017
 * Time: 03:50
 */

namespace jjsquady\MikrotikApi\Support;

use jjsquady\MikrotikApi\Core\Collection;

trait EntityUtils
{
    protected $entityClass;

    private function convertArrayToEntities($items)
    {
        if (!is_array($items)) {
            // TODO: throw exception
        }

        $collection = new Collection();

        foreach ($items as $item) {
            $collection->push(new $this->entityClass($this->getEntityProperties($item)));
        }

        return $collection;
    }

    private function getEntityProperties($array)
    {
        $attributes = [];

        foreach ($array as $property => $value) {
            $attributes[$property] = $value;
        }

        return $attributes;
    }
}