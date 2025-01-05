<?php

// API endpoint dan parameter
$api_url = 'https://api.nf22.my.id/prabayar';
$api_key = 'xxxxxxxxxxxxxxxxxxxxx'; // Ganti dengan api key anda
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
    $layanan = $json_result['data'];
    
    foreach ($layanan as $service) {
        echo "SID: " . $service['sid'] . "<br>";
        echo "Operator: " . $service['operator'] . "<br>";
        echo "Layanan: " . $service['layanan'] . "<br>";
        echo "Harga: " . $service['harga'] . "<br>";
        echo "Status: " . $service['status'] . "<br>";
        echo "Keterangan: " . $service['catatan'] . "<br><br>";
    }
} else {
    echo "Pengambilan layanan gagal. Pesan: " . $json_result['data']['pesan'];
}

?>
