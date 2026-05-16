<?php
// API endpoint dan parameter
$api_url = 'https://api.nf22.my.id/otp';
$api_key = 'xxxxxxxxxxxxxxxxxxxxx'; // Ganti dengan api key anda
$pin     = '1234';                  // Ganti dengan pin anda
$action  = 'getPrices';

// (Opsional) Filter berdasarkan kode layanan dan/atau ID negara
$service = 'go'; // Contoh: go = Google. Hapus baris ini jika tidak ingin filter
$country = '6';  // Contoh: 6 = Indonesia. Hapus baris ini jika tidak ingin filter

// Data yang akan dikirim sebagai payload
$postdata = [
    'api_key' => $api_key,
    'pin'     => $pin,
    'action'  => $action,
    'service' => $service, // Hapus baris ini jika tidak ingin filter layanan
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
    $prices = $json_result['data'];

    foreach ($prices as $country_id => $services) {
        echo "Country ID: " . $country_id . "<br>";
        echo "Flag: " . $services['imgNegara'] . "<br>";

        foreach ($services as $svc_code => $detail) {
            if ($svc_code === 'imgNegara') continue;

            echo "&nbsp;&nbsp;Service: "   . $svc_code           . "<br>";
            echo "&nbsp;&nbsp;Harga: Rp "  . $detail['harga']    . "<br>";
            echo "&nbsp;&nbsp;Stok: "      . $detail['stok']     . "<br>";
            echo "&nbsp;&nbsp;Stok Fisik: ". $detail['stokFisik']. "<br>";
            echo "&nbsp;&nbsp;Img: "       . $detail['imgService']. "<br><br>";
        }
        echo "<hr>";
    }
} else {
    echo "Pengambilan harga gagal. Pesan: " . $json_result['data']['pesan'];
}
?>
