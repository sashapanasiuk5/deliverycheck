<?php
namespace App\Services;


use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
/**
 * 
 */
class NovaPoshtaStatusFetcher implements IStatusFetcher 
{
	
	function __construct()
	{
		# code...
	}

	public function getStatus($declaration){
		
		$response = retry(4, function () use ($declaration) {

		    return Http::post('https://api.novaposhta.ua/v2.0/json/', [
			    'modelName' => 'TrackingDocument',
			    'calledMethod' => 'getStatusDocuments',
			    'methodProperties' => [
			    	'Documents' => [ ['DocumentNumber' => $declaration, 'Phone' => ""]]
			    ]
			]);
			
		}, 500);

		$response = $response->object();

		if($response->success)
		{
			$statusCode = $response->data[0]->StatusCode;
			$status = $response->data[0]->Status;

			return ['code'=> $statusCode, 'status' => $status];
		}else{
			Log::error("NovaPoshta API.Bad Request");
			Log::error("Response  Body: ".json_encode($response));
		}
		
	}
}
?>