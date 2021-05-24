<?php
namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Interfaces\CustomerInterface;

class CustomerRepository extends BaseRepository implements CustomerInterface
{
    protected $modelClassName = 'App\Customer';
}