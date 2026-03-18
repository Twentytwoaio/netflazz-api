<?php
// URL API
$url = "https://api.nf22.my.id/subscribe/paket-film-drama";

// Data yang akan dikirimkan via POST
$data = [
    'api_key'    => 'xxxxxxxxxxxxxxxxxxxxxx',  // Ganti dengan API Key Anda
    'secret_key' => 'xxxxxxxxxxxxxxxxxxxxxx',  // Ganti dengan Secret Key Anda
    'action'     => 'reelshort',
    'type'       => 'homepage'
];

// Inisiasi cURL
$ch = curl_init($url);

// Set opsi cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

// Eksekusi cURL dan simpan respons
$response = curl_exec($ch);

// Cek apakah ada error
if ($response === false) {
    echo 'Error: ' . curl_error($ch);
} else {
    $result = json_decode($response, true);
    header('Content-Type: application/json; charset=UTF-8');
    echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}

curl_close($ch);
?>
