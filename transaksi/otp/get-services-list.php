<?php
// API endpoint dan parameter
$api_url = 'https://api.nf22.my.id/otp';
$api_key = 'xxxxxxxxxxxxxxxxxxxxx'; // Ganti dengan api key anda
$pin     = '1234';                  // Ganti dengan pin anda
$action  = 'getServicesList';

// (Opsional) Filter berdasarkan ID negara, kosongkan jika ingin semua
$country = '6'; // Contoh: 6 = Indonesia. Hapus baris ini jika tidak ingin filter

// Data yang akan dikirim sebagai payload
$postdata = [
    'api_key' => $api_key,
    'pin'     => $pin,
    'action'  => $action,
    'country' => $country, // Hapus baris ini jika tidak ingin filter negara
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
    $services = $json_result['data'];

    foreach ($services as $service) {
        echo "Code: " . $service['code'] . "<br>";
        echo "Name: " . $service['name'] . "<br>";
        echo "Img: "  . $service['img']  . "<br><br>";
    }
} else {
    echo "Pengambilan daftar layanan gagal. Pesan: " . $json_result['data']['pesan'];
}
?>
