<?php

// API endpoint dan parameter (gunakan salah satu URL SOSMED sesuai kebutuhan)
$api_url = 'https://api.nf22.my.id/sosmed'; // Sosial media 1
$api_url = 'https://api.nf22.my.id/sosmed2'; // Sosial media 2
$api_url = 'https://api.nf22.my.id/sosmed3'; // Sosial media 3
$api_key = 'xxxxxxxxxxxxxxxxxxxxxx'; // Ganti dengan api key anda
$pin = '1234'; // Ganti dengan pin anda
$action = 'layanan';

// Prepare request data
$postdata = [
    'api_key' => $api_key,
    'pin' => $pin,
    'action' => $action
];

// Initialize cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postdata));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Execute request
$response = curl_exec($ch);
curl_close($ch);

// Process response
$result = json_decode($response, true);

if ($result['status']) {
    // Check if data is multiple services
    if (isset($result['data'][0])) { // Multiple services
        foreach ($result['data'] as $service) {
            echo "SID: " . $service['sid'] . "<br>";
            echo "Kategori: " . $service['kategori'] . "<br>";
            echo "Layanan: " . $service['layanan'] . "<br>";
            echo "Min: " . $service['min'] . "<br>";
            echo "Max: " . $service['max'] . "<br>";
            echo "Harga: " . $service['harga'] . "<br>";
            echo "Catatan: " . $service['catatan'] . "<br>";
            echo "Average Time: " . $service['average_time'] . "<br>";
            echo "Refill: " . $service['refill'] . "<br>";
            echo "Cancel: " . $service['cancel'] . "<br>";
        }
    }
} else {
    // Display error message
    echo "Error: ".($result['data']['pesan'] ?? 'Unknown error')."<br>";
}
?>
