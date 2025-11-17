<?php
// Sample request for action: send-button

// URL API Subscribe WhatsApp NetFlazz
$url = "https://api.nf22.my.id/subscribe/whatsapp";

// Data yang akan dikirimkan via POST (x-www-form-urlencoded)
$data = [
    'api_key'    => 'xxxxxxxxxxxxxxxxxxxxx', // Ganti dengan API Key Anda
    'secret_key' => 'xxxxxxxxxxxxxxxxxxxxx', // Ganti dengan Secret Key Anda
    'action'     => 'send-button',
    'sender'  => '62888xxxxxxx',
    'number'  => '62888xxxxxxx',
    'url'     => 'https://example.com/banner-promo.jpg',
    'message' => 'Pilih salah satu tombol di bawah ini ya kak:',
    'footer'  => 'NetFlazz NetFlazz',
    // Di x-www-form-urlencoded / Postman:
    // button[0][type]=reply
    // button[0][displayText]=Cek Harga
    // button[1][type]=url
    // button[1][displayText]=Kunjungi Website
    // button[1][url]=https://netflazz.com
    'button'  => [
        [
            'type'        => 'reply',
            'displayText' => 'Cek Harga',
        ],
        [
            'type'        => 'url',
            'displayText' => 'Kunjungi Website',
            'url'         => 'https://netflazz.com',
        ],
    ],
];

// Keterangan parameter tambahan:
// sender : nomor device WhatsApp Anda
number : nomor tujuan
url    : URL media (gambar/video) jika dibutuhkan
message: teks pesan utama
footer : (opsional) footer pesan
button : array button (max 5) dengan type: reply|call|url|copy

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
