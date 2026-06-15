<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class AdminSetting extends Model
{
    protected $fillable = ['key', 'value'];

    private static array $encrypted = ['mail_password'];
    private static array $cache = [];

    public static function get(string $key, $default = null)
    {
        if (array_key_exists($key, self::$cache)) {
            return self::$cache[$key];
        }

        $row = static::where('key', $key)->first();
        if (!$row) {
            self::$cache[$key] = $default;
            return $default;
        }

        $value = $row->value;
        if (in_array($key, self::$encrypted)) {
            try { $value = Crypt::decryptString($value); } catch (\Exception $e) {}
        }

        self::$cache[$key] = $value;
        return $value;
    }

    public static function set(string $key, $value)
    {
        $stored = in_array($key, self::$encrypted) ? Crypt::encryptString($value) : $value;
        static::updateOrCreate(['key' => $key], ['value' => $stored]);
        self::$cache[$key] = $value;
    }

    public static function allDecrypted(): \Illuminate\Support\Collection
    {
        return static::all()->mapWithKeys(function ($row) {
            $value = $row->value;
            if (in_array($row->key, self::$encrypted)) {
                try { $value = Crypt::decryptString($value); } catch (\Exception $e) {}
            }
            self::$cache[$row->key] = $value;
            return [$row->key => $value];
        });
    }
}
