<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    protected $fillable = ['name','mission_id','startday','endday','realendday'];
    public function mission()
    {
        return $this->belongsTo('App\Mission');
    }
    public function statuses()
    {
        return $this->hasMany('App\Status');
    }
}
