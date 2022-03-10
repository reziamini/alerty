<?php

namespace Alerty\Pipes;

use Alerty\Event\BadQueryExecuted;
use Alerty\Services\NormalizedQuery;

class SelectStar
{
    public static function check(NormalizedQuery $query)
    {
        if (! preg_match("/^select \*/i", $query->query)){
            return;
        }

        $type = static::getType();
        $description = static::getDescription();

        event(new BadQueryExecuted($query, $description, $type));
    }

    public static function getType()
    {
        return class_basename(self::class);
    }

    public static function getDescription()
    {
        return "You have used select * from, better to just select columns which you need.";
    }

}
