<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = ['content','tomato','rating','step_id'];
    public function step(){
        return $this->belongsTo('App\Step');
    }
    public function works(){
        return $this->hasMany('App\Work');
    }
}
