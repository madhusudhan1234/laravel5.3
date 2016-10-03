<?php

namespace Lara\Core\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Item
 * @package Lara\Core\Models
 */
class Item extends Model
{
    /**
     * @var array
     */
    public $fillable = ['title', 'description'];
}
