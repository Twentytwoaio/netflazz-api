<?php
// URL API Anda
$url = "https://api.nf22.my.id/subscribe/wilayah-indonesia.php";

// Data yang akan dikirimkan via POST
$data = [
    'api_key' => 'xxxxxxxxxxxxxxxxxxxxx',     // Ganti dengan API Key Anda
    'secret_key' => 'xxxxxxxxxxxxxxxxxxxxx', // Ganti dengan Secret Key Anda
    'action' => 'kelurahan',            // Action Jangan Diubah
    'id_kecamatan' => '36.72.01'       // Ganti dengan ID Kecamatan yang ingin diambil
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
if($response === false) {
    echo 'Error: ' . curl_error($ch);
} else {
    // Menampilkan respons API
    echo $response;
}

// Tutup koneksi cURL
curl_close($ch);
?>
