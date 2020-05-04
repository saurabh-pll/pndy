<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testreq extends Model
{
    use SoftDeletes;

    protected $fillable = ['request_id', 'test_id', 'patient_id', 'diagnostic_centre_id', 'allotted_date', 'allotted_time', 'unique_id', 'otp' ];

    protected $dates =['completed_at'];
    public function requests()
    {
        return $this->belongsTo('App\Request');
    }

   
}
