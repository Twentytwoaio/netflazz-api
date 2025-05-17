<?php
// API Endpoint
$url = "https://api.nf22.my.id/subscribe/mutasi-ewallet";

// Data untuk request otp
$data = [
    "api_key" => "xxxxxxxxxxxxxxxxxxxxx",      // Ganti dengan API Key Anda
    "secret_key" => "xxxxxxxxxxxxxxxxxxxxx",  // Ganti dengan Secret Key Anda
    "action" => "dana_send_otp",            // Action Jangan Diubah
    "phoneNumber" => "08xxxxxxxxx",       // Ganti dengan nomor DANA Anda
    "pin" => "123456",                    // Ganti dengan pin DANA Anda
    "accountName" => "08xxxxxxxxx",    // Ganti dengan nama DANA Anda
    "verificationMethod" => "WhatsApp"   // Ganti "WhatsApp" atau "SMS"
];

// Inisialisasi cURL
$ch = curl_init($url);

// Set opsi cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/x-www-form-urlencoded'
]);

// Eksekusi request
$response = curl_exec($ch);

// Cek error
if(curl_errno($ch)){
    echo 'Error:' . curl_error($ch);
} else {
    // Tampilkan response dari API
    header('Content-Type: application/json');
    echo $response;
}

// Tutup cURL
curl_close($ch);
?>