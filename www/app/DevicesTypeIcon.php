<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DevicesTypeIcon extends Model
{
    protected $table = "devices_type_icon";

    public function icon() {
        return $this->belongsTo('App\DevicesTypeIcon');
    }
}
