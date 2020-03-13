<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Group extends Model
{
    protected $table = "groups";
    protected $primaryKey = "id";
    protected $fillable = ['name', 'description', 'user_id', 'icon_id'];

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

    public function type() {
        //return $this->belongsTo('App\DeviceType');
    }

    public function parent() {
        return $this->belongsTo($this,'parent_id','id');
    }

    public function childs() {
        return $this->hasMany($this,'parent_id','id');
    }

    public function types() {
        return $this->hasManyThrough('App\DeviceType', 'App\Device', 'group_id', 'type_id');
    }
}
