<?php

namespace Alerty\Pipes;

use Alerty\Event\BadQueryExecuted;
use Alerty\Services\NormalizedQuery;

class LimitingID
{
    public static function check(NormalizedQuery $query)
    {
        if (preg_match("/^insert into/i", $query->query)){
            return;
        }

        if (\Str::of($query->query)->contains("limit")){
            return;
        }

        if (! preg_match("/^select (.*?) where `id` = \?$/i", $query->query)){
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
        return "If you are filtering a query using `id`, its better to limit it too.";
    }

}
