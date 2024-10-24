<?php

// API endpoint dan parameter
$api_url = 'https://api.nf22.my.id/merchant';
$api_key = 'xxxxxxxxxxxxxxxxxxxxx'; // Ganti dengan api key anda
$kode_merchant = 'MNxxxxx'; //Ganti dengan kode merchant anda
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

// Tampilkan respon mentah untuk debugging
// if ($response === false) {
//     echo "Error: " . curl_error($ch);
//     exit;
// } else {
//     echo "Response dari API: " . $response . "<br><br>";
// }

// Tutup koneksi cURL
curl_close($ch);

// Dekode respon JSON
$json_result = json_decode($response, true);

// Cek error dalam JSON decoding
if (json_last_error() !== JSON_ERROR_NONE) {
    echo "Error dalam mendekode JSON: " . json_last_error_msg();
    exit;
}

// Tampilkan seluruh hasil respon JSON untuk debugging
// echo "<pre>";
// print_r($json_result);
// echo "</pre>";

// Tampilkan hasil
if ($json_result['status'] == true) {
    echo "Metode Deposit berhasil didapatkan.<br>";
    
    // Iterasi melalui setiap metode deposit
    foreach ($json_result['data'] as $metode) {
        echo "OID: " . $metode['oid'] . "<br>";
        echo "Min Deposit: " . $metode['mindepo'] . "<br>";
        echo "Tipe: " . $metode['tipe'] . "<br>";
        echo "Provider: " . $metode['provider'] . "<br>";
        echo "Jalur: " . $metode['jalur'] . "<br>";
        echo "Nama: " . $metode['nama'] . "<br>";
        echo "Rate: " . $metode['rate'] . "<br>";
        echo "Keterangan: " . $metode['keterangan'] . "<br><br>";
    }
} else {
    echo "Gagal mendapatkan metode deposit. Pesan: " . $json_result['data']['pesan'];
}


?>
