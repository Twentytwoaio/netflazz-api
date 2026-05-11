<?php
/**
 * Sample Code - Cek & Submit Aktivasi Key
 * API License NF22
 * Platform: Web / PHP
 *
 * Alur:
 * 1. Panggil cek_license_key() saat halaman dimuat
 * 2. Jika need_key_form = true -> tampilkan form input KEY
 * 3. Jika user submit KEY -> panggil submit_license_key()
 * 4. Jika ok = true -> lanjutkan aplikasi
 */

define('LICENSE_CODE', 'MASUKKAN_LICENSE_CODE_ANDA');
define('LICENSE_API',  'https://api.nf22.my.id/subscribe/licenses');

function call_license_api(array $payload): array {
    $body = json_encode($payload);
    $ch   = curl_init(LICENSE_API);
    curl_setopt_array($ch, [
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $body,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 10,
        CURLOPT_HTTPHEADER     => [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($body),
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

function cek_license_key(): array {
    return call_license_api([
        'license_code' => LICENSE_CODE,
        'action'       => 'key',
        // 'domain' => 'example.com', // opsional, default: domain server pemanggil
    ]);
}

function submit_license_key(string $key): array {
    return call_license_api([
        'license_code' => LICENSE_CODE,
        'action'       => 'submit_key',
        'key'          => $key,
        // 'domain' => 'example.com', // harus sama dengan cek_license_key()
    ]);
}

// ========================= CONTOH PENGGUNAAN =========================

$error_submit = '';

// Proses submit KEY jika form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['activation_key'])) {
    $key    = trim($_POST['activation_key']);
    $result = submit_license_key($key);

    if ($result['ok']) {
        // Aktivasi berhasil, redirect agar tidak re-submit
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }
    $error_submit = $result['message'] ?? 'Aktivasi gagal.';
}

// Cek status lisensi
$license = cek_license_key();

if ($license['ok']) {
    // Lisensi valid, lanjutkan aplikasi
    // include 'halaman-utama.php';
    exit;
}

// Tampilkan form KEY atau halaman error
$need_key_form = $license['need_key_form'] ?? false;
$style         = $license['style']         ?? 1;
$css_url       = $license['css_url']       ?? '';
$image         = $license['image']         ?? '';
$favicon       = $license['favicon']       ?? '';
$powered       = $license['powered']       ?? 'NF22 License';
$message       = $license['message']       ?? 'Verifikasi lisensi gagal.';
$expired_at    = $license['expired_at']    ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aktivasi Lisensi</title>
    <link rel="icon" href="<?php echo htmlspecialchars($favicon); ?>">
    <?php if ($css_url): ?>
    <link rel="stylesheet" href="<?php echo htmlspecialchars($css_url); ?>">
    <?php endif; ?>
</head>
<body>
    <div class="license-wrapper">
        <?php if ($image): ?>
        <img src="<?php echo htmlspecialchars($image); ?>" alt="Logo" class="license-logo">
        <?php endif; ?>

        <?php if ($need_key_form): ?>
        <!-- Form Input KEY -->
        <div class="license-form">
            <p class="license-message"><?php echo htmlspecialchars($message); ?></p>
            <?php if ($expired_at): ?>
            <p class="license-expired">Expired sejak: <?php echo htmlspecialchars($expired_at); ?></p>
            <?php endif; ?>
            <?php if ($error_submit): ?>
            <p class="license-error"><?php echo htmlspecialchars($error_submit); ?></p>
            <?php endif; ?>
            <form method="POST">
                <input type="text" name="activation_key" placeholder="Masukkan KEY Aktivasi" required autocomplete="off">
                <button type="submit">Aktifkan</button>
            </form>
        </div>
        <?php else: ?>
        <!-- Halaman Error (tidak bisa self-service) -->
        <div class="license-error-info">
            <p><?php echo htmlspecialchars($message); ?></p>
        </div>
        <?php endif; ?>

        <small class="license-powered">Powered by <?php echo htmlspecialchars($powered); ?></small>
    </div>
</body>
</html>
