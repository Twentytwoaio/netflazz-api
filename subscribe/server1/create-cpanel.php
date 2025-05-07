<?php
// Konfigurasi API
$api_url = 'https://api.nf22.my.id/subscribe/server';

// Data yang akan dikirim ke API
$post_data = [
    'api_key' => 'xxxxxxxxxxxxxxxxxxxxx',      // Ganti dengan API Key Anda
    'secret_key' => 'xxxxxxxxxxxxxxxxxxxxx',  // Ganti dengan Secret Key Anda
    'action' => 'create',
    'server' => 'aiohost.server.id', // Ganti dengan domain server Anda
    'userwhm' => 'root', // Ganti dengan user server Anda
    'passwhm' => 'xxxxxxxx', // Ganti dengan password server Anda
    'domain' => 'netflazz.com', // Ganti dengan domain yang ingin digunakan
    'package' => 'cpanel_mini', // Ganti dengan package yang ingin digunakan
    'username' => 'twentytwoid' // Ganti dengan username yang ingin digunakan
];

// Inisialisasi cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); // Nonaktifkan verifikasi SSL (untuk testing saja)

// Eksekusi request
$response = curl_exec($ch);

// Cek error
if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
} else {
    // Decode response JSON
    $result = json_decode($response, true);
    
    // Tampilkan hasil
    if ($result['status']) {
        echo "Pemesanan Berhasil!\n";
        echo "Domain: " . $result['data']['domain'] . "\n";
        echo "Username: " . $result['data']['user'] . "\n";
        echo "Password: " . $result['data']['pass'] . "\n";
        echo "Package: " . $result['data']['package'] . "\n";
        echo "IP: " . $result['data']['ip'] . "\n";
        echo "NS1: " . $result['data']['ns1'] . "\n";
        echo "NS2: " . $result['data']['ns2'] . "\n";
        echo "NS3: " . $result['data']['ns3'] . "\n";
        echo "NS4: " . $result['data']['ns4'] . "\n";
    } else {
        echo "Pemesanan Gagal!\n";
        echo "Pesan: " . $result['data']['pesan'] . "\n";
    }
}

// Tutup koneksi cURL
curl_close($ch);
?>