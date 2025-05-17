<?php
// API Endpoint
$url = "https://api.nf22.my.id/subscribe/mutasi-ewallet";

// Data request menampilkan mutasi
$data = [
    "api_key" => "xxxxxxxxxxxxxxxxxxxxx",      // Ganti dengan API Key Anda
    "secret_key" => "xxxxxxxxxxxxxxxxxxxxx",  // Ganti dengan Secret Key Anda
    "action" => "mutasi",       // Action Jangan Diubah
    "page" => 1,                 // Optional, default 1
    "limit" => 10,               // Optional, default 10, max 100
    "jenis_mutasi" => "",        // Optional: "CREDIT" atau "DEBIT" atau kosong
    "pencarian" => "",           // Optional: kata kunci pencarian
    "tanggal_awal" => "",        // Optional: format YYYY-MM-DD
    "tanggal_akhir" => "",       // Optional: format YYYY-MM-DD
    "minimal_jumlah" => "",      // Optional: angka minimal jumlah transaksi
    "maksimal_jumlah" => ""      // Optional: angka maksimal jumlah transaksi
];

// Hapus parameter kosong kalau ada
foreach ($data as $key => $value) {
    if ($value === "") {
        unset($data[$key]);
    }
}

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/x-www-form-urlencoded'
]);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
} else {
    // Tampilkan response mentah dari API langsung
    echo $response;
}

curl_close($ch);
?>