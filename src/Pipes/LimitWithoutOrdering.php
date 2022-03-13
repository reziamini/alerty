<?php

namespace Alerty\Pipes;

use Alerty\Event\BadQueryExecuted;
use Alerty\Services\NormalizedQuery;

class LimitWithoutOrdering
{
    public static function check(NormalizedQuery $query)
    {
        if (! preg_match("/^select|update/i", $query->query)){
            return;
        }

        if (! \Str::of($query->query)->lower()->contains("limit")){
            return;
        }

        if (preg_match('/where(.*?)`id`\s?=/i', $query->query)){
            return;
        }

        if (\Str::of($query->query)->lower()->contains("order by")){
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
        return "If you are limiting without ordering, be careful about the result that you get.";
    }

}
