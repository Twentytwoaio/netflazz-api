<?php
// URL API Anda
$api_url = 'https://api.nf22.my.id/subscribe/server2';

// Data yang akan dikirimkan via POST
$post_data = [
    'api_key' => 'xxxxxxxxxxxxxxxxxxxxx',      // Ganti dengan API Key Anda
    'secret_key' => 'xxxxxxxxxxxxxxxxxxxxx',  // Ganti dengan Secret Key Anda
    'action' => 'purge_cache', // Action Jangan Diubah
    'token' => 'xxxxxxxx', // Ganti dengan Token CloudFlare Anda
    'zoneid' => 'xxxxxxxx' // Ganti dengan Zone ID CloudFlare Anda
];

// Eksekusi request
$ch = curl_init($api_url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

// Proses response
$result = json_decode($response, true);

if ($result && $result['status']) {
    echo "SUKSES! Cache berhasil di-purge\n";
    echo "Zone ID: " . $result['data']['id'] . "\n";
} else {
    echo "GAGAL! " . ($result['data']['pesan'] ?? 'Unknown error');
}
?>