<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = "groups";
    protected $primaryKey = "id";
    protected $fillable = ['name', 'description', 'user_id', 'icon_id', 'parent_id'];

    public function devices() {
        return $this->hasMany('App\Device');
    }

    public function icon() {
        return $this->belongsTo('App\GroupsIcon');
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
}
