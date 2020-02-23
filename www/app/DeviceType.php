<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeviceType extends Model
{
    protected $table = "devices_type";

    public function devices() {
        return $this->hasMany('App\Device', 'type_id', 'id');
    }

    public function icon() {
        return $this->hasOne('App\DevicesTypeIcon');
    }
}
