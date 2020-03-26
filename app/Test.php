<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Test extends Model
{
    use SoftDeletes;
    protected $fillable = ['name'];

    public function diagnostic_centres()
    {
        return $this->belongsToMany('App\DiagnosticCentre')->withPivot("price");
    }
}
