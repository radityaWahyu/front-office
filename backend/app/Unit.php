<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use \App\Http\Traits\Uuids;

    public $incrementing = false;
    protected $guarded = [];

}
