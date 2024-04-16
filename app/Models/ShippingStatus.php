<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $shipping_id
 * @property string $status_title
 * @property string $status_code
 * @property string $stop_flag
 */
class ShippingStatus extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'shipping_status';

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['shipping_id', 'status_title', 'status_code', 'stop_flag'];
}
