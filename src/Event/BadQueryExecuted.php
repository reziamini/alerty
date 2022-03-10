<?php

namespace Alerty\Event;

use Alerty\Services\NormalizedQuery;

class BadQueryExecuted
{
    public NormalizedQuery $query;
    public string $description;
    public string $type;

    public function __construct(NormalizedQuery $query, $description, $type)
    {
        $this->query = $query;
        $this->description = $description;
        $this->type = $type;
    }
}
