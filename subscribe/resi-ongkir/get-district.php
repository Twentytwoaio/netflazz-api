<?php
// Sample: Get District by City ID
$url = "https://api.nf22.my.id/subscribe/resi-ongkir.php";

$data = [
    'api_key'   => 'xxxxxxxxxxxxxxxxxxxxx',
    'secret_key'=> 'xxxxxxxxxxxxxxxxxxxxx',
    'action'    => 'district',  // Endpoint: District
    'city_id'   => '575',       // Wajib: ID Kota/Kab (dari endpoint city)
    // 'search' => 'tebet',     // (opsional) filter nama kecamatan
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