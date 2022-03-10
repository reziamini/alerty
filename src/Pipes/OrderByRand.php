<?php

namespace Alerty\Pipes;

use Alerty\Event\BadQueryExecuted;
use Alerty\Services\NormalizedQuery;

class OrderByRand
{
    public static function check(NormalizedQuery $query)
    {
        if (! preg_match("/^select/i", $query->query)){
            return;
        }

        if (! \Str::of($query->query)->lower()->contains("order by rand()")){
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
        return "order by rand() is not a good choice to order the rows, it's expensive!";
    }

}
