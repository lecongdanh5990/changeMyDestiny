<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    protected $fillable = ['name','startday','endday','realendday'];
    public function steps()
    {
        return $this->hasMany('App\Step');
    }
    public function statuses()
    {
        return $this->hasMany('App\Status');
    }
}
