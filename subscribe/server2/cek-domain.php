<?php
// URL API Anda
$api_url = 'https://api.nf22.my.id/subscribe/server2';

// Data yang akan dikirimkan via POST
$post_data = [
    'api_key' => 'xxxxxxxxxxxxxxxxxxxxx',      // Ganti dengan API Key Anda
    'secret_key' => 'xxxxxxxxxxxxxxxxxxxxx',  // Ganti dengan Secret Key Anda
    'action' => 'check_domain', // Action Jangan Diubah
    'domain' => 'netflazz.com' // Ganti dengan domain yang ingin dicek
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
    echo "Domain: " . $result['data']['domain'] . "\n";
    echo "Status: " . $result['data']['status'] . "\n";
} else {
    echo "Error: " . ($result['data']['pesan'] ?? 'Unknown error') . "\n";
}
?>