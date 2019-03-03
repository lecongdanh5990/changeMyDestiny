<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    protected $fillable = ['name','mission_id'];
    public function Mission()
    {
        return $this->belongsTo('App\Mission');
    }
}
