<?php
// Konfigurasi API Terminate Akun
$api_url = 'https://api.nf22.my.id/subscribe/server';

// Data yang akan dikirim ke API untuk terminate
$post_data = [
    'api_key' => 'xxxxxxxxxxxxxxxxxxxxx',      // Ganti dengan API Key Anda
    'secret_key' => 'xxxxxxxxxxxxxxxxxxxxx',  // Ganti dengan Secret Key Anda
    'action' => 'terminate',
    'server' => 'aiohost.server.id', // Domain server Anda
    'userwhm' => 'root', // User WHM server Anda
    'passwhm' => 'xxxxxxxx', // Password WHM server Anda
    'username' => 'twentytwoid' // Ganti dengan username yang ingin diterminate
];

// Inisialisasi cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); // Nonaktifkan verifikasi SSL (untuk testing)

// Eksekusi request
$response = curl_exec($ch);

// Cek error
if (curl_errno($ch)) {
    echo 'Error cURL: ' . curl_error($ch);
} else {
    // Decode response JSON
    $result = json_decode($response, true);
    
    // Tampilkan hasil
    if ($result['status']) {
        echo "Terminate Akun Berhasil!\n";
        echo "Pesan: " . $result['data']['pesan'] . "\n";
    } else {
        echo "Terminate Akun Gagal!\n";
        echo "Pesan: " . $result['data']['pesan'] . "\n";
    }
}

// Tutup koneksi cURL
curl_close($ch);
?>