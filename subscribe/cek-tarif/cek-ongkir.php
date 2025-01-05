<?php
// URL API Anda
$url = "https://api.nf22.my.id/subscribe/cek-tarif.php";

// Data yang akan dikirimkan via POST
$data = [
    'api_key' => 'xxxxxxxxxxxxxxxxxxxxx',      // Ganti dengan API Key Anda
    'secret_key' => 'xxxxxxxxxxxxxxxxxxxxx',  // Ganti dengan Secret Key Anda
    'action' => 'cekOngkir',        // Action Jangan Diubah
    'courier' => 'jne',            // Ubah Dengan Expedisi (jne/sicepat/anteraja/lion/sap/pos/ide)
    'origin' => 'jakarta',            // nama kota/kab ambil dari cek wilayah ongkir (lokasi pengirim)
    'destination' => 'cilegon',    // nama kota/kab ambil dari cek wilayah ongkir (lokasi penerima)
    'weight' => '1',            // satuan kilo (jika 500gram gunakan 0.5)
    'panjang' => '100',         // ubah untuk panjang barang
    'lebar' => '100',           // ubah untuk lebar barang
    'tinggi' => '100'           // ubah untuk tinggi barang
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
