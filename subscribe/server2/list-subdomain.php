<?php
// URL API Anda
$api_url = 'https://api.nf22.my.id/subscribe/server2';

// Data yang akan dikirimkan via POST
$post_data = [
    'api_key' => 'xxxxxxxxxxxxxxxxxxxxx',      // Ganti dengan API Key Anda
    'secret_key' => 'xxxxxxxxxxxxxxxxxxxxx',  // Ganti dengan Secret Key Anda
    'action' => 'lihat_subdomain', // Action Jangan Diubah
    'token' => 'xxxxxxxx', // Ganti dengan Token CloudFlare Anda
    'zoneid' => 'xxxxxxxx' // Ganti dengan Zone ID CloudFlare Anda
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
    echo "=== DAFTAR SUBDOMAIN ===\n";
    echo "Total: " . count($result['data']) . " subdomain\n\n";
    
    foreach ($result['data'] as $index => $subdomain) {
        echo "Subdomain #" . ($index + 1) . "\n";
        echo "ID: " . $subdomain['id'] . "\n";
        echo "Name: " . $subdomain['name'] . "\n";
        echo "Type: " . $subdomain['type'] . "\n";
        echo "IP: " . $subdomain['content'] . "\n";
        echo "Proxied: " . ($subdomain['proxied'] ? 'Yes' : 'No') . "\n";
        echo "Created: " . $subdomain['created_on'] . "\n";
        echo "Modified: " . $subdomain['modified_on'] . "\n";
        echo "------------------------\n";
    }
} else {
    echo "Gagal mengambil daftar subdomain!\n";
    echo "Error: " . ($result['data']['pesan'] ?? 'Unknown error') . "\n";
}
?>