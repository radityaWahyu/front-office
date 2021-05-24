<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    use \App\Http\Traits\Uuids;

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'role', 'departement_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    public function findForPassport($username)
    {
        return $this->where('username', $username)->first();
    }

    public function hasRole(array $role)
    {
        foreach ($role as $row) {
            if($this->role == $row) {
                return true;
            }
        }
    }

    public function departements()
    {
        return $this->belongsTo('App\Departement', 'departement_id', 'id');
    }
}
