<?php
// Sample request for action: send-media

// URL API Subscribe WhatsApp NetFlazz
$url = "https://api.nf22.my.id/subscribe/whatsapp";

// Data yang akan dikirimkan via POST (x-www-form-urlencoded)
$data = [
    'api_key'    => 'xxxxxxxxxxxxxxxxxxxxx', // Ganti dengan API Key Anda
    'secret_key' => 'xxxxxxxxxxxxxxxxxxxxx', // Ganti dengan Secret Key Anda
    'action'     => 'send-media',
    'sender'     => '62888xxxxxxx',
    'number'     => '62888xxxxxxx',
    'media_type' => 'image', // image | video | audio | document
    'url'        => 'https://example.com/path/to/image.jpg',
    'caption'    => 'Ini contoh kirim gambar via API NetFlazz',
    'filename'   => 'promo-netflazz.jpg',
    'full'       => 0,
];

// Keterangan parameter tambahan:
// sender     : nomor device WhatsApp Anda (tanpa +)
number     : nomor tujuan
media_type : jenis media (image, video, audio, document)
url        : URL media (harus dapat diakses publik)
caption    : (opsional) caption media
filename   : (opsional) nama file untuk document
full       : (opsional) 1 untuk menampilkan response penuh

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
