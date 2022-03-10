<?php

namespace Alerty\Models;

use Illuminate\Database\Eloquent\Model;

class QueryEntry extends Model
{
    protected $table = 'query_entries';

    protected $fillable = [
        'description',
        'type',
        'data'
    ];

    protected $casts = [
        'data' => 'json'
    ];

    public const UPDATED_AT = null;
}
