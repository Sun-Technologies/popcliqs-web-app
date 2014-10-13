<?php 


set_time_limit(0);

// Prod
$mysqlhost  = 'popcliqsweb.db.10862321.hostedresource.com';
$mysqluser  = 'popcliqsweb';
$mysqlpass  = 'Bubble@2013';
$mysqldb    = 'popcliqsweb';


// $mysqlhost  = 'localhost';
// $mysqluser  = 'root';
// $mysqlpass  = 'root';
// $mysqldb    = 'popcliqs_web';


$mysqltable = 'zipgeo';


$country_cd = $_GET['cd'];

mysql_connect($mysqlhost, $mysqluser, $mysqlpass) or die(mysql_error());
mysql_select_db($mysqldb) or die(mysql_error());

$fields = array('zip5', 'city', 'state', 'lat', 'lon', 'county', 'country');
$contents = file('zip5-'.$country_cd.'.csv');

$buffer = 100;
$basestatement = "insert into {$mysqltable} (`" . implode("`, `", $fields) . "`) VALUES ";


$counter = 0;
$inserts = array();
foreach ($contents as $line) {
    $linefields = explode(',', $line);
    $linefields = array_map('trim', $linefields);
    $linefields = array_map('mysql_real_escape_string', $linefields);
    $inserts[] = "('" . implode("', '", $linefields) . "' , '$country_cd')";
    $counter++;

    if ($counter == $buffer) {
        $query = $basestatement . implode(',', $inserts);
        mysql_query($query) or die(mysql_error());
        $counter = 0;
        $inserts = array();
    }
}

if (count($inserts)) {
    $query = $basestatement . implode(',', $inserts);
    mysql_query($query);
}

print 'done';
?>