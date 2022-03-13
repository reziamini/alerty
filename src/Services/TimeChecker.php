<?php

namespace Alerty\Services;

class TimeChecker
{
    public static function getStyle($time)
    {
        if ($time <= 5){
            return 'bg-green-500 text-white';
        }

        if ($time <= 15){
            return 'bg-green-300 text-gray-500';
        }

        if ($time <= 35){
            return 'bg-yellow-200 text-gray-500';
        }

        if ($time <= 60){
            return 'bg-red-200 text-gray-500';
        }

        if ($time <= 100){
            return 'bg-red-300 text-white';
        }

        return 'bg-red-500 text-white';
    }
}
