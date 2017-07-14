<?php

class ApiProxy {

	const GET_STARSHIPS_URL = "http://swapi.co/api/starships/?format=json";
	
	public function getShips() {
		$ships = array();
		$next = self::GET_STARSHIPS_URL;
		  
		while ($next != null) {
			
			$starshipsApiResult = $this->CallAPI("GET", $next);
			$starshipsApiJson = json_decode($starshipsApiResult, true);

			$next = $starshipsApiJson['next'];

			$ships = array_merge($ships, $starshipsApiJson['results']);

		}

		return $ships; 
	}

	//https://stackoverflow.com/questions/9802788/call-a-rest-api-in-php
	private function CallAPI($method, $url, $data = false) {

		// Method: POST, PUT, GET etc
		// Data: array("param" => "value") ==> index.php?param=value

		$curl = curl_init();

		switch ($method)
		{
			case "POST":
				curl_setopt($curl, CURLOPT_POST, 1);

				if ($data)
					curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
				break;
			case "PUT":
				curl_setopt($curl, CURLOPT_PUT, 1);
				break;
			default:
				if ($data)
					$url = sprintf("%s?%s", $url, http_build_query($data));
		}

		// Optional Authentication:
		//curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		//curl_setopt($curl, CURLOPT_USERPWD, "username:password");

		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		$result = curl_exec($curl);

		curl_close($curl);

		return $result;
	}
}