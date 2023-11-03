<?php

// API endpoint dan parameter
$api_url = 'https://netflazz.com/api/deposit';
$api_key = 'CxiSNq6bzaxWCTF5l75Caxxxxxxx'; // Ganti dengan api key anda
$kode_merchant = 'PN12xxx'; //Ganti dengan kode merchant anda
$action = 'metode';

// Data yang akan dikirim sebagai payload
$postdata = [
    'api_key' => $api_key,
    'kode_merchant' => $kode_merchant,
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
    echo "Metode Deposit berhasil didapatkan.<br>";
    echo "OID: " . $json_result['data']['oid'] . "<br>";
    echo "Jenis Saldo: " . $json_result['data']['jenis_saldo'] . "<br>";
    echo "Min Deposit: " . $json_result['data']['mindepo'] . "<br>";
    echo "Tipe: " . $json_result['data']['tipe'] . "<br>";
    echo "Provider: " . $json_result['data']['provider'] . "<br>";
    echo "Jalur: " . $json_result['data']['jalur'] . "<br>";
    echo "Nama: " . $json_result['data']['nama'] . "<br>";
    echo "Rate: " . $json_result['data']['rate'] . "<br>";
    echo "Keterangan: " . $json_result['data']['keterangan'] . "<br>";
} else {
    echo "Gagal mendapatkan metode deposit. Pesan: " . $json_result['data']['pesan'];
}

?>
