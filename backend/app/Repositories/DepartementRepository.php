<?php
namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Interfaces\DepartementInterface;

class DepartementRepository extends BaseRepository implements DepartementInterface
{
    protected $modelClassName = 'App\Departement';
}