<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use \App\Http\Traits\Uuids;

    public $incrementing = false;
    protected $guarded = [];

    public function departements()
    {
        
        return $this->belongsTo('App\Departement', 'departement_id', 'id');
       
        
    }

    public function units()
    {
        
        return $this->belongsTo('App\Unit', 'unit_id', 'id');
       
    }
}
