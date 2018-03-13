<?php
/*
Developer Name: Rohit Srivastava
Project Name: Chitranshu Technologies
*/
public function findlatlongaddress($latitude,$longitude){		
	if(!empty($latitude) && !empty($longitude)){
		$url="https://maps.googleapis.com/maps/api/geocode/json?latlng=".trim($latitude).",".trim($longitude)."&key=YOUR_API_KEY";            
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_PROXYPORT, 443);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$response = curl_exec($ch);			
		$json = json_decode($response,TRUE);			
		
		$address_arr = $json['results'][0]['address_components'];
		$address  = "";
		$city     = "";
		$state    = "";
		$zip_code = "";
		$country  = "";			
		if (!empty($address_arr)){		    			
			foreach($address_arr as $arr1){
				if(strcmp($arr1['types'][0],"street_number") == 0){
				$address .= $arr1['long_name']." ";
				continue;
				}
				if(strcmp($arr1['types'][0],"route") == 0){
				$address .= $arr1['long_name'];
				continue;
				}
				if(strcmp($arr1['types'][0],"locality") == 0){
				$city = $arr1['long_name'];
				continue;
				}
				if(strcmp($arr1['types'][0],"administrative_area_level_1") == 0){
				$state = $arr1['long_name'];
				continue;
				}
				if(strcmp($arr1['types'][0],"administrative_area_level_2") == 0){
				$state2 = $arr1['long_name'];
				continue;
				}
				if(strcmp($arr1['types'][0],"postal_code") == 0){
				$zip_code = $arr1['long_name'];
				continue;
				}
				if(strcmp($arr1['types'][0],"country") == 0){
				$country = $arr1['long_name'];
				continue;
				}	 
			}				 
		}
        $response = array("address"=>$address, "city"=>$city, "state"=>$state, "zipcode"=>$zip_code, "country"=>$country);
		return $response;			
	}else{
	return false;   
	}
}
/********************cURL Getting Address END*************************/
/********************cURL Getting Address END*************************/
?>