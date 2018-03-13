<?php
/*
Developer Name: Rohit Srivastava
Project Name: Chitranshu Technologies
Purpose: Getting address from lattitude ,longitude
*/
include('latlongFunction.php');
$latitude=$_POST['userlatitude'];
$longitude=$_POST['userlongitude'];
$fullname=$_POST['fullname'];
if($latitude!= '' && $longitude!= ''){
	$getaddressdata = findlatlongaddress($latitude,$longitude);			
	$cities = $getaddressdata['city'];
	$stat = $getaddressdata['state'];
	$countries = $getaddressdata['country'];
	$data = array(			   
	   'latitude' 			   => $latitude,
	   'longitude' 			   => $longitude,	
	   'fullname' 			   => $fullname,			   
	   'city'                  => $cities,
	   'state'                 => $stat,
	   'country'               => $countries					  
	);							
				
	$result['success']="true";
	$result['data']=$data;
	$result['value']="Added successfully";				    
}else{
	$result['success']="false";
	$result['value']="Error";
}
echo json_encode($result);
?>