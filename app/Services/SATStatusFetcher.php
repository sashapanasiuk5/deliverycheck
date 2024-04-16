<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
/**
 * 
 */
class SATStatusFetcher implements IStatusFetcher 
{
	private $apiKey;
	function __construct($apiKey)
	{
		$this->apiKey = $apiKey;
	}

	public function getStatus($declaration){
		$response = Http::get('http://urm.sat.ua/openws/hs/api/v1.0/tracking/json', [
		    'number' => $declaration,
		    'apiKey' => $this->apiKey,
		])->object();

		if($response->success)
		{
			$status = $response->data[0]->currentStatus;
			return ['code'=> null, 'status' => $status];
		}else{
			Log::error("SAT API.Bad Request");
			Log::error("Response  Body: ".json_encode($response));
		}
	}
}
?>