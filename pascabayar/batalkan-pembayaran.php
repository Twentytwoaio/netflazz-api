<?php

// API endpoint dan parameter
$api_url = 'https://netflazz.com/api/pascabayar';
$api_key = 'CxiSNq6bzaxWCTF5l75Caxxxxxxx'; // Ganti dengan api key anda

// Data yang akan dikirim sebagai payload
$postdata = [
    'api_key' => $api_key,
    'action' => $action,
    'id' => 'Order_ID', // Gantilah dengan Order ID yang sesuai
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
    echo "Pembatalan pembayaran berhasil. Pesan: " . $json_result['data']['pesan'];
} else {
    echo "Gagal melakukan pembatalan pembayaran. Pesan: " . $json_result['data']['pesan'];
}

?>
