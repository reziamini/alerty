<?php

namespace Alerty\Pipes;

use Alerty\Event\BadQueryExecuted;
use Alerty\Services\NormalizedQuery;

class WhereIn
{
    public static function check(NormalizedQuery $query)
    {
        if (! preg_match("/^select|update/i", $query->query)){
            return;
        }

        if (! preg_match("/where (.*) in \(.*?\)/i", $query->query)){
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
        return "Where in with a big list is expensive and joining is a better replacement.";
    }

}
