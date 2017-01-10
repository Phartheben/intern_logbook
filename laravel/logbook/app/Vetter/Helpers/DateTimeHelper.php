<?php
namespace App\Vetter\Helpers;

use \Carbon\Carbon;

class DateTimeHelper
{
    public static function now()
    {
        return Carbon::now()->getTimestamp();
    }

    public static function toIso8601DateTime($value)
    {
        if (is_int($value) && $value) {
            $value = Carbon::createFromTimestamp($value)->toIso8601String();
        }

        return $value ?: '';
    }

    public static function toIso8601String($value) {

        if (!$value)
            return '';

        if ($value instanceof Carbon) {
            $value = $value->toIso8601String();
        } elseif (is_int($value)) {
            $value = Carbon::createFromTimestamp($value)->toIso8601String();
        }

        return $value;
    }

    public static function toUnixTimestamp($value)
    {
        return Carbon::now()->createFromFormat(Carbon::ISO8601, $value)->getTimestamp();
    }

    public static function diffInYearsAndMonths(Carbon $date1, Carbon $date2 = null)
    {
        if (!$date2) {
            $date2 = Carbon::now();
        }

        $years  = $date1->diffInYears($date2);
        $months = $date1->diffInMonths($date2);

        if ($years * 12 <= $months) {
            $months = $months - $years * 12;
        }

        return compact('years', 'months');
    }

    public static function isCarbonized($date) {
        if (!$date || !$date->timestamp)
            return false;

        return $date;
    }
}
