<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiagnosticCentre extends Model
{
    use SoftDeletes;
    protected $fillable =['name', 'address', 'pincode', 'mobile', 'email', 'payment_mechanism', 'payment_frequency'];

    public function tests()
    {
        return $this->belongsToMany('App\Test')->withPivot("price");
    }
}
