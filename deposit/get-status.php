<?php

// API endpoint dan parameter
$api_url = 'https://netflazz.com/api/deposit';
$api_key = 'CxiSNq6bzaxWCTF5l75Caxxxxxxx'; // Ganti dengan api key anda
$kode_merchant = 'PN12xxx'; //Ganti dengan kode merchant anda
$action = 'status';
$kode_deposit = 'T1153911027866KST22'; // Gantilah dengan kode deposit yang ingin dicek

// Data yang akan dikirim sebagai payload
$postdata = [
    'api_key' => $api_key,
    'kode_merchant' => $kode_merchant,
    'action' => $action,
    'kode_deposit' => $kode_deposit,
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
    echo "Status deposit berhasil dicek.<br>";
    echo "Kode Deposit: " . $json_result['data']['kode_deposit'] . "<br>";
    echo "Status: " . $json_result['data']['status'] . "<br>";
    echo "Dibayar pada: " . date('Y-m-d H:i:s', $json_result['data']['dibayar']) . "<br>";
} else {
    echo "Gagal melakukan cek status deposit. Pesan: " . $json_result['data']['pesan'];
}

?>
