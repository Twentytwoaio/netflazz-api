<?php
// Sample: Get Subdistrict by District ID
$url = "https://api.nf22.my.id/subscribe/resi-ongkir.php";

$data = [
    'api_key'     => 'xxxxxxxxxxxxxxxxxxxxx',
    'secret_key'  => 'xxxxxxxxxxxxxxxxxxxxx',
    'action'      => 'subdistrict', // Endpoint: Subdistrict
    'district_id' => '5823',        // Wajib: ID Kecamatan (dari endpoint district)
    // 'search'   => 'tanjung',     // (opsional) filter nama kelurahan/desa
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