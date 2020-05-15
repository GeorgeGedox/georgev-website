<?php

namespace App\Classes;

use App\Setting;

class Helpers
{
    /**
     * Get the value of a setting based on key, return default if not found
     *
     * @param string $key
     * @param null $default
     * @return bool|false|int|string|null
     */
    public static function setting(string $key, $default = null)
    {
        $value = Setting::get($key);
        return is_null($value) ? $default : $value;
    }

    /**
     * Format bytes to kb, mb, gb, tb
     *
     * @param  integer $size
     * @param  integer $precision
     * @return integer
     */
    public static function formatBytes($size, $precision = 2)
    {
        if ($size > 0) {
            $size = (int) $size;
            $base = log($size) / log(1024);
            $suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');

            return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
        } else {
            return $size;
        }
    }
}
