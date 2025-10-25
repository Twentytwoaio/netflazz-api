<?php
// Sample: Tracking AWB
$url = "https://api.nf22.my.id/subscribe/resi-ongkir.php";

$data = [
    'api_key'           => 'xxxxxxxxxxxxxxxxxxxxx',
    'secret_key'        => 'xxxxxxxxxxxxxxxxxxxxx',
    'action'            => 'track_awb', // Endpoint: tracking AWB
    'courier'           => 'jne',       // Wajib: kode kurir (jne/jnt/sicepat/pos/dll)
    'awb'               => 'TGxxxxxxxx', // Wajib: nomor resi
    'last_phone_number' => '12345',     // Wajib khusus JNE: 5 digit akhir no HP penerima
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