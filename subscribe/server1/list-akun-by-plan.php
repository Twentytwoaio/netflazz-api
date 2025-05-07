<?php
// Konfigurasi API List Plan
$api_url = 'https://api.nf22.my.id/subscribe/server';

// Data yang akan dikirim ke API
$post_data = [
    'api_key' => 'xxxxxxxxxxxxxxxxxxxxx',      // Ganti dengan API Key Anda
    'secret_key' => 'xxxxxxxxxxxxxxxxxxxxx',  // Ganti dengan Secret Key Anda
    'action' => 'list_plan',
    'server' => 'aiohost.server.id', // Domain server Anda
    'userwhm' => 'root', // User WHM server Anda
    'passwhm' => 'xxxxxxxx', // Password WHM server Anda
    'plan' => 'cpanel_mini' // Ganti dengan package yang ingin ditampilkan
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
    echo "=== DAFTAR AKUN BERDASARKAN PLAN ===\n";
    echo "Plan: " . $result['data']['plan'] . "\n";
    echo "Total Akun: " . $result['data']['total_accounts'] . "\n\n";
    
    echo "Detail Akun:\n";
    foreach ($result['data']['accounts'] as $account) {
        echo "Username: " . $account['user'] . "\n";
        echo "Domain: " . $account['domain'] . "\n";
        echo "Plan: " . $account['plan'] . "\n";
        echo "Pemilik: " . $account['owner'] . "\n";
        echo "Status: " . $account['suspendstatus'] . "\n";
        echo "------------------------\n";
    }
} else {
    echo "Gagal mengambil daftar akun!\n";
    echo "Pesan: " . $result['data']['pesan'] . "\n";
}
?>