<?php
require_once 'unirest-php/src/Unirest.php';
$headers = array('Accept' => 'application/json');

$url = "https://nomadlist.com/api/v2/filter/city?c=1&f1_target=temperatureC&f1_type=lt&f1_max=20&s=nomad_score&o=desc";
$response = Unirest\Request::post($url, $headers);

print_r($response);


//echo phpinfo();

?>
