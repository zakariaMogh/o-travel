<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Config;

/**
 * @method static where(string $string, $key)
 */
class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value'
    ];

    /**
     * @param $key
     * @return string|null
     */
    public static function get($key) :?string
    {
        $entry = self::where('key', $key)->first();
        return $entry->value ?? null;
    }

    /**
     * @param $key
     * @param null $value
     * @return bool
     */
    public static function set($key, $value = null): bool
    {
        $entry = self::where('key', $key)->firstOrFail();

        $entry->update([
            'value' => $value
        ]);
        Config::set('key', $value);
        return Config::get($key) === $value;
    }
}
