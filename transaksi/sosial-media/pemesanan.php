<?php

// API endpoint dan parameter (gunakan salah satu URL SOSMED sesuai kebutuhan)
$api_url = 'https://api.nf22.my.id/sosmed'; // Sosial media 1
$api_url = 'https://api.nf22.my.id/sosmed2'; // Sosial media 2
$api_url = 'https://api.nf22.my.id/sosmed3'; // Sosial media 3
$api_key = 'xxxxxxxxxxxxxxxxxxxxxx'; // Ganti dengan api key anda
$pin = '1234'; // Ganti dengan pin anda
$action = 'pemesanan';
$layanan_id = '123'; // Ganti dengan Service ID yang sesuai
$target = 'https://example.com'; // Ganti dengan link atau target sosial media
$jumlah = 100; // Ganti dengan jumlah pemesanan yang diinginkan

// Data yang akan dikirim sebagai payload
$postdata = [
    'api_key' => $api_key,
    'pin' => $pin,
    'action' => $action,
    'layanan_id' => $layanan_id,
    'target' => $target,
    'jumlah' => $jumlah,
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
    echo "Pemesanan berhasil. ID Pesanan: " . $json_result['data']['id'] . "<br>";
    echo "Start Count: " . $json_result['data']['start_count'];
} else {
    echo "Pemesanan gagal. Pesan: " . $json_result['data']['pesan'];
}

?>
