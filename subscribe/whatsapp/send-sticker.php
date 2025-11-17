<?php
// Sample request for action: send-sticker

// URL API Subscribe WhatsApp NetFlazz
$url = "https://api.nf22.my.id/subscribe/whatsapp";

// Data yang akan dikirimkan via POST (x-www-form-urlencoded)
$data = [
    'api_key'    => 'xxxxxxxxxxxxxxxxxxxxx', // Ganti dengan API Key Anda
    'secret_key' => 'xxxxxxxxxxxxxxxxxxxxx', // Ganti dengan Secret Key Anda
    'action'     => 'send-sticker',
    'sender' => '62888xxxxxxx',
    'number' => '62888xxxxxxx',
    'url'    => 'https://example.com/path/to/sticker.webp',
    'full'   => 0,
];

// Keterangan parameter tambahan:
// sender : nomor device WhatsApp Anda (tanpa +)
number : nomor tujuan
url    : URL sticker (format yang didukung server WA)
full   : (opsional) 1 untuk menampilkan response penuh

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
