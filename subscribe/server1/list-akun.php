<?php
// Konfigurasi API List User
$api_url = 'https://api.nf22.my.id/subscribe/server';

// Data yang akan dikirim ke API
$post_data = [
    'api_key' => 'xxxxxxxxxxxxxxxxxxxxx',      // Ganti dengan API Key Anda
    'secret_key' => 'xxxxxxxxxxxxxxxxxxxxx',  // Ganti dengan Secret Key Anda
    'action' => 'list_user',
    'server' => 'aiohost.server.id', // Domain server Anda
    'userwhm' => 'root', // User WHM server Anda
    'passwhm' => 'xxxxxxxx' // Password WHM server Anda
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
    echo "=== DAFTAR AKUN cPANEL ===\n";
    echo "Total Akun: " . $result['data']['total_users'] . "\n\n";
    
    echo "Detail Akun:\n";
    foreach ($result['data']['users'] as $user) {
        echo "Username: " . $user['user'] . "\n";
        echo "Domain: " . $user['domain'] . "\n";
        echo "Plan: " . $user['plan'] . "\n";
        echo "Status: " . ($user['suspend'] ? 'Suspended' : 'Active') . "\n";
        echo "Alasan Suspend: " . $user['suspendreason'] . "\n";
        echo "Pemilik: " . $user['owner'] . "\n";
        echo "------------------------\n";
    }
} else {
    echo "Gagal mengambil daftar akun!\n";
    echo "Pesan: " . $result['data']['pesan'] . "\n";
}
?>