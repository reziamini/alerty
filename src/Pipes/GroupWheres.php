<?php

namespace Alerty\Pipes;

use Alerty\Services\NormalizedQuery;
use Alerty\Event\BadQueryExecuted;

class GroupWheres
{
    public static function check(NormalizedQuery $query)
    {
        if (!preg_match("/^select/i", $query->query)) {
            return;
        }

        if (! \Str::of($query->query)->lower()->contains("and") or ! \Str::of($query->query)->lower()->contains("or")) {
            return;
        }

        if (preg_match('/\(.*?(or|and).*?\)/i', $query->query)){
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
        return "If you are using or, and operators, it's better to group them because you may get a not clear result.";
    }

}
