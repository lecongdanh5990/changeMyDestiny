<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    protected $fillable=['name','startday','endday','mission_id'];
    public function mission()
    {
        return $this->belongsTo('App\Mission');
    }
    public function works()
    {
        return $this->hasMany('App\Work');
    }
}
