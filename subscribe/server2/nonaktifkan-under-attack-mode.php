<?php
// URL API Anda
$api_url = 'https://api.nf22.my.id/subscribe/server2';

// Data yang akan dikirimkan via POST
$post_data = [
    'api_key' => 'xxxxxxxxxxxxxxxxxxxxx',      // Ganti dengan API Key Anda
    'secret_key' => 'xxxxxxxxxxxxxxxxxxxxx',  // Ganti dengan Secret Key Anda
    'action' => 'under_attack_off', // Action Jangan Diubah
    'token' => 'xxxxxxxx', // Ganti dengan Token CloudFlare Anda
    'zoneid' => 'xxxxxxxx', // Ganti dengan Zone ID CloudFlare Anda
    'level' => 'medium', // (off, medium, high)
    'email' => 'example@gmail.com' // Ganti dengan Email CloudFlare Anda
];

// Eksekusi request
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

$response = curl_exec($ch);
curl_close($ch);

// Proses response ganda
$responses = explode('}{', $response);
if (count($responses) > 1) {
    $responses[0] .= '}';
    for ($i = 1; $i < count($responses); $i++) {
        $responses[$i] = '{' . $responses[$i];
    }
}

// Ambil response utama (yang pertama)
$main_response = json_decode($responses[0], true);

// Tampilkan hasil
if ($main_response && $main_response['status']) {
    $data = $main_response['data'];
    echo "Under Attack Mode berhasil dinonaktifkan!\n";
    echo "Pesan: " . $data['pesan'] . "\n";
    echo "Level: " . $data['level'] . "\n";
    echo "Detail:\n";
    echo "ID: " . $data['detail']['id'] . "\n";
    echo "Status: " . $data['detail']['value'] . "\n";
} else {
    echo "Gagal menonaktifkan Under Attack Mode!\n";
    echo "Error: " . ($main_response['data']['pesan'] ?? 'Unknown error');
}
?>