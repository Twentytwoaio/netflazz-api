<?php
// callback.php - Netflazz Webhook Handler (SEMUA TIPE PRODUK) - SATU LOG ENTRY
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, X-Signature');

// Handle CORS preflight
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}

// ==========================================
// KONFIGURASI
// ==========================================
$apiKey = "xxxxxxxxxxxxxxxxxxxxx";  // Ganti dengan API key yang sesuai
$secret = "xxxxxxxxxxxxxxxxxxxxx"; // Ganti dengan Secret key yang sesuai

// ==========================================
// FUNGSI LOGGING
// ==========================================
function logCallback($type, $oid, $status, $layanan, $data = []) {
    $logFile = __DIR__ . '/netflazz_callback.log';
    $timestamp = date('Y-m-d H:i:s');
    $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    
    $logEntry = sprintf(
        "[%s] [IP: %s] [%s] OID: %s | Status: %s | Layanan: %s | Data: %s\n",
        $timestamp,
        $ip,
        $type,
        $oid,
        $status,
        $layanan,
        json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
    );
    
    // Tulis ke file log
    file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);
    
    // Juga tampilkan di error_log untuk debugging
    error_log("NETFLAZZ_CALLBACK: " . trim($logEntry));
}

// ==========================================
// VALIDASI SIGNATURE
// ==========================================
function validateSignature($payload, $signature, $apiKey, $secret) {
    $validSignature = hash_hmac('sha256', $payload, $apiKey . $secret);
    return hash_equals($validSignature, $signature);
}

// ==========================================
// PROSES CALLBACK (UNTUK SEMUA TIPE) - SATU LOG SAJA
// ==========================================
try {
    // Ambil payload dan signature
    $payload = file_get_contents('php://input');
    $signature = $_SERVER['HTTP_X_SIGNATURE'] ?? '';
    
    // Validasi signature
    if (!validateSignature($payload, $signature, $apiKey, $secret)) {
        http_response_code(401);
        logCallback('INVALID_SIGNATURE', 'N/A', 'Error', 'Signature Validation Failed', [
            'ip' => $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0',
            'signature_received' => $signature
        ]);
        echo json_encode(['error' => 'Invalid signature']);
        exit;
    }
    
    // Decode payload
    $data = json_decode($payload, true);
    
    if (!$data) {
        http_response_code(400);
        logCallback('INVALID_JSON', 'N/A', 'Error', 'Invalid JSON', [
            'payload' => $payload
        ]);
        echo json_encode(['error' => 'Invalid JSON payload']);
        exit;
    }
    
    // ==========================================
    // FIELD YANG DITERIMA (UMUM UNTUK SEMUA TIPE)
    // ==========================================
    $type = $data['type'] ?? '';        // Type: PRABAYAR, PASCABAYAR, SOSIAL_MEDIA, API_MERCHANT (WAJIB)
    $oid = $data['oid'] ?? '';           // Order ID (WAJIB)
    $status = $data['status'] ?? '';     // Status: Success, Error, Partial (WAJIB)
    $layanan = $data['layanan'] ?? '';   // Nama layanan (WAJIB)
    
    // ==========================================
    // DETEKSI TIPE PRODUK & PERSIAPAN DATA LOG
    // ==========================================
    $logData = [
        'signature_valid' => true,
        'data_received' => $data
    ];
    
    switch (strtoupper($type)) {
        case 'PRABAYAR':
            $logData['target'] = $data['target'] ?? '';
            $logData['harga'] = $data['harga'] ?? 0;
            $logData['sn'] = $data['sn'] ?? '';
            // Contoh: Update status order prabayar
            // $db->query("UPDATE orders_prabayar SET status=?, sn=? WHERE oid=?", [$status, $sn, $oid]);
            break;
            
        case 'PASCABAYAR':
            $logData['target'] = $data['target'] ?? '';
            $logData['harga'] = $data['harga'] ?? 0;
            $logData['sn'] = $data['sn'] ?? '';
            // Contoh: Update status order pascabayar
            // $db->query("UPDATE orders_pascabayar SET status=?, sn=? WHERE oid=?", [$status, $sn, $oid]);
            break;
            
        case 'SOSIAL_MEDIA':
            $logData['target'] = $data['target'] ?? '';
            $logData['harga'] = $data['harga'] ?? 0;
            $logData['start'] = $data['start'] ?? 0;
            $logData['remains'] = $data['remains'] ?? 0;
            $logData['completed'] = $logData['start'] - $logData['remains'];
            // Contoh: Update progress order sosmed
            // $db->query("UPDATE orders_sosmed SET status=?, start=?, remains=?, completed=? WHERE oid=?", 
            //           [$status, $start, $remains, $completed, $oid]);
            break;
            
        case 'API_MERCHANT':
            $logData['saldo'] = $data['saldo'] ?? 0;
            $logData['jumlah'] = $data['jumlah'] ?? 0;
            $logData['fee'] = $data['fee'] ?? 0;
            $logData['via'] = $data['via'] ?? '';
            $logData['provider'] = $data['provider'] ?? '';
            $logData['tujuan'] = $data['tujuan'] ?? '';
            // Contoh: Update saldo user di database
            // if ($status === 'Success') {
            //     $db->query("UPDATE users SET balance = balance + ? WHERE id = ?", [$saldo, $user_id]);
            //     $db->query("INSERT INTO deposits (oid, user_id, amount, fee, via, provider, status) VALUES (?, ?, ?, ?, ?, ?, ?)",
            //               [$oid, $user_id, $saldo, $fee, $via, $provider, $status]);
            // }
            break;
            
        default:
            logCallback('UNKNOWN_TYPE', $oid, $status, $layanan, [
                'type_received' => $type,
                'action' => 'rejected_unknown_type'
            ]);
            http_response_code(400);
            echo json_encode(['error' => 'Unknown type']);
            exit;
    }
    
    // ==========================================
    // HANYA SATU LOG ENTRY DISINI!
    // ==========================================
    logCallback($type, $oid, $status, $layanan, $logData);
    
    // ==========================================
    // RESPONSE KE NETFLAZZ (WAJIB DIKIRIM)
    // ==========================================
    $response = [
        'success' => true,
        'message' => 'Callback processed successfully',
        'type' => $type,
        'order_id' => $oid,
        'status' => $status,
        'processed_at' => date('Y-m-d H:i:s')
    ];
    
    echo json_encode($response);
    
} catch (Exception $e) {
    // Log error
    logCallback('EXCEPTION', $oid ?? 'N/A', 'Error', $layanan ?? 'Unknown', [
        'error_message' => $e->getMessage(),
        'error_file' => $e->getFile(),
        'error_line' => $e->getLine(),
        'action' => 'exception_occurred'
    ]);
    
    http_response_code(500);
    echo json_encode([
        'error' => 'Internal server error',
        'message' => $e->getMessage()
    ]);
}
?>
