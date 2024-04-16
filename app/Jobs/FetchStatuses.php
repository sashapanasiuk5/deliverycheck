<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\ShippingCheck;
use App\Models\Order;
use App\Models\ShippingStatus;
use App\Models\ShippingStatusHistory;

use App\Services\IStatusFetcher;
use App\Services\NovaPoshtaStatusFetcher;
use App\Services\SATStatusFetcher;
use App\Services\DeliveryStatusFetcher;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FetchStatuses implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    private $novaposhta;
    private $sat;
    private $delivery;

    public function __construct()
    {
        $this->novaposhta = new NovaPoshtaStatusFetcher();
        $this->sat = new SATStatusFetcher(config('services.sat.key'));
        $this->delivery = new DeliveryStatusFetcher();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $orders = DB::table('shipping_status_check')
                    ->join('shipping', 'shipping.id', '=', 'shipping_status_check.shipping_id')
                    ->leftJoin('shipping_status', 'shipping_status.id', '=', 'shipping_status_check.status_id')
                    ->select('slug', 'waybill','order_id', 'status_code', 'status_title', 'shipping_status_check.shipping_id', 'stop_flag')
                    ->get();

        foreach ($orders as $order)
        {
            $fetcher = $this->chooseFetcher($order->slug);
            if(!isset($fetcher))
                continue;
            $fetched = $fetcher->getStatus(trim($order->waybill));

            if($fetched != null)
            {
                $hasNewStatus = false;
                if($fetched['code'] != null)
                {
                    $hasNewStatus = $order->status_code != $fetched['code'];
                }
                else
                {
                    $hasNewStatus = $order->status_title != $fetched['status'];
                }

                $stopChecking = false;
                if($hasNewStatus)
                {
                    $newStatus = $this->getShippingStatus($fetched, $order->slug, $order->shipping_id);

                    if($newStatus == null)
                    {
                        $code = '';
                        if($fetched['code'] !== null)
                        {
                            $code = $fetched['code'];
                        }
                        $newStatus = new ShippingStatus(['shipping_id' => $order->shipping_id,
                                                      'status_code' => $code,
                                                      'status_title' => $fetched['status']
                                                     ]);

                        $newStatus->save();
                    }

                    DB::table('svs_orders')
                          ->where('id', $order->order_id)
                          ->update(['shipping_status' => $newStatus->id]);

                    DB::table('shipping_status_check')
                          ->where('order_id', $order->order_id)
                          ->update(['status_id' => $newStatus->id]);

                    $newStatusHistory = new ShippingStatusHistory(['order_id' => $order->order_id,
                                                                'status_id' => $newStatus->id,
                                                                'changed_at' => Carbon::now()]);
                    $newStatusHistory->save();

                    $stopChecking = $newStatus->stop_flag != null;
                    if($stopChecking)
                    {
                        ShippingCheck::where('order_id', $order->order_id)->delete();
                        Order::where('id',$order->order_id)->update( ['is_shipping' => $newStatus->stop_flag]);
                    }
                }
                else
                {
                    $stopChecking = $order->stop_flag != null;
                    if($stopChecking)
                    {
                        ShippingCheck::where('order_id', $order->order_id)->delete();
                        Order::where('id',$order->order_id)->update( ['is_shipping' => $order->stop_flag]);
                    }
                }



            }
        }
    }


    private function chooseFetcher($slug)
    {
        switch ($slug) {
            case 'novaposhta':
                return $this->novaposhta;
            case 'sat':
                return $this->sat;
            case 'delivery':
                return $this->delivery;
        }
    }

    private function getShippingStatus($newStatus, $shipping_slug, $shipping_id)
    {
        if($newStatus['code'] !== null)
        {
            return ShippingStatus::where('status_code', $newStatus['code'])
                                   ->where('shipping_id', $shipping_id)->first();
        }
        elseif( $shipping_slug == 'sat')
        {
            return ShippingStatus::where('status_title', $newStatus['status'])
                                         ->where('shipping_id', $shipping_id)->first();

        }
        return null;
    }

}
