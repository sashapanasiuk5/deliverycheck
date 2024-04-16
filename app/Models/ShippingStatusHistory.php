<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $order_id
 * @property integer $status_id
 * @property string $changed_at
 */
class ShippingStatusHistory extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'shipping_status_history';

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['order_id', 'status_id', 'changed_at'];
}
