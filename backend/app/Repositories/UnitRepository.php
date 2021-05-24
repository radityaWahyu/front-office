<?php
namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Interfaces\UnitInterface;

class UnitRepository extends BaseRepository implements UnitInterface
{
    protected $modelClassName = 'App\Unit';
}