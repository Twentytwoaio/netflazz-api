<?php
// Sample: Get Province
$url = "https://api.nf22.my.id/subscribe/resi-ongkir.php";

$data = [
    'api_key'    => 'xxxxxxxxxxxxxxxxxxxxx', // Ganti dengan API Key Anda
    'secret_key' => 'xxxxxxxxxxxxxxxxxxxxx', // Ganti dengan Secret Key Anda
    'action'     => 'province',              // Endpoint: Province
    // 'search'  => 'jawa',                  // (opsional) filter nama provinsi
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