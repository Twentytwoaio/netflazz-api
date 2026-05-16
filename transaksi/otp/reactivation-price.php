<?php
// API endpoint dan parameter
$api_url = 'https://api.nf22.my.id/otp';
$api_key = 'xxxxxxxxxxxxxxxxxxxxx'; // Ganti dengan api key anda
$pin     = '1234';                  // Ganti dengan pin anda
$action  = 'reactivationPrice';

// Order ID dari pesanan sebelumnya yang ingin dicek harga reaktivasinya
$id = '64265793'; // Ganti dengan Order ID anda

// Data yang akan dikirim sebagai payload
$postdata = [
    'api_key' => $api_key,
    'pin'     => $pin,
    'action'  => $action,
    'id'      => $id,
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
    $data = $json_result['data'];

    echo "Order ID: "   . $data['id']      . "<br>";
    echo "Layanan: "    . $data['layanan']  . "<br>";
    echo "Harga: Rp "   . $data['harga']   . "<br>";
    echo "Negara: "     . $data['negara']  . "<br>";
    echo "Nomor: "      . $data['nomor']   . "<br>";
} else {
    echo "Pengambilan harga reaktivasi gagal. Pesan: " . $json_result['data']['pesan'];
}
?>
