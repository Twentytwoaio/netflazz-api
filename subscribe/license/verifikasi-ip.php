<?php
/**
 * Sample Code - Verifikasi IP Server
 * API License NF22
 * Platform: Server / PHP
 *
 * Cara penggunaan:
 * Panggil fungsi cek_license_ip() di setiap request masuk.
 * Jika ok = false, tolak request dan kembalikan pesan error.
 */

define('LICENSE_CODE', 'MASUKKAN_LICENSE_CODE_ANDA');
define('LICENSE_API',  'https://api.nf22.my.id/subscribe/licenses');

function cek_license_ip(): array {
    $payload = json_encode([
        'license_code' => LICENSE_CODE,
        'action'       => 'ip',
        // 'ip' => '123.456.789.0', // opsional, default: IP server pemanggil
    ]);

    $ch = curl_init(LICENSE_API);
    curl_setopt_array($ch, [
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $payload,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 10,
        CURLOPT_HTTPHEADER     => [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload),
        ],
    ]);
    $response = curl_exec($ch);
    $err      = curl_error($ch);
    curl_close($ch);

    if ($err || !$response) {
        return ['ok' => false, 'message' => 'Tidak dapat menghubungi server lisensi.'];
    }

    $data = json_decode($response, true);
    return is_array($data) ? $data : ['ok' => false, 'message' => 'Respon tidak valid.'];
}

// ========================= CONTOH PENGGUNAAN =========================

$license = cek_license_ip();

if (!$license['ok']) {
    header('Content-Type: application/json; charset=utf-8');
    http_response_code(403);
    echo json_encode([
        'status'  => false,
        'message' => $license['message'] ?? 'Verifikasi lisensi gagal.',
    ]);
    exit;
}
