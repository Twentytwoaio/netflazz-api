<?php
// Sample request for action: set-webhook-options

// URL API Subscribe WhatsApp NetFlazz
$url = "https://api.nf22.my.id/subscribe/whatsapp";

// Data yang akan dikirimkan via POST (x-www-form-urlencoded)
$data = [
    'api_key'    => 'xxxxxxxxxxxxxxxxxxxxx', // Ganti dengan API Key Anda
    'secret_key' => 'xxxxxxxxxxxxxxxxxxxxx', // Ganti dengan Secret Key Anda
    'action'     => 'set-webhook-options',
    'sender'             => '62888xxxxxxx',
    'webhook_full'       => 1,
    'webhook_read'       => 1,
    'webhook_reject_call'=> 0,
    'set_available'      => 1,
    'webhook_typing'     => 0,
    'delay'              => 3,
];

// Keterangan parameter tambahan:
// sender            : nomor device
webhook_full      : 0/1 – kirim full payload ke webhook
webhook_read      : 0/1 – kirim event read ke webhook
webhook_reject_call: 0/1 – kirim event reject call ke webhook
set_available     : 0/1 – tandai device sebagai available
webhook_typing    : 0/1 – kirim event typing ke webhook
delay             : integer (0–86400) delay kirim pesan

// Inisiasi cURL
$ch = curl_init($url);

// Set opsi cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

// Eksekusi cURL dan simpan respons
$response = curl_exec($ch);

// Cek apakah ada error saat mengambil data
if ($response === false) {
    echo 'Error: ' . curl_error($ch);
} else {
    // Menampilkan respons API
    header('Content-Type: application/json; charset=utf-8');
    echo $response;
}

// Tutup koneksi cURL
curl_close($ch);
?>
