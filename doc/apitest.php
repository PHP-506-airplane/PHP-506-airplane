<?php

$ch = curl_init();
// $url = 'http://openapi.airport.co.kr/service/rest/AirportCodeList/getAirportCodeList'; /*URL*/
$url = 'http://openapi.airport.co.kr/service/rest/FlightStatusList/getFlightStatusList'; /*URL*/
$queryParams = '?' . urlencode('serviceKey') . '=q1Huc9EjZjvBYP%2BNKi0ILB%2FS%2BhmYkimR2o%2FIfQey1bl0NGsyoDHQJVnSYSEwPfvS9C9SqZkaD%2FXMw9SLRkLlqA%3D%3D'; /*Service Key*/

curl_setopt($ch, CURLOPT_URL, $url . $queryParams);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
$response = curl_exec($ch);
$result = simplexml_load_string($response);
$a = json_encode($result, JSON_UNESCAPED_UNICODE);

curl_close($ch);

return print_r($a);