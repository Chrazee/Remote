<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Group extends Model
{
    protected $table = "groups";
    protected $primaryKey = "id";
    protected $fillable = ['name', 'description', 'user_id', 'parent_id'];

    public function devices() {
        return $this->hasMany('App\Device');
    }

    public function parent() {
        return $this->belongsTo($this,'parent_id','id');
    }

    public function child() {
        return $this->hasMany($this,'parent_id','id');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function device() {
        return $this->hasMany('App\Device');
    }

    public static function countDevicesFromId($id) {
        $group = Group::with(['device','child', 'child.device'])->where('user_id', Auth::user()->id)->find($id);
        $counter = 0;
        $counter += $group->device->count();

        foreach ($group->child as $child) {
            $counter +=  self::countDevicesFromId($child->id);
        }

        return $counter;
    }

    public static function getParentsFromId($id) {
        $group = Group::with(['parent'])->where('user_id', Auth::user()->id)->find($id);
        $original = $group;
        $parents = [];

        if($group->parent != null) {
            $parents[] = [
                'name' => $group->parent->name,
                'id' => $group->parent->id,
            ];

            $temp = self::getParentsFromId($group->parent->id);
        }
        if(isset($temp)) {
            foreach ($temp as $t) {
                if(array_key_exists('name', $t) && array_key_exists('id', $t)) {
                    $parents[] = [
                        'name' => $t['name'],
                        'id' => $t['id']
                    ];
                }
            }
        }

        return array_reverse($parents);
    }
}
