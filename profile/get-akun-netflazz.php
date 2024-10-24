<?php

// API endpoint dan parameter
$api_url = 'https://api.nf22.my.id/profile';
$api_key = 'xxxxxxxxxxxxxxxxxxxxx'; // Ganti dengan API key yang sesuai
$pin = '1234'; // Ganti dengan PIN yang sesuai
$action = 'profile'; // Aksi yang akan dilakukan

// Data yang akan dikirim sebagai payload
$postdata = [
    'api_key' => $api_key,
    'pin' => $pin,
    'action' => $action
];

// Inisialisasi cURL
$ch = curl_init();

// Setel opsi cURL
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postdata));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Eksekusi cURL dan dapatkan respon
$response = curl_exec($ch);

// Tutup koneksi cURL
curl_close($ch);

// Dekode respon JSON
$json_result = json_decode($response, true);

// Tampilkan hasil berdasarkan struktur JSON yang sebenarnya
if (isset($json_result['status']) && $json_result['status'] == 1) {
    // Mengakses data dari array dengan indeks numerik
    $user_data = $json_result['data'][0]; // Ambil data pengguna pertama

    echo "Pengambilan profil berhasil. Berikut adalah detail profilnya:<br>";
    echo "Nama: " . $user_data['nama'] . "<br>"; // Menampilkan nama
    echo "Username: " . $user_data['username'] . "<br>"; // Menampilkan username
    echo "Email: " . $user_data['email'] . "<br>"; // Menampilkan email
    echo "Saldo Digital: " . $user_data['saldo_digital'] . "<br>"; // Menampilkan saldo digital
    echo "Saldo Diamond: " . $user_data['saldo_diamond'] . "<br>"; // Menampilkan saldo diamond
    echo "Total Pemakaian: " . $user_data['total_pemakaian'] . "<br>"; // Menampilkan total pemakaian
} else {
    echo "Gagal mengambil profil. Pesan: " . (isset($json_result['message']) ? $json_result['message'] : 'Tidak ada pesan') . "<br>";
}

?>
