<?php
// API endpoint dan parameter
$api_url = 'https://api.nf22.my.id/otp';
$api_key = 'xxxxxxxxxxxxxxxxxxxxx'; // Ganti dengan api key anda
$pin     = '1234';                  // Ganti dengan pin anda
$action  = 'reactivate';

// Order ID dari pesanan sebelumnya yang ingin direaktivasi
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

    echo "Order ID Baru: "      . $data['id']                  . "<br>";
    echo "Nomor: "              . $data['phone_number']         . "<br>";
    echo "Layanan: "            . $data['service']              . "<br>";
    echo "Negara: "             . $data['negara']               . "<br>";
    echo "Operator: "           . $data['operator']             . "<br>";
    echo "Harga: Rp "           . $data['harga']                . "<br>";
    echo "Waktu Mulai: "        . $data['activation_time']      . "<br>";
    echo "Waktu Berakhir: "     . $data['activation_end_time']  . "<br>";
} else {
    echo "Reaktivasi nomor gagal. Pesan: " . $json_result['data']['pesan'];
}
?>
