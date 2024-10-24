<?php

// API endpoint dan parameter (gunakan salah satu URL SOSMED sesuai kebutuhan)
$api_url = 'https://api.nf22.my.id/sosmed'; // Sosial media 1
$api_url = 'https://api.nf22.my.id/sosmed2'; // Sosial media 2
$api_url = 'https://api.nf22.my.id/sosmed3'; // Sosial media 3
$api_key = 'xxxxxxxxxxxxxxxxxxxxxx'; // Ganti dengan api key anda
$pin = '1234'; // Ganti dengan pin anda
$action = 'layanan';

// Data yang akan dikirim sebagai payload
$postdata = [
    'api_key' => $api_key,
    'pin' => $pin,
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
    echo "SID: " . $json_result['data']['sid'] . "<br>";
    echo "Kategori: " . $json_result['data']['kategori'] . "<br>";
    echo "Layanan: " . $json_result['data']['layanan'] . "<br>";
    echo "Min: " . $json_result['data']['min'] . "<br>";
    echo "Max: " . $json_result['data']['max'] . "<br>";
    echo "Harga: " . $json_result['data']['harga'] . "<br>";
    echo "Catatan: " . $json_result['data']['catatan'] . "<br>";
} else {
    echo "Pengambilan layanan gagal. Pesan: " . $json_result['data']['pesan'];
}

?>
