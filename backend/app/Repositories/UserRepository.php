<?php
namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Interfaces\UserInterface;

class UserRepository extends BaseRepository implements UserInterface
{
    protected $modelClassName = 'App\User';
}