<?php

// API endpoint dan parameter
$api_url = 'https://netflazz.com/api/pascabayar';
$api_key = 'CxiSNq6bzaxWCTF5l75Caxxxxxxx'; // Ganti dengan api key anda
$action = 'bayar-tagihan';

// Data yang akan dikirim sebagai payload
$postdata = [
    'api_key' => $api_key,
    'action' => $action,
    'id' => 'Order_ID', // Gantilah dengan Order ID yang sesuai
    'layanan' => 'Service_ID_Layanan', // Gantilah dengan Service ID Layanan yang sesuai
    'target' => 'Nomor_Tujuan', // Gantilah dengan nomor tujuan yang sesuai
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
    echo "ID: " . $json_result['data']['id'] . "<br>";
    echo "Status: " . $json_result['data']['status'] . "<br>";
    echo "Catatan: " . $json_result['data']['catatan'] . "<br>";
} else {
    echo "Pembayaran tagihan gagal. Pesan: " . $json_result['data']['pesan'];
}

?>
