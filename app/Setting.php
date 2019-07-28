<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    public $incrementing = false;

    protected $primaryKey = 'key';
    protected $keyType = 'string';
    protected $fillable = ['key', 'value', 'type'];

    /**
     * Update or create a setting
     *
     * @param string $key
     * @param $value
     * @param string $type
     * @return bool
     * @throws \Exception
     */
    public static function add(string $key, $value, string $type = 'string')
    {
        if (self::has($key)) {
            return self::set($key, $value, $type);
        }

        return self::create([
            'key' => $key,
            'value' => self::castValueSetter($value, $type),
            'type' => $type
        ]) ? true : false;
    }

    /**
     * Check if setting exists by key
     *
     * @param string $key
     * @return bool
     */
    public static function has(string $key)
    {
        return (boolean)self::getAllSettings()->find($key);
    }

    /**
     * Update or create a setting
     *
     * @param string $key
     * @param $value
     * @param string $type
     * @return bool
     * @throws \Exception
     */
    public static function set(string $key, $value, string $type = 'string')
    {
        if ($setting = self::getAllSettings()->find($key)) {
            return $setting->update([
                'key' => $key,
                'value' => self::castValueSetter($value, $type),
                'type' => $type
            ]) ? true : false;
        }

        return self::add($key, $value, $type);
    }

    /**
     * Remove a setting from the database
     *
     * @param string $key
     * @return bool
     */
    public static function remove(string $key)
    {
        if (self::has($key)) {
            return self::find($key)->delete();
        }

        return false;
    }

    /**
     * Get setting by key or return null
     *
     * @param string $key
     * @return bool|false|int|null|string
     */
    public static function get(string $key)
    {
        if (self::has($key)) {
            $setting = self::getAllSettings()->find($key);
            return self::castValueGetter($setting->value, $setting->type);
        }

        return null;
    }

    /**
     * Cast value to type
     *
     * @param $value
     * @param $castTo
     * @return bool|false|int|string
     */
    public static function castValueGetter($value, $castTo)
    {
        switch ($castTo) {
            case 'int':
            case 'integer':
                return intval($value);
                break;

            case 'bool':
            case 'boolean':
                return boolval($value);
                break;

            case 'array':
                return json_decode($value, true);
                break;

            default:
                return $value;
                break;
        }
    }

    /**
     * Cast value to type for database inserting
     *
     * @param $value
     * @param $castTo
     * @return bool|false|int|string
     * @throws \Exception
     */
    public static function castValueSetter($value, $castTo)
    {
        switch ($castTo) {
            case 'int':
            case 'integer':
                return intval($value);
                break;

            case 'bool':
            case 'boolean':
                return boolval($value);
                break;

            case 'array':
                if (!is_array($value)){
                    throw new \Exception("Did not receive array value.");
                }
                return json_encode($value);
                break;

            default:
                return $value;
                break;
        }
    }

    /**
     * Get all settings
     *
     * @return mixed
     */
    public static function getAllSettings()
    {
        return Cache::rememberForever('settings.all', function (){
            return self::all();
        });
    }

    /**
     * Flush cache
     *
     */
    public static function flushCache(){
        Cache::forget('settings.all');
    }

    protected static function boot()
    {
        parent::boot();

        // Flush cache on update
        static::updated(function (){
            self::flushCache();
        });

        // Flush cache on create
        static::created(function (){
            self::flushCache();
        });

        // Flush cache on delete
        static::deleted(function (){
            self::flushCache();
        });
    }
}
