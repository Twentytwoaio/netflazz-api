<?php
// API endpoint dan parameter
$api_url = 'https://api.nf22.my.id/otp';
$api_key = 'xxxxxxxxxxxxxxxxxxxxx'; // Ganti dengan api key anda
$pin     = '1234';                  // Ganti dengan pin anda
$action  = 'getStatus';

// Order ID yang didapat dari getNumber
$id = '87525054'; // Ganti dengan Order ID anda

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

    echo "Order ID: "   . $data['id']        . "<br>";
    echo "Layanan: "    . $data['layanan']    . "<br>";
    echo "Harga: Rp "   . $data['harga']      . "<br>";
    echo "Negara: "     . $data['negara']     . "<br>";
    echo "Kode OTP: "   . $data['sms']        . "<br>";
    echo "Status: "     . $data['status']     . "<br>";
    echo "Tgl Pesan: "  . $data['tgl_pesan']  . "<br>";
} else {
    echo "Cek status pesanan gagal. Pesan: " . $json_result['data']['pesan'];
}
?>
