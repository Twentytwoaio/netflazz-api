<?php
/**
 * Sample Code - Verifikasi Domain
 * API License22 - NetFlazz
 * Platform: Web / PHP
 *
 * Cara penggunaan:
 * Taruh file ini di server Anda, panggil fungsi cek_license_domain()
 * setiap kali halaman dimuat. Jika ok = false, tampilkan halaman error
 * menggunakan data style/css_url/image/favicon/powered dari respon.
 */

define('LICENSE_CODE', 'MASUKKAN_LICENSE_CODE_ANDA');
define('LICENSE_API',  'https://api.nf22.my.id/subscribe/licenses');

function cek_license_domain(): array {
    $payload = json_encode([
        'license_code' => LICENSE_CODE,
        'action'       => 'domain',
        // 'domain' => 'example.com', // opsional, default: domain server pemanggil
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
        // Jika API tidak dapat dihubungi, default aman: tolak akses
        return ['ok' => false, 'message' => 'Tidak dapat menghubungi server lisensi.'];
    }

    $data = json_decode($response, true);
    return is_array($data) ? $data : ['ok' => false, 'message' => 'Respon tidak valid.'];
}

// ========================= CONTOH PENGGUNAAN =========================

$license = cek_license_domain();

if (!$license['ok']) {
    // Tampilkan halaman error dengan style dari respon
    $style   = $license['style']   ?? 1;
    $css_url = $license['css_url'] ?? '';
    $image   = $license['image']   ?? '';
    $favicon = $license['favicon'] ?? '';
    $powered = $license['powered'] ?? 'NF22 License';
    $message = $license['message'] ?? 'Verifikasi lisensi gagal.';

    // Contoh tampilan halaman error sederhana
    ?>
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Lisensi Tidak Valid</title>
        <link rel="icon" href="<?php echo htmlspecialchars($favicon); ?>">
        <?php if ($css_url): ?>
        <link rel="stylesheet" href="<?php echo htmlspecialchars($css_url); ?>">
        <?php endif; ?>
    </head>
    <body>
        <div class="license-error">
            <?php if ($image): ?>
            <img src="<?php echo htmlspecialchars($image); ?>" alt="Logo">
            <?php endif; ?>
            <p><?php echo htmlspecialchars($message); ?></p>
            <small>Powered by <?php echo htmlspecialchars($powered); ?></small>
        </div>
    </body>
    </html>
    <?php
    exit;
}
