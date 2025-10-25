<?php
// Sample: Get Courier Codes (statis)
$url = "https://api.nf22.my.id/subscribe/resi-ongkir.php";

$data = [
    'api_key'    => 'xxxxxxxxxxxxxxxxxxxxx',
    'secret_key' => 'xxxxxxxxxxxxxxxxxxxxx',
    'action'     => 'courier_codes', // Endpoint: daftar kurir
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

$response = curl_exec($ch);
if ($response === false) { echo 'Error: ' . curl_error($ch); }
else { echo $response; }

curl_close($ch);
?>