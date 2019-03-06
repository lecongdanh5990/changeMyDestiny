<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = ['content','tomato','rating','mission_id'];
    public function mission(){
        return $this->belongsTo('App\Mission');
    }
    public function works(){
        return $this->hasMany('App\Work');
    }
}
