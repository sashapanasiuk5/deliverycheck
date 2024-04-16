<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $name_ua
 * @property string $slug
 * @property integer $position
 * @property boolean $status
 * @property boolean $has_city
 * @property boolean $has_address
 * @property boolean $has_warehouse
 * @property boolean $has_npcity
 * @property boolean $has_npwarehouse
 * @property integer $rozetka_id
 * @property integer $prom_id
 * @property integer $allo_id
 */
class Shipping extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'shipping';

    /**
     * @var array
     */
    protected $fillable = ['name', 'name_ua', 'slug', 'position', 'status', 'has_city', 'has_address', 'has_warehouse', 'has_npcity', 'has_npwarehouse', 'rozetka_id', 'prom_id', 'allo_id'];
}
