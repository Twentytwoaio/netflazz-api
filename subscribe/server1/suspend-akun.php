<?php
// Konfigurasi API Suspend Account
$api_url = 'https://api.nf22.my.id/subscribe/server';

// Data yang akan dikirim ke API
$post_data = [
    'api_key' => 'xxxxxxxxxxxxxxxxxxxxx',      // Ganti dengan API Key Anda
    'secret_key' => 'xxxxxxxxxxxxxxxxxxxxx',  // Ganti dengan Secret Key Anda
    'action' => 'suspend',
    'server' => 'aiohost.server.id', // Domain server Anda
    'userwhm' => 'root', // User WHM server Anda
    'passwhm' => 'xxxxxxxx', // Password WHM server Anda
    'username' => 'twentytwoid' // Ganti dengan username yang ingin disuspend
];

// Inisialisasi cURL dengan verifikasi SSL aktif
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); 
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);

// Eksekusi request
$response = curl_exec($ch);

// Cek error
if (curl_errno($ch)) {
    die('Error cURL: ' . curl_error($ch));
}

// Tutup koneksi cURL
curl_close($ch);

// Decode response JSON
$result = json_decode($response, true);

// Tampilkan hasil
if ($result['status']) {
    echo "Suspend akun berhasil!\n";
    echo "Pesan: " . $result['pesan'] . "\n";
} else {
    echo "Gagal melakukan suspend akun!\n";
    echo "Pesan: " . ($result['data']['pesan'] ?? 'Unknown error') . "\n";
}
?>