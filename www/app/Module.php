<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $table = 'modules';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'directory', 'name', 'description'];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
