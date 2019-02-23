<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    protected $fillable = ['name','startday','endday'];
    public function works()
    {
        return $this->hasMany('App\Step');
    }
}
