<?php
// Konfigurasi API List Suspended Accounts
$api_url = 'https://api.nf22.my.id/subscribe/server';

// Data yang akan dikirim ke API
$post_data = [
    'api_key' => 'xxxxxxxxxxxxxxxxxxxxx',      // Ganti dengan API Key Anda
    'secret_key' => 'xxxxxxxxxxxxxxxxxxxxx',  // Ganti dengan Secret Key Anda
    'action' => 'list_suspended',
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
    echo "=== DAFTAR AKUN SUSPEND ===\n";
    echo "Total Akun Suspend: " . $result['data']['total_suspended'] . "\n\n";
    
    echo "Detail Akun Suspend:\n";
    foreach ($result['data']['accounts'] as $account) {
        echo "Username: " . $account['user'] . "\n";
        echo "Domain: " . $account['domain'] . "\n";
        echo "Pemilik: " . $account['owner'] . "\n";
        echo "Alasan Suspend: " . $account['reason'] . "\n";
        echo "Waktu Suspend: " . $account['time'] . "\n";
        echo "Status Lock: " . ($account['is_locked'] ? 'Locked' : 'Unlocked') . "\n";
        echo "------------------------\n";
    }
} else {
    echo "Gagal mengambil daftar akun suspend!\n";
    echo "Pesan: " . $result['data']['pesan'] . "\n";
}
?>