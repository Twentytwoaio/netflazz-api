<?php

// URL API Anda
$url = 'https://api.nf22.my.id/subscribe/pln.php';

// Data yang akan dikirim sebagai payload
$postdata = [
    'api_key' => 'xxxxxxxxxxxxxxxxxxxxx',
    'secret_key' => 'xxxxxxxxxxxxxxxxxxxxx',
    'action' => 'pascabayar',
    'target' => '5467xxxxxx', // Gantilah dengan nomor Meter/ID Meteran yang ingin dicek
];

// Inisialisasi cURL
$ch = curl_init();

// Setel opsi cURL
curl_setopt($ch, CURLOPT_URL, $url);
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
    echo "Target: " . $json_result['data']['target'] . "<br>";
    echo "Nama Pelanggan: " . $json_result['data']['nama_pelanggan'] . "<br>";
    
} else {
    echo "Cek tagihan gagal. Pesan: " . $json_result['data']['pesan'];
}

?>
