<?php

namespace Alerty\Services;

use Illuminate\Database\Events\QueryExecuted;

class NormalizedQuery
{
    public string $query;
    public string $bindedQuery;
    public float $time;
    public string $connection;
    public string $database;
    public string $path;
    public bool $transaction;

    public function __construct(QueryExecuted $event, $path)
    {
        $this->query = $event->sql;
        $this->bindedQuery = $this->prepareQuery($event);
        $this->time = number_format($event->time, 2, '.', '');
        $this->connection = $event->connectionName;
        $this->database = $event->connection->getDatabaseName();
        $this->path = $path;
        $this->transaction = $this->hasTransaction($event);
    }

    private function prepareQuery(QueryExecuted $event)
    {
        $bindings = $event->connection->prepareBindings($event->bindings);

        if (! $bindings){
            return $event->sql;
        }

        return $this->replaceBindings($event);
    }

    private function replaceBindings($event)
    {
        $sql = $event->sql;

        foreach ($event->connection->prepareBindings($event->bindings) as $key => $binding) {
            $regex = is_numeric($key)
                ? "/\?(?=(?:[^'\\\']*'[^'\\\']*')*[^'\\\']*$)/"
                : "/:{$key}(?=(?:[^'\\\']*'[^'\\\']*')*[^'\\\']*$)/";

            if ($binding === null) {
                $binding = 'null';
            } elseif (! is_int($binding) && ! is_float($binding)) {
                $binding = $this->quoteStringBinding($event, $binding);
            }

            $sql = preg_replace($regex, $binding, $sql, 1);
        }

        return $sql;
    }

    private function quoteStringBinding($event, $binding)
    {
        try {
            return $event->connection->getPdo()->quote($binding);
        } catch (\PDOException $e) {
            throw_if('IM001' !== $e->getCode(), $e);
        }

        $binding = \strtr($binding, [
            chr(26) => '\\Z',
            chr(8) => '\\b',
            '"' => '\"',
            "'" => "\'",
            '\\' => '\\\\',
        ]);

        return "'".$binding."'";
    }

    private function hasTransaction($event)
    {
        $reflectionObject = new \ReflectionObject($event->connection);
        $property = $reflectionObject->getProperty('transactions');
        return $property->getValue($event->connection) != 0;
    }

}
