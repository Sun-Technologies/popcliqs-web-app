<?php 

function get_lat_lon_zip( $zip ,  $conn){

	$query = "select lat, lon from zipgeo where zip5 = :zip ";
   
    $binding = array(
		'zip' => $zip 
	);

	$results = query( $query, $conn , $binding);
	if( $results ){
		return $results[0];
	}
	return false;
}

function degrees_difference($lat1, $lon1, $lat2, $lon2)
{
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            cos(deg2rad($theta));

    $dist = acos($dist);
    $dist = rad2deg($dist);

    $distance = $dist * 60 * 1.1515;

    return $distance;
}
