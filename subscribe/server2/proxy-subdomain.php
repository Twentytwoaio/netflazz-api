<?php
// URL API Anda
$api_url = 'https://api.nf22.my.id/subscribe/server2';

// Data yang akan dikirimkan via POST
$post_data = [
    'api_key' => 'xxxxxxxxxxxxxxxxxxxxx',      // Ganti dengan API Key Anda
    'secret_key' => 'xxxxxxxxxxxxxxxxxxxxx',  // Ganti dengan Secret Key Anda
    'action' => 'atur_proxy', // Action Jangan Diubah
    'token' => 'xxxxxxxx', // Ganti dengan Token CloudFlare Anda
    'zoneid' => 'xxxxxxxx', // Ganti dengan Zone ID CloudFlare Anda
    'record_id' => 'xxxxxxxx', // Ganti dengan record id, didapat saat membuat subdomain
    'proxied' => 'true' // true untuk aktifkan proxy, false untuk nonaktifkan
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
    echo "Pengaturan proxy berhasil diupdate!\n";
    echo "Detail Subdomain:\n";
    echo "ID: " . $result['data']['id'] . "\n";
    echo "Name: " . $result['data']['name'] . "\n";
    echo "Type: " . $result['data']['type'] . "\n";
    echo "IP: " . $result['data']['content'] . "\n";
    echo "Status Proxy: " . ($result['data']['proxied'] ? 'AKTIF' : 'NONAKTIF') . "\n";
    echo "Terakhir Diubah: " . $result['data']['modified_on'] . "\n";
} else {
    echo "Gagal mengupdate pengaturan proxy!\n";
    echo "Error: " . ($result['data']['pesan'] ?? 'Unknown error') . "\n";
}
?>