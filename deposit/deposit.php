<?php

// API endpoint dan parameter
$api_url = 'https://netflazz.com/api/deposit';
$api_key = 'CxiSNq6bzaxWCTF5l75Caxxxxxxx'; // Ganti dengan api key anda
$kode_merchant = 'PN12xxx'; //Ganti dengan kode merchant anda
$action = 'deposit';

// Data yang akan dikirim sebagai payload
$postdata = [
    'api_key' => $api_key,
    'kode_merchant' => $kode_merchant,
    'action' => $action,
    'member' => 'username_anda', // Username pelanggan atau member anda
    'nomor' => 'nomor_anda', // Nomor pelanggan atau member anda
    'email' => 'email_anda', // Email pelanggan atau member anda
    'jenis' => 'Saldo Digital', // Atau 'Saldo Sosmed'
    'pembayaran' => 'Service_OID_deposit',
    'jumlah' => 'jumlah_deposit',
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
    echo "Deposit berhasil. Kode Deposit: " . $json_result['data']['kode_deposit'];
    // Jika ingin menampilkan data lainnya, dapat ditambahkan sesuai kebutuhan
} else {
    echo "Gagal melakukan deposit. Pesan: " . $json_result['data']['pesan'];
}

?>
