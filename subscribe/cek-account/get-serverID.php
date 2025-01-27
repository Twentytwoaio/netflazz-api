<?php
// URL API Anda
$url = "https://api.nf22.my.id/subscribe/cek-account.php";

// Data yang akan dikirimkan via POST
$data = [
    'api_key' => 'xxxx',  // Ganti dengan API Key Anda
    'secret_key' => 'xx1234',          // Ganti dengan Secret Key Anda
    'action' => 'serverID'            // Mengambil list data
];

// Inisiasi cURL
$ch = curl_init($url);

// Set opsi cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

// Eksekusi cURL dan simpan respons
$response = curl_exec($ch);

// Cek apakah ada error saat mengambil data
if ($response === false) {
    echo 'Error: ' . curl_error($ch);
} else {
    // Dekode JSON respons menjadi array PHP
    $response_data = json_decode($response, true);

    // Menampilkan data sebagai JSON
    echo json_encode($response_data, JSON_UNESCAPED_UNICODE);
}

// Tutup koneksi cURL
curl_close($ch);
?>
