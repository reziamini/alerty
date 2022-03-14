<?php

namespace Alerty;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Database\Events\QueryExecuted;
use Alerty\Services\QueryHandler;
use Alerty\Event\BadQueryExecuted;
use Alerty\Listeners\ShowAlertForBadQuery;
use Livewire\Livewire;
use Alerty\Http\Livewire\Query\Read;
use Alerty\Http\Livewire\Query\Single;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

class AlertyServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->setupEventListeners();

        $this->setupMigrations();

        $this->setupViews();

        $this->setupRoutes();
    }

    private function setupEventListeners()
    {
        if ( ! $this->app->runningInConsole() && Schema::hasTable('query_entries') ) {
            Event::listen(QueryExecuted::class, [QueryHandler::class, 'handle']);
            Event::listen(BadQueryExecuted::class, [ShowAlertForBadQuery::class, 'handle']);
        }
    }

    private function setupMigrations()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    private function setupViews()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'alerty');
    }

    private function setupRoutes()
    {
        Route::middleware('web')->group(__DIR__.'/route.php');
    }

}
