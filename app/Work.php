<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $fillable=['name','iscomplete','step_id','description'];
    public function step()
    {
        return $this->belongsTo('App\Step');
    }
}
