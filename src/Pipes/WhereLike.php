<?php

namespace Alerty\Pipes;

use Alerty\Services\NormalizedQuery;
use Alerty\Event\BadQueryExecuted;

class WhereLike
{

    public static function check(NormalizedQuery $query)
    {
        if (! \Str::of($query->query)->lower()->contains('select')){
            return;
        }

        if (! preg_match('/where `.*?` like \'%.*?%\'/i', $query->bindedQuery)){
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
        return "Where like %% is expensive, you can use whereFullText() in Laravel 9 with text columns.";
    }

}
