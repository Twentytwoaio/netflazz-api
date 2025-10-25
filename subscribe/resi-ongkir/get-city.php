<?php
// Sample: Get City by Province ID
$url = "https://api.nf22.my.id/subscribe/resi-ongkir.php";

$data = [
    'api_key'     => 'xxxxxxxxxxxxxxxxxxxxx',
    'secret_key'  => 'xxxxxxxxxxxxxxxxxxxxx',
    'action'      => 'city',        // Endpoint: City
    'province_id' => '6',           // Wajib: ID Provinsi (dari endpoint province)
    // 'search'   => 'jakarta',     // (opsional) filter nama kota/kab
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