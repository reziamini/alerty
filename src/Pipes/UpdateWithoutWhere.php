<?php

namespace Alerty\Pipes;

use Alerty\Event\BadQueryExecuted;
use Alerty\Services\NormalizedQuery;

class UpdateWithoutWhere
{
    public static function check(NormalizedQuery $query)
    {
        if (! preg_match("/^update/i", $query->query)){
            return;
        }

        if (\Str::of($query->query)->lower()->contains("where")){
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
        return "You are updating data without any condition, it may effect all rows and may be dangerous!";
    }

}
