<?php
// URL API
$url = "https://api.nf22.my.id/subscribe/paket-film-drama";

// Data yang akan dikirimkan via POST
// id diambil dari field "playlet_id" hasil endpoint foryou/latest/hotrank/search
$data = [
    'api_key'    => 'xxxxxxxxxxxxxxxxxxxxxx',  // Ganti dengan API Key Anda
    'secret_key' => 'xxxxxxxxxxxxxxxxxxxxxx',  // Ganti dengan Secret Key Anda
    'action'     => 'flickreels',
    'type'       => 'detailAndAllEpisode',
    'id'         => '2746'                     // ID drama dari hasil foryou/search
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
