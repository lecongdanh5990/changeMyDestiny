<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    protected $fillable = ['name','startday','endday'];
    public function steps()
    {
        return $this->hasMany('App\Step');
    }
}
