<?php
// URL API Anda
$url = "https://api.nf22.my.id/subscribe/cek-tarif.php";

// Data yang akan dikirimkan via POST
$data = [
    'api_key' => 'xxxxxxxxxxxxxxxxxxxxx',      // Ganti dengan API Key Anda
    'secret_key' => 'xxxxxxxxxxxxxxxxxxxxx',  // Ganti dengan Secret Key Anda
    'action' => 'cekWilayah',            // Action Jangan Diubah
    'courier' => 'lion',            // Ubah Dengan Expedisi (jne/sicepat/anteraja/lion/sap/pos/ide)
    'type' => 'origin',            // Ubah Dengan Type (origin/destination)
    'search' => 'cirebon'            // Nama Kota Yang Ingin Dicek
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
