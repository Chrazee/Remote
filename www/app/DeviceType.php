<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeviceType extends Model
{
    protected $table = "devices_type";
    protected $fillable = ['name', 'display_name', 'icon_id'];

    public function devices() {
        return $this->hasMany('App\Device', 'type_id', 'id');
    }

    public function icon() {
        return $this->belongsTo('App\DevicesTypeIcon');
    }
}
