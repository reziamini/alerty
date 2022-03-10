<?php

namespace Alerty\Http;

use Alerty\Models\QueryEntry;

class QueryController
{

    public function list()
    {
        $queries = QueryEntry::query()->latest('created_at')->paginate(50);

        return view('alerty::query.read', compact('queries'));
    }

    public function show(QueryEntry $queryEntry)
    {
        return view('alerty::query.single', [
            'query' => $queryEntry
        ]);
    }

}
