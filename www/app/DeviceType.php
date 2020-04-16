<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeviceType extends Model
{
    protected $table = "devices_type";
    protected $fillable = ['name', 'user_id'];

    public function devices() {
        return $this->hasMany('App\Device', 'type_id', 'id');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
