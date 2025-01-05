<?php
 
// API endpoint dan parameter
$api_url = 'https://api.nf22.my.id/merchant';
$api_key = 'xxxxxxxxxxxxxxxxxxxxx'; // Ganti dengan api key anda
$kode_merchant = 'MNxxxxx'; //Ganti dengan kode merchant anda
$action = 'batal';
$kode_deposit = 'T115xxxxxxxx'; // Gantilah dengan kode deposit yang ingin dibatalkan

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
    echo "Deposit berhasil dibatalkan. Pesan: " . $json_result['data']['pesan'];
} else {
    echo "Gagal melakukan pembatalan deposit. Pesan: " . $json_result['data']['pesan'];
}

?>
