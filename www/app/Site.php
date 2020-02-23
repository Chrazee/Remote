<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $table = 'site';
    protected $primaryKey = 'id';

    public $name;
    public $value;
    public $timestamps = false;

    public static function get($name) {
        return self::select('value')
                ->where('name', $name)
                ->pluck('value')[0];
    }

    public static function updateData($name, $value) {
        return self::where('name', $name)->update(['value' => $value]);
    }
}
