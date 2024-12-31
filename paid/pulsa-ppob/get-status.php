<?php

// API endpoint dan parameter
$api_url = 'https://api.nf22.my.id/prabayar';
$api_key = 'xxxxxxxxxxxxxxxxxxxxx'; // Ganti dengan api key anda
$pin = '1234'; // Ganti dengan pin anda
$action = 'status';
$order_id = '40'; // Ganti dengan Order ID yang sesuai

// Data yang akan dikirim sebagai payload
$postdata = [
    'api_key' => $api_key,
    'pin' => $pin,
    'action' => $action,
    'id' => $order_id,
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
    echo "ID Pesanan: " . $json_result['data']['id'] . "<br>";
    echo "Status: " . $json_result['data']['status'] . "<br>";
    echo "Catatan: " . $json_result['data']['catatan'] . "<br>";
} else {
    echo "Pengecekan status gagal. Pesan: " . $json_result['data']['pesan'];
}

?>
