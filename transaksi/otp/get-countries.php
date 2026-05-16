<?php
// API endpoint dan parameter
$api_url = 'https://api.nf22.my.id/otp';
$api_key = 'xxxxxxxxxxxxxxxxxxxxx'; // Ganti dengan api key anda
$pin     = '1234';                  // Ganti dengan pin anda
$action  = 'getCountries';

// Data yang akan dikirim sebagai payload
$postdata = [
    'api_key' => $api_key,
    'pin'     => $pin,
    'action'  => $action,
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
    $negara_list = $json_result['data'];

    foreach ($negara_list as $negara) {
        echo "ID: "      . $negara['id']      . "<br>";
        echo "Negara: "  . $negara['negara']  . "<br>";
        echo "Visible: " . $negara['visible'] . "<br>";
        echo "Retry: "   . $negara['retry']   . "<br>";
        echo "Img: "     . $negara['img']     . "<br><br>";
    }
} else {
    echo "Pengambilan data negara gagal. Pesan: " . $json_result['data']['pesan'];
}
?>
