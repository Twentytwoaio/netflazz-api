/**
 * Sample Code - Cek & Submit Aktivasi Key
 * API License NF22
 * Platform: Desktop / Electron (Node.js)
 *
 * Alur:
 * 1. Generate hardware fingerprint dari info hardware PC
 * 2. Panggil cekLicenseKey() saat aplikasi startup
 * 3. Jika needKeyForm = true -> tampilkan dialog input KEY
 * 4. Jika user submit KEY -> panggil submitLicenseKey()
 * 5. Jika ok = true -> lanjutkan aplikasi
 *
 * Install dependency: npm install node-fetch (jika Node < 18)
 */

const crypto = require('crypto');
const os     = require('os');

const LICENSE_CODE = 'MASUKKAN_LICENSE_CODE_ANDA';
const LICENSE_API  = 'https://api.nf22.my.id/subscribe/licenses';

/**
 * Generate hardware fingerprint stabil dari info hardware PC.
 * Menghasilkan string SHA-256 hex 64 karakter.
 * Nilai ini konsisten selama hardware tidak berubah.
 */
function getHardwareFingerprint() {
    const ifaces   = os.networkInterfaces();
    const mac      = Object.values(ifaces)
        .flat()
        .find(i => i && !i.internal && i.mac && i.mac !== '00:00:00:00:00:00')?.mac || 'no-mac';
    const hostname = os.hostname();
    const cpu      = os.cpus()?.[0]?.model || 'no-cpu';
    const platform = os.platform();

    const raw = `${hostname}|${mac}|${cpu}|${platform}`;
    return crypto.createHash('sha256').update(raw).digest('hex'); // 64 char hex
}

async function callLicenseApi(payload) {
    const response = await fetch(LICENSE_API, {
        method:  'POST',
        headers: { 'Content-Type': 'application/json' },
        body:    JSON.stringify(payload),
        signal:  AbortSignal.timeout(10000),
    });
    return await response.json();
}

async function cekLicenseKey() {
    const fingerprint = getHardwareFingerprint();
    return await callLicenseApi({
        license_code: LICENSE_CODE,
        action:       'key',
        domain:       fingerprint, // wajib untuk desktop
    });
}

async function submitLicenseKey(activationKey) {
    const fingerprint = getHardwareFingerprint();
    return await callLicenseApi({
        license_code: LICENSE_CODE,
        action:       'submit_key',
        key:          activationKey,
        domain:       fingerprint, // harus sama dengan cekLicenseKey()
    });
}

// ========================= CONTOH PENGGUNAAN =========================

async function startApp() {
    let license;

    try {
        license = await cekLicenseKey();
    } catch (err) {
        console.error('Tidak dapat menghubungi server lisensi:', err.message);
        // Tambahkan penanganan jika API tidak dapat dihubungi
        return;
    }

    if (license.ok) {
        // Lisensi valid, lanjutkan aplikasi
        console.log('Lisensi valid:', license.message);
        launchMainWindow();
        return;
    }

    if (license.need_key_form) {
        // Tampilkan dialog input KEY
        // Gunakan data license.css_url, license.image, license.favicon, license.powered
        // untuk menampilkan tampilan yang sesuai lisensi
        console.log('Perlu aktivasi:', license.message);
        if (license.expired_at) {
            console.log('Expired sejak:', license.expired_at);
        }
        showActivationDialog(license);
        return;
    }

    // Error tidak bisa self-service (blocked, pending, expired by status)
    console.log('Akses ditolak:', license.message);
    showErrorDialog(license.message);
}

async function onUserSubmitKey(activationKey) {
    let result;

    try {
        result = await submitLicenseKey(activationKey);
    } catch (err) {
        return { ok: false, message: 'Tidak dapat menghubungi server lisensi.' };
    }

    if (result.ok) {
        console.log('Aktivasi berhasil. Aktif hingga:', result.active_until);
        launchMainWindow();
    } else {
        console.log('Aktivasi gagal:', result.message);
    }

    return result;
}

function launchMainWindow()   { /* Buka jendela utama aplikasi */ }
function showActivationDialog(license) { /* Tampilkan dialog aktivasi */ }
function showErrorDialog(msg) { /* Tampilkan dialog error */ }

// Jalankan saat app siap
// app.whenReady().then(startApp); // uncomment jika di dalam Electron main process
