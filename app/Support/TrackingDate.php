<?php

namespace App\Support;

use Illuminate\Support\Carbon;

class TrackingDate
{
    public static function resolve(?string $value = null): string
    {
        $value ??= request()->query('date');

        if (! filled($value)) {
            return today()->toDateString();
        }

        try {
            return Carbon::parse($value)->toDateString();
        } catch (\Throwable) {
            return today()->toDateString();
        }
    }
}
