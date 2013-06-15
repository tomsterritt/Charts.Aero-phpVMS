<?php
/*
 * Charts.aero for phpVMS
 *
 * Copyright 2013, Tom Sterritt - http://sterri.tt
 * Released under the Creative Commons Attribution-NonCommercial-ShareAlike Licence
 * http://creativecommons.org/licenses/by-nc-sa/3.0/
 *
 * Github:  https://github.com/tomsterritt/Charts.Aero-phpVMS
 * Version: 1.0.0
 */

class AeroCharts extends CodonData {
	
	// Enter your mashape.com authorisation key here.
	private static $maShapeKey = "";
	
	public static function Search($query){
		// This doesn't return a particularly useful response, but handle it if you wish
		$data = array('query' => $query);
		return self::MakeRequest('https://charts.p.mashape.com/search', $data);
	}
	
	public static function GetByICAO($icao){
		// Basic valiation
		if(strlen($icao) > 4 || strlen($icao) == 0){
			return false;
		}
		$data = array('icao' => $icao);
		return self::ChartArray(self::MakeRequest('https://charts.p.mashape.com/retrieve/icao', $data));
	}
	
	public static function GetByIATA($iata){
		// Basic validation
		if(strlen($iata) > 3 || strlen($iata) == 0){
			return false;
		}
		$data = array('iata' => $icao);
		return self::ChartArray(self::MakeRequest('https://charts.p.mashape.com/retrieve/iata', $data));
	}
	
	private static function MakeRequest($url, $data){
		$curl = curl_init();
		
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $url,
			CURLOPT_POST => 1,
			CURLOPT_POSTFIELDS => $data,
			CURLOPT_HTTPHEADER => array(
				'X-Mashape-Authorization' => self::$maShapeKey
			)
		));
		
		return curl_exec($curl);
		curl_close($curl);
	}
	
	private static function ChartArray($data){
		$response = json_decode($data);
		if($response == NULL || isset($response->message) || !isset($response->status) || $response->status !== 'success'){
			// Either it's broken or you don't have a subscription. Display your own friendly message.
			return false;
		}
		
		$ret = array(
			'airportName' 	=> $response->airport->airport_name,
			'city' 			=> $response->airport->city,
			'icao' 			=> $response->airport->icao,
			'iata' 			=> $response->airport->iata,
			'charts' 		=> $response->data
		);
		return (object)$ret;
	}
}

?>