<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $fillable = ['name','status_id'];
    public function status()
    {
        return $this->belongsTo('App\Status');
    }
}
