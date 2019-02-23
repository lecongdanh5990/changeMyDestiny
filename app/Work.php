<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $fillable=['name','iscomplete','description','priority','mission_id'];
    public function mission(){
        return $this->belongsTo('App\Mission');
    }
}
