<?php

// API endpoint dan parameter
$api_url = 'https://api.nf22.my.id/merchant';
$api_key = 'xxxxxxxxxxxxxxxxxxxxx'; // Ganti dengan api key anda
$kode_merchant = 'MNxxxxx'; //Ganti dengan kode merchant anda
$action = 'deposit';

// Data yang akan dikirim sebagai payload
$postdata = [
    'api_key' => $api_key,
    'kode_merchant' => $kode_merchant,
    'action' => $action,
    'member' => 'username', // Username pelanggan atau member anda
    'nomor' => '0888xxxxxx', // Nomor pelanggan atau member anda
    'email' => 'sample@gmail.com', // Email pelanggan atau member anda
    'pembayaran' => '85', // ID pembayaran, misal BCA Virtual Account
    'jumlah' => '10000', // Jumlah deposit
    'return_url' => 'https://example.com', // Url invoice anda untuk melakukan tombol kembali pada invoice merchant
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

// Tampilkan hasil jika status sukses
if ($json_result['status'] == true) {
    // Ambil data dari response
    $data = $json_result['data'];
    
    // Tampilkan semua nilai
    echo "Kode Deposit: " . $data['kode_deposit'] . "<br>";
    echo "Merchant: " . $data['merchant'] . "<br>";
    echo "Username: " . $data['username'] . "<br>";
    echo "Tipe: " . $data['tipe'] . "<br>";
    echo "Provider: " . $data['provider'] . "<br>";
    echo "Payment: " . $data['payment'] . "<br>";
    echo "Nomor Pengirim: " . $data['nomor_pengirim'] . "<br>";
    echo "Tujuan: " . $data['tujuan'] . "<br>";
    echo "Fee: " . $data['fee'] . "<br>";
    echo "Jumlah Transfer: " . $data['jumlah_transfer'] . "<br>";
    echo "Saldo Diterima: " . $data['get_saldo'] . "<br>";
    echo "Status: " . $data['status'] . "<br>";
    echo "Tanggal: " . $data['date'] . "<br>";
    echo "Waktu: " . $data['time'] . "<br>";
    echo "Link Checkout: <a href='" . $data['checkout'] . "' target='_blank'>" . $data['checkout'] . "</a><br>";
    echo "Masa Berlaku (Unix Timestamp): " . $data['exp'] . "<br>";

    // Buka tab baru dengan link checkout menggunakan JavaScript
    echo "<script>window.open('" . $data['checkout'] . "', '_blank');</script>";
    
} else {
    // Jika gagal
    echo "Gagal melakukan deposit. Pesan: " . $json_result['data']['pesan'];
}

?>
