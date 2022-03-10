<?php

namespace Alerty\Pipes;

use Alerty\Event\BadQueryExecuted;
use Alerty\Services\NormalizedQuery;

class SelectExists
{
    public static function check(NormalizedQuery $query)
    {
        if (! preg_match("/^select exists/i", $query->query)){
            return;
        }

        if (! \Str::of($query->query)->lower()->contains("as `exists`")){
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
        return "Exist is expensive too, you can simply check this with a condition in your back-end service instead of db layer.";
    }

}
