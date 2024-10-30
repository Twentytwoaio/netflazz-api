<?php
$url = 'https://api.nf22.my.id/botnet.php';  // Ganti dengan URL endpoint API Anda
$isi_pertanyaan = 'Apa itu netflazz?'; // Ganti dengan pertanyaan anda
// Data yang akan dikirimkan ke API
$data = array(
    'api_key' => 'xxxxxxxxxxxxxxxxxxxxxx',  // Ganti dengan API key Anda yang sesuai
    'pin' => '1234',                        // Ganti dengan PIN NetFlazz Anda
    'action' => 'chat',
    'text' => $isi_pertanyaan           // Contoh teks yang akan dikirim ke API BOTNET
);

// Inisialisasi cURL
$ch = curl_init($url);

// Konfigurasi cURL untuk permintaan POST
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/x-www-form-urlencoded'
));

// Menjalankan permintaan cURL dan mendapatkan respons
$response = curl_exec($ch);

// Menangani error cURL jika ada
if ($response === false) {
    echo 'Curl error: ' . curl_error($ch);
} else {
    // Menampilkan hasil respon dari API dalam format JSON
    echo "Response from API: " . htmlspecialchars($response);
}

// Tutup koneksi cURL
curl_close($ch);
?>
