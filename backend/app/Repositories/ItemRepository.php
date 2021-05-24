<?php
namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Interfaces\ItemInterface;

class ItemRepository extends BaseRepository implements ItemInterface
{
    protected $modelClassName = 'App\Item';
}