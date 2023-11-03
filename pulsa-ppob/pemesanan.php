<?php

// API endpoint dan parameter
$api_url = 'https://netflazz.com/api/pulsa';
$api_key = 'CxiSNq6bzaxWCTF5l75Caxxxxxxx'; // Ganti dengan api key anda
$action = 'pemesanan';
$layanan_id = '123'; // Ganti dengan Service ID yang sesuai
$target = '08123456789'; // Ganti dengan nomor HP atau tujuan lainnya
$no_meter = '08123456789'; // Ganti dengan nomor HP jika pemesanan pulsa

// Data yang akan dikirim sebagai payload
$postdata = [
    'api_key' => $api_key,
    'action' => $action,
    'layanan_id' => $layanan_id,
    'target' => $target,
    'no_meter' => $no_meter,
];

// Inisialisasi cURL
$ch = curl_init();

// Setel opsi cURL
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postdata));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Eksekusi cURL dan dapatkan respon
$response = curl_exec($ch);

// Tutup koneksi cURL
curl_close($ch);

// Dekode respon JSON
$json_result = json_decode($response, true);

// Tampilkan hasil
if ($json_result['status'] == true) {
    echo "Pemesanan berhasil. ID Pesanan: " . $json_result['data']['id_pesanan'];
} else {
    echo "Pemesanan gagal. Pesan: " . $json_result['data']['pesan'];
}

?>
