<?php
// Sample request for action: send-list

// URL API Subscribe WhatsApp NetFlazz
$url = "https://api.nf22.my.id/subscribe/whatsapp";

// Data yang akan dikirimkan via POST (x-www-form-urlencoded)
$data = [
    'api_key'    => 'xxxxxxxxxxxxxxxxxxxxx', // Ganti dengan API Key Anda
    'secret_key' => 'xxxxxxxxxxxxxxxxxxxxx', // Ganti dengan Secret Key Anda
    'action'     => 'send-list',
    'sender'      => '62888xxxxxxx',
    'number'      => '62888xxxxxxx',
    'title'       => 'Pilih Menu Layanan NetFlazz',
    'buttonText'  => 'Lihat Menu',
    'description' => 'Silakan pilih salah satu kategori layanan di bawah:',
    // Contoh sederhana, implementasi array dinamis mengikuti dokumentasi resmi set-list API WA
    'sections'    => [
        [
            'title' => 'Pulsa & Paket Data',
            'rows'  => [
                ['id' => 'pulsa', 'title' => 'Pulsa Semua Operator'],
                ['id' => 'data', 'title' => 'Paket Data Internet'],
            ],
        ],
    ],
    'full'        => 0,
];

// Keterangan parameter tambahan:
// sender      : nomor device WhatsApp Anda (tanpa +)
number      : nomor tujuan
title       : judul list message
buttonText  : teks tombol list
description : deskripsi singkat
sections    : data list (gunakan sections[][title], sections[][rows][] saat x-www-form-urlencoded)
full        : (opsional) 1 untuk menampilkan response penuh

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
