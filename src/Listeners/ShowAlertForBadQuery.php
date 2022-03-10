<?php

namespace Alerty\Listeners;

use Alerty\Event\BadQueryExecuted;
use Alerty\Models\QueryEntry;

class ShowAlertForBadQuery
{

    public function handle(BadQueryExecuted $event)
    {
        QueryEntry::query()->create([
            'data' => $event->query,
            'type' => $event->type,
            'description' => $event->description
        ]);
    }

}
