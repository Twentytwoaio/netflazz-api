<?php
// URL API Anda
$api_url = 'https://api.nf22.my.id/subscribe/server2';

// Data yang akan dikirimkan via POST
$post_data = [
    'api_key' => 'xxxxxxxxxxxxxxxxxxxxx',      // Ganti dengan API Key Anda
    'secret_key' => 'xxxxxxxxxxxxxxxxxxxxx',  // Ganti dengan Secret Key Anda
    'action' => 'tambah_subdomain', // Action Jangan Diubah
    'token' => 'xxxxxxxx', // Ganti dengan Token CloudFlare Anda
    'zoneid' => 'xxxxxxxx', // Ganti dengan Zone ID CloudFlare Anda
    'subdomain' => 'subdo', // Ganti dengan subdomain yang ingin dibuat
    'ip' => 'xxx.xxx.xxx.xxx', // Ganti dengan IP Server Anda
    'type' => 'A', // Jenis record (A, AAAA, CNAME, MX, TXT)
    'proxied' => 'true' // CloudFlare proxy (true/false)
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
    echo "Subdomain berhasil dibuat!\n";
    echo "Detail:\n";
    echo "ID: " . $result['data']['id'] . "\n";
    echo "Name: " . $result['data']['name'] . "\n";
    echo "Type: " . $result['data']['type'] . "\n";
    echo "IP: " . $result['data']['content'] . "\n";
    echo "Proxied: " . ($result['data']['proxied'] ? 'Yes' : 'No') . "\n";
    echo "Created: " . $result['data']['created_on'] . "\n";
} else {
    echo "Gagal membuat subdomain!\n";
    echo "Error: " . ($result['data']['pesan'] ?? 'Unknown error') . "\n";
}
?>