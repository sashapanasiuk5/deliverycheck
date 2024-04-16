<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $shipping_id
 * @property integer $order_id
 * @property integer $status_id
 * @property string $waybill
 * @property string $updated_at
 * @property string $date_payed_keeping
 */
class ShippingCheck extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'shipping_status_check';
    public $timestamps = ['updated_at'];

    const CREATED_AT = null;

    /**
     * @var array
     */
    protected $fillable = ['shipping_id', 'order_id', 'status_id', 'waybill', 'date_payed_keeping'];
}
