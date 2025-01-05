<?php

// API endpoint dan parameter
$api_url = 'https://api.nf22.my.id/pascabayar';
$api_key = 'xxxxxxxxxxxxxxxxxxxxx'; // Ganti dengan api key anda
$pin = '1234'; // Ganti dengan pin anda
$action = 'cek-tagihan';

// Data yang akan dikirim sebagai payload
$postdata = [
    'api_key' => $api_key,
    'pin' => $pin,
    'action' => $action,
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
    echo "Nama Pelanggan: " . $json_result['data']['nama_pelanggan'] . "<br>";
    echo "Tagihan: " . $json_result['data']['tagihan'] . "<br>";
    echo "Total Tagihan: " . $json_result['data']['total_tagihan'] . "<br>";
    echo "Denda: " . $json_result['data']['denda'] . "<br>";
} else {
    echo "Cek tagihan gagal. Pesan: " . $json_result['data']['pesan'];
}

?>
