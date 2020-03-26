<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'mobile', 'aadhar_no', 'age', 'sex', 'address', 
        'city', 'state', 'country', 'pincode', 'file'];
    
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }
    
}
