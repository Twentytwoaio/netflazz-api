<?php
// URL API Anda
$url = "https://api.nf22.my.id/subscribe/agama.php";

// Data yang akan dikirimkan via POST
$data = [
    'api_key' => 'xxxxxxxxxxxxxxxxxxxxx',      // Ganti dengan API Key Anda
    'secret_key' => 'xxxxxxxxxxxxxxxxxxxxx',  // Ganti dengan Secret Key Anda
    'action' => 'jadwal',  // Action Jangan Diubah
    'id_kota' => '1301',   // Ubah dengan ID Kota
    'tanggal' => '07',   // Ubah dengan tanggal yang ingin dicek (kosongkan jika ingin mengambil jadwal bulanan)
    'bulan' => '01',   // Ubah dengan bulan yang ingin dicek
    'tahun' => '2025'   // Ubah dengan tahun yang ingin dicek
];

// Inisiasi cURL
$ch = curl_init($url);

// Set opsi cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

// Eksekusi cURL dan simpan respons
$response = curl_exec($ch);

// Cek apakah ada error saat mengambil data
if($response === false) {
    echo 'Error: ' . curl_error($ch);
} else {
    // Menampilkan respons API
    echo $response;
}

// Tutup koneksi cURL
curl_close($ch);
?>
