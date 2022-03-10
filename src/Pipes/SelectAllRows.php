<?php

namespace Alerty\Pipes;

use Alerty\Event\BadQueryExecuted;
use Alerty\Services\NormalizedQuery;

class SelectAllRows
{
    public static function check(NormalizedQuery $query)
    {
        if (! preg_match("/^select/i", $query->query)){
            return;
        }

        if (\Str::of($query->query)->contains("where") or \Str::of($query->query)->contains("limit")){
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
        return "You are selecting all rows without any where or limit";
    }

}
