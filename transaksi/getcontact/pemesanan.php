<?php

// API endpoint dan parameter
$api_url = 'https://api.nf22.my.id/getcontact';
$api_key = 'xxxxxxxxxxxxxxxxxxxxx'; // Ganti dengan api key anda
$pin = '1234'; // Ganti dengan pin anda
$action = 'pemesanan';
$nomor = '08123456789'; // Ganti dengan nomor HP yang ingin dicek

// Data yang akan dikirim sebagai payload
$postdata = [
    'api_key' => $api_key,
    'pin' => $pin,
    'action' => $action,
    'nomor' => $nomor,
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
    echo "Order ID: " . $json_result['data']['id'] . "<br>";
    echo "Nomor: " . $json_result['data']['target'] . "<br>";
    echo "Nama Terdaftar: " . $json_result['data']['nama'] . "<br>";
    echo "Operator: " . $json_result['data']['operator'] . "<br>";
    echo "Foto Profil: " . $json_result['data']['profil'] . "<br>";
    echo "Spam: " . $json_result['data']['spam'] . "<br>";
    echo "Mencurigakan: " . $json_result['data']['mencurigakan'] . "<br>";
    echo "Total Tag: " . $json_result['data']['total_tag'] . "<br>";
    echo "Harga: Rp " . number_format($json_result['data']['harga'], 0, ',', '.') . "<br>";
    echo "Daftar Tag: " . implode(', ', $json_result['data']['tags']) . "<br>";
} else {
    echo "Pengecekan gagal. Pesan: " . $json_result['data']['pesan'];
}

?>
