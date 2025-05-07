<?php
// Konfigurasi API Terminate By Plan
$api_url = 'https://api.nf22.my.id/subscribe/server';

// Data yang akan dikirim ke API
$post_data = [
    'api_key' => 'xxxxxxxxxxxxxxxxxxxxx',      // Ganti dengan API Key Anda
    'secret_key' => 'xxxxxxxxxxxxxxxxxxxxx',  // Ganti dengan Secret Key Anda
    'action' => 'terminate_plan',
    'server' => 'aiohost.server.id', // Ganti dengan domain server Anda
    'userwhm' => 'root', // Ganti dengan user server Anda
    'passwhm' => 'xxxxxxxx', // Ganti dengan password server Anda
    'plan' => 'cpanel_mini' // Ganti dengan package yang ingin di-terminate
];

// Inisialisasi cURL
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
    echo 'Error cURL: ' . curl_error($ch);
} else {
    // Decode response JSON
    $result = json_decode($response, true);
    
    // Tampilkan hasil
    if ($result['status']) {
        echo "Terminate By Plan Berhasil!\n";
        echo "Pesan: " . $result['data']['pesan'] . "\n";
        echo "Target Plan: " . $result['data']['target_plan'] . "\n";
        echo "Total Akun: " . $result['data']['total_accounts'] . "\n";
        echo "Berhasil: " . $result['data']['success_count'] . "\n";
        echo "Gagal: " . $result['data']['failed_count'] . "\n\n";
        
        echo "Akun yang di-Terminate:\n";
        foreach ($result['data']['terminated'] as $account) {
            echo "- " . $account['username'] . " (" . $account['domain'] . "): " . $account['message'] . "\n";
        }
        
        if (!empty($result['data']['failed'])) {
            echo "\nAkun yang Gagal di-Terminate:\n";
            foreach ($result['data']['failed'] as $failed) {
                echo "- " . $failed['username'] . ": " . $failed['message'] . "\n";
            }
        }
    } else {
        echo "Terminate By Plan Gagal!\n";
        echo "Pesan: " . $result['data']['pesan'] . "\n";
    }
}

// Tutup koneksi cURL
curl_close($ch);
?>