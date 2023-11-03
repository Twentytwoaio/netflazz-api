<?php

$api_key = 'd09IB1KevtDZwoxxxxx';
$api_url = 'https://netflazz.com/api/profile';

$post_data = "api_key=$api_key&action=profile";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$chresult = curl_exec($ch);
curl_close($ch);
$json_result = json_decode($chresult, true);

// nilai yang diambil
$nama_pengguna = $json_result['data']['username'];
$saldo_digital = $json_result['data']['saldo_digital'];
$saldo_sosmed = $json_result['data']['saldo_sosmed'];
$total_pemakaian = $json_result['data']['total_pemakaian'];
        
// proses memasukan nilai ke database //
// $insert ................................. //
        
// jika berhasil melakukan insert dan bernilai TRUE akan menampilkan
if ($insert == TRUE) {
echo"Berhasil Menampilkan Data Informasi Akun Netflazz
     Nama Pengguna : $nama_pengguna
     Saldo Digital : $saldo_digital
     Saldo Sosmed : $saldo_sosmed
     Total Pemakaian : $total_pemakaian
     ";
} else {
    echo "Gagal Menampilkan Data Informasi Akun Netflazz.<br />";
    
}
?>