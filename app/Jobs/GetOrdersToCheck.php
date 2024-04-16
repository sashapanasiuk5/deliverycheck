<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;

use App\Models\ShippingCheck;
use App\Models\Shipping;
use App\Models\Order;
class GetOrdersToCheck implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $updated_orders = DB::table('svs_orders')
                            ->where('modify_datetime', '>=', \Carbon\Carbon::now()->subHour())
                            ->whereNotNull('carrier_declaration_num')
                            ->where('carrier_declaration_num', '<>', '')
                            ->whereRaw('NOT EXISTS (
                                            select 
                                              * 
                                            from 
                                              `shipping_status_check` 
                                            where 
                                              `shipping_status_check`.`order_id` = `svs_orders`.`id` 
                                          )')
                            ->where(function (Builder $query) {
                                 $query->where('is_shipping','<>', 'delivered')
                                       ->orWhere('is_shipping','<>', 'not delivered');
                             })->get();

        foreach ($updated_orders as $order) {
            $shipping = $this->findShipping($order->id_carrier);

            if($shipping != null)
            {
              $toCheck = new ShippingCheck(['order_id' => $order->id,
                                          'shipping_id' => $shipping->id,
                                          'status_id' => null,
                                          'waybill' => $order->carrier_declaration_num]);
              $toCheck->save();
              DB::table('svs_orders')->where('id',$order->id)->update( ['is_shipping' => 'in the way']);
            }
        }
        
        
    }

    private function findShipping($carrier_id)
    {
        switch ($carrier_id) {
            case 1:
                return Shipping::where('slug', 'sat')->first();
            case 2:
                return Shipping::where('slug', 'delivery')->first();
            case 3:
                return Shipping::where('slug', 'novaposhta')->first();
        }
    }
}
