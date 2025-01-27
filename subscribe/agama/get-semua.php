<?php
// URL API Anda
$url = "https://api.nf22.my.id/subscribe/agama.php";

// Data yang akan dikirimkan via POST
$data = [
    'api_key' => 'xxxxxxxxxxxxxxxxxxxxx',      // Ganti dengan API Key Anda
    'secret_key' => 'xxxxxxxxxxxxxxxxxxxxx',  // Ganti dengan Secret Key Anda
    'action' => 'semua'        // Action Jangan Diubah
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
    // Decode JSON untuk memastikan data terbaca dengan benar
    $data = json_decode($response, true);

    // Menampilkan respons API dengan format UTF-8 tanpa Unicode escape
    header('Content-Type: application/json; charset=UTF-8');
    echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);  // Menghindari escape pada / dan karakter Unicode
}

// Tutup koneksi cURL
curl_close($ch);
?>
