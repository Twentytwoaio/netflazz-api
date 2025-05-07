<?php
// URL API Anda
$api_url = 'https://api.nf22.my.id/subscribe/server2';

// Data yang akan dikirimkan via POST
$post_data = [
    'api_key' => 'xxxxxxxxxxxxxxxxxxxxx',      // Ganti dengan API Key Anda
    'secret_key' => 'xxxxxxxxxxxxxxxxxxxxx',  // Ganti dengan Secret Key Anda
    'action' => 'hapus_subdomain', // Action Jangan Diubah
    'token' => 'xxxxxxxx', // Ganti dengan Token CloudFlare Anda
    'zoneid' => 'xxxxxxxx', // Ganti dengan Zone ID CloudFlare Anda
    'record_id' => 'xxxxxxxx' // Ganti dengan record ID
];

// Eksekusi request
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    die('Error: ' . curl_error($ch));
}

curl_close($ch);

// Proses response
$result = json_decode($response, true);

if ($result['status']) {
    echo "Subdomain berhasil dihapus!\n";
    echo "Detail:\n";
    echo "ID: " . $result['data']['id'] . "\n";
} else {
    echo "Gagal mengupdate subdomain!\n";
    echo "Error: " . ($result['data']['pesan'] ?? 'Unknown error') . "\n";
}
?>