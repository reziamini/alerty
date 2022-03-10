<?php

namespace Alerty\Pipes;

use Alerty\Event\BadQueryExecuted;
use Alerty\Services\NormalizedQuery;

class DuplicatedQuery
{
    public static array $queries = [];
    public static array $notifiedQueries = [];

    public static function check(NormalizedQuery $query)
    {
        if (preg_match("/^insert into/i", $query->query)){
            return;
        }

        static::$queries[$query->query] = (static::$queries[$query->query] ?? 0) + 1;

        if (static::$queries[$query->query] < 3) {
            return;
        }

        if (in_array($query->query, static::$notifiedQueries)){
            return;
        }

        static::$notifiedQueries[] = $query->query;

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
        return "This query is being duplicated, do you notice that?";
    }

}
