<?php

// API endpoint dan parameter
$api_url = 'https://netflazz.com/api/pascabayar';
$api_key = 'CxiSNq6bzaxWCTF5l75Caxxxxxxx'; // Ganti dengan api key anda
$action = 'layanan';

// Data yang akan dikirim sebagai payload
$postdata = [
    'api_key' => $api_key,
    'action' => $action,
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
    $layanan_data = $json_result['data'];

    echo "SID: " . $layanan_data['sid'] . "<br>";
    echo "Operator: " . $layanan_data['operator'] . "<br>";
    echo "Layanan: " . $layanan_data['layanan'] . "<br>";
    echo "Admin: " . $layanan_data['admin'] . "<br>";
    echo "Status: " . $layanan_data['status'] . "<br>";
    echo "Tipe: " . $layanan_data['tipe'] . "<br>";
} else {
    echo "Gagal mendapatkan layanan. Pesan: " . $json_result['data']['pesan'];
}

?>
