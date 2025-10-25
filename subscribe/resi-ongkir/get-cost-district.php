<?php
// Sample: Calculate Domestic Cost by District
$url = "https://api.nf22.my.id/subscribe/resi-ongkir.php";

$data = [
    'api_key'    => 'xxxxxxxxxxxxxxxxxxxxx',
    'secret_key' => 'xxxxxxxxxxxxxxxxxxxxx',
    'action'     => 'cost_district',          // Endpoint: kalkulasi ongkir
    'origin'     => '1391',                   // Wajib: district_id asal
    'destination'=> '1376',                   // Wajib: district_id tujuan
    'weight'     => '1000',                   // Wajib: gram (1000 = 1 kg)
    'courier'    => 'jne:sicepat:pos',        // Wajib: bisa multi, pisahkan dengan ":"
    // 'price'    => 'lowest',                 // Opsional: lowest | highest | all
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