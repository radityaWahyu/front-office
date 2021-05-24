<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use \App\Http\Traits\Uuids;

    public $incrementing = false;
    protected $guarded = [];

}
