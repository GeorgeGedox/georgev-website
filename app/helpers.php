<?php

if (!function_exists('setting')) {
    /**
     * Return setting or default if nothing was found
     *
     * @param string $key
     * @param null $default
     * @return bool|false|int|null|string
     */
    function setting(string $key, $default = null)
    {
        $value = \App\Setting::get($key);
        return is_null($value) ? $default : $value;
    }
}