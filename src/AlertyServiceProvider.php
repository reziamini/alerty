<?php

namespace Alerty;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Database\Events\QueryExecuted;
use Alerty\Services\QueryHandler;
use Alerty\Event\BadQueryExecuted;
use Alerty\Listeners\ShowAlertForBadQuery;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

class AlertyServiceProvider extends ServiceProvider
{

    public function boot()
    {
        if (Schema::hasTable('query_entries')){
            Event::listen(QueryExecuted::class, [QueryHandler::class, 'handle']);
            Event::listen(BadQueryExecuted::class, [ShowAlertForBadQuery::class, 'handle']);
        }

        $this->loadMigrationsFrom(__DIR__."/../database/migrations");

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'alerty');

        Route::middleware('web')
            ->group(__DIR__.'/route.php');
    }

}
