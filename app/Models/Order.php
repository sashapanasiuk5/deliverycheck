<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $key_crm_id
 * @property string $created_datetime
 * @property string $modify_datetime
 * @property string $shipped_datetime
 * @property integer $locked_by
 * @property string $carrier
 * @property integer $id_carrier
 * @property string $courier
 * @property integer $manager_id
 * @property integer $storemanager_id
 * @property string $customer_city
 * @property string $customer_addr
 * @property string $carrier_store
 * @property string $flag_received
 * @property string $customer_name
 * @property string $customer_phone
 * @property string $customer_notes
 * @property string $order_type
 * @property string $order_places_quantity
 * @property string $order_weight
 * @property string $order_volume
 * @property string $order_length
 * @property string $order_height
 * @property string $order_width
 * @property string $products_ary_json
 * @property string $price_category
 * @property string $payment_type
 * @property integer $payment_summ
 * @property string $payment_status
 * @property integer $delivery_summ
 * @property string $delivery_address
 * @property string $payment_date
 * @property string $payment_comment
 * @property string $order_status
 * @property string $preorder_date
 * @property string $carrier_declaration_num
 * @property string $sms_status
 * @property string $manager_notes
 * @property string $pvv_flag
 * @property string $pvv_B0
 * @property string $pvv_H0
 * @property string $pvv_H1
 * @property string $pvv_Ltype
 * @property string $pvv_L
 * @property string $pvv_T0H
 * @property string $pvv_T0W
 * @property string $pvv_T1H
 * @property string $pvv_T1W
 * @property string $pvv_Ptype
 * @property string $currency_USD
 * @property string $currency_EUR
 * @property string $flag_trouble
 * @property string $cat_carrier_ref
 * @property string $cat_city_ref
 * @property string $cat_transmision_note
 */
class Order extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'svs_orders';

    const UPDATED_AT = 'modify_datetime';

    /**
     * @var array
     */
    protected $fillable = ['key_crm_id', 'created_datetime', 'modify_datetime', 'shipped_datetime', 'locked_by', 'carrier', 'id_carrier', 'courier', 'manager_id', 'storemanager_id', 'customer_city', 'customer_addr', 'carrier_store', 'flag_received', 'customer_name', 'customer_phone', 'customer_notes', 'order_type', 'order_places_quantity', 'order_weight', 'order_volume', 'order_length', 'order_height', 'order_width', 'products_ary_json', 'price_category', 'payment_type', 'payment_summ', 'payment_status', 'delivery_summ', 'delivery_address', 'payment_date', 'payment_comment', 'order_status', 'preorder_date', 'carrier_declaration_num', 'sms_status', 'manager_notes', 'pvv_flag', 'pvv_B0', 'pvv_H0', 'pvv_H1', 'pvv_Ltype', 'pvv_L', 'pvv_T0H', 'pvv_T0W', 'pvv_T1H', 'pvv_T1W', 'pvv_Ptype', 'currency_USD', 'currency_EUR', 'flag_trouble', 'cat_carrier_ref', 'cat_city_ref', 'cat_transmision_note'];
}
