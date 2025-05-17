<?php
// API Endpoint
$url = "https://api.nf22.my.id/subscribe/mutasi-ewallet";

// Data untuk request delete akun
$data = [
    "api_key" => "xxxxxxxxxxxxxxxxxxxxx",      // Ganti dengan API Key Anda
    "secret_key" => "xxxxxxxxxxxxxxxxxxxxx",  // Ganti dengan Secret Key Anda
    "action" => "delete"    // Action Jangan Diubah
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/x-www-form-urlencoded'
]);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
} else {
    // Tampilkan response JSON mentah langsung
    echo $response;
}

curl_close($ch);
?>