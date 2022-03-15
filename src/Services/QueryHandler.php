<?php

namespace Alerty\Services;

use Illuminate\Database\Events\QueryExecuted;
use Alerty\Pipes\SelectStar;
use Str;
use Alerty\Pipes\DuplicatedQuery;
use Alerty\Pipes\NPlusOne;
use Alerty\Pipes\WhereIn;
use Alerty\Pipes\LimitingID;
use Alerty\Pipes\OrderByRand;
use Alerty\Pipes\LimitWithoutOrdering;
use Alerty\Pipes\UpdateWithoutWhere;
use Alerty\Pipes\SelectExists;
use Alerty\Pipes\SelectAllRows;
use Alerty\Pipes\WhereLike;

class QueryHandler
{
    const Pipes = [
        SelectStar::class,
        DuplicatedQuery::class,
        NPlusOne::class,
        WhereIn::class,
        LimitingID::class,
        SelectAllRows::class,
        OrderByRand::class,
        LimitWithoutOrdering::class,
        UpdateWithoutWhere::class,
        SelectExists::class,
        WhereLike::class
    ];

    public function handle(QueryExecuted $query)
    {
        if (Str::of($query->sql)->lower()->contains(['query_entries', 'telescope_entries', 'information_schema'])){
            return;
        }

        $tracePath = $this->renderTracedData($this->getTraceData());

        $normalizedQuery = new NormalizedQuery($query, $tracePath);

        foreach (self::Pipes as $pipe) {
            $pipe::check($normalizedQuery);
        }
    }

    private function getTraceData()
    {
        $trace = collect(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS))->forget(0);

        return $trace->first(function ($frame) {
            if (! isset($frame['file'])) {
                return false;
            }

            return ! Str::contains($frame['file'],
                base_path('vendor'.DIRECTORY_SEPARATOR.'laravel')
            );
        });
    }

    private function renderTracedData($data)
    {
        return "{$data['file']}:{$data['line']}";
    }

}
