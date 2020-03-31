<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Device extends Model
{
    protected $table = "devices";
    protected $fillable = ['display_name', 'group_id', 'user_id', 'type_id', 'last_data', 'ip'];

    public static function exists($id) {
        $id = self::
                select("id")
                ->where("id" , $id)
                ->get();

        if($id->isEmpty()) {
            return false;
        }
        return true;
    }

    public static function getGroupDevices($id, $type) {
        // SELECT type, COUNT(type) AS devices, devicetype.display_name FROM devices JOIN devicetype ON devicetype.name=type WHERE rooro_id=11 GROUP BY type;
        return self::
                select('*')
                ->where('group_id', $id)
                ->where('type', $type)
                ->get();
    }

    public static function getType($type) {
        return DB::table('devicetype')
                ->select('*')
                ->where("name" , $type)
                ->get();
    }

    public static function typeExists($name) {
        $type = DB::table('devicetype')
                ->select('name')
                ->where("name" , $name)
                ->get();

        if($type->isEmpty()) {
            return false;
        }
        return true;
    }

    public function type() {
        return  $this->belongsTo('App\DeviceType');
    }

    public function group() {
        return $this->belongsTo('App\Group');
        /*return $this->hasMany('App\Group', 'group_id', 'id');*/
    }

    public function module() {
        return $this->belongsTo('App\Module');
    }
}
