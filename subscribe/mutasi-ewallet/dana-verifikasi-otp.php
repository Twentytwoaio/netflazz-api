<?php
// API Endpoint
$url = "https://api.nf22.my.id/subscribe/mutasi-ewallet";

// Data untuk request verifikasi OTP
$data = [
    "api_key" => "xxxxxxxxxxxxxxxxxxxxx",      // Ganti dengan API Key Anda
    "secret_key" => "xxxxxxxxxxxxxxxxxxxxx",  // Ganti dengan Secret Key Anda
    "action" => "dana_verify_otp", // Action Jangan Diubah
    "otp" => "xxxx" // Ganti dengan OTP DANA yang kamu terima
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

// Cek error cURL
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
} else {
    // Tampilkan response API
    header('Content-Type: application/json');
    echo $response;
}

// Tutup cURL
curl_close($ch);
?>