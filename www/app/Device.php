<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $table = "devices";
    protected $fillable = ['user_id', 'group_id', 'type_id', 'module_id', 'protocol_id', 'name', 'address', 'last_data'];

    public function group() {
        return $this->belongsTo('App\Group');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function type() {
        return  $this->belongsTo('App\DeviceType');
    }

    public function module() {
        return $this->belongsTo('App\Module');
    }

    public function protocol() {
        return $this->belongsTo('App\Protocol');
    }
}
