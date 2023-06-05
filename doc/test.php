<?php

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://adsbexchange-com1.p.rapidapi.com/v2/registration/N8737L/",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_SSL_VERIFYHOST => false,
    CURLOPT_SSL_VERIFYPEER => false,
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: adsbexchange-com1.p.rapidapi.com",
		"X-RapidAPI-Key: cd72c065famsh32c90cd75d973a2p1fad73jsnac4705e17781"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}