<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
/**
 * 
 */
class DeliveryStatusFetcher implements IStatusFetcher 
{
	
	function __construct()
	{
	}

	public function getStatus($declaration){
		
		$response = Http::get('https://www.delivery-auto.com/api/v4/Public/GetReceiptDetails/', [
		    'culture' => 'uk-UA',
		    'number' => $declaration
			])->object();
		

		if($response->status &&  $response->data != null)
		{
			$statusCode = $response->data->Status;
			$status = $response->data->StatusesDecoding;
			return ['code'=> $statusCode, 'status' => $status];
		}else{
			Log::error("Delivery API.Bad Request");
			Log::error("Response  Body: ".json_encode($response));
		}
	}
}
?>