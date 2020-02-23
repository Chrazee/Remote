<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Group extends Model
{
    protected $table = "groups";
    protected $primaryKey = "id";
    protected $fillable = ['name', 'description'];

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

    public function devices() {
        return $this->hasMany('App\Device');
    }

    public function icon() {
        return $this->belongsTo('App\GroupsIcon');
    }

    public function childs() {
        return $this->hasMany($this,'parent_id','id');
    }

    public function type() {
        return $this->belongsTo('App\DeviceType');
    }
}
