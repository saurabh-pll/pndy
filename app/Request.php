<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Request extends Model
{
    use SoftDeletes;

    protected $fillable = ['patient_id', 'hospital_id', 'prescription', 'ailment', 'doctor', 'case_history'];

    public function testreqs()
    {
        return $this->hasMany('App\Testreq');
    }

    public function hospital()
    {
        return $this->belongsTo('App\Hospital');
    }
    
}
