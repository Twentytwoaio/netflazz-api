/**
 * Sample Code - Cek & Submit Aktivasi Key
 * API License NF22
 * Platform: Android (Kotlin)
 *
 * Alur:
 * 1. Generate hardware fingerprint dari info perangkat Android
 * 2. Panggil cekLicenseKey() saat aplikasi startup (di ViewModel/Coroutine)
 * 3. Jika needKeyForm = true -> tampilkan dialog input KEY
 * 4. Jika user submit KEY -> panggil submitLicenseKey()
 * 5. Jika ok = true -> lanjutkan aplikasi
 *
 * Tambahkan permission di AndroidManifest.xml:
 * <uses-permission android:name="android.permission.INTERNET"/>
 */

package com.example.app.license

import android.content.Context
import android.provider.Settings
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.withContext
import org.json.JSONObject
import java.net.HttpURLConnection
import java.net.URL
import java.security.MessageDigest

const val LICENSE_CODE = "MASUKKAN_LICENSE_CODE_ANDA"
const val LICENSE_API  = "https://api.nf22.my.id/subscribe/licenses"

/**
 * Generate hardware fingerprint dari Android ID.
 * Menghasilkan string SHA-256 hex 64 karakter.
 * Nilai konsisten selama aplikasi tidak di-uninstall.
 */
fun getHardwareFingerprint(context: Context): String {
    val androidId = Settings.Secure.getString(
        context.contentResolver,
        Settings.Secure.ANDROID_ID
    ) ?: "unknown"

    val raw    = "${androidId}|${android.os.Build.MODEL}|${android.os.Build.MANUFACTURER}"
    val digest = MessageDigest.getInstance("SHA-256").digest(raw.toByteArray())
    return digest.joinToString("") { "%02x".format(it) } // 64 char hex
}

data class LicenseResult(
    val ok:           Boolean,
    val message:      String,
    val needKeyForm:  Boolean  = false,
    val expiredAt:    String?  = null,
    val activeUntil:  String?  = null,
    val style:        Int      = 1,
    val cssUrl:       String   = "",
    val image:        String   = "",
    val favicon:      String   = "",
    val powered:      String   = "NF22 License",
)

suspend fun callLicenseApi(payload: JSONObject): LicenseResult = withContext(Dispatchers.IO) {
    try {
        val url  = URL(LICENSE_API)
        val conn = url.openConnection() as HttpURLConnection
        conn.apply {
            requestMethod     = "POST"
            doOutput          = true
            connectTimeout    = 10_000
            readTimeout       = 10_000
            setRequestProperty("Content-Type", "application/json")
        }
        conn.outputStream.use { it.write(payload.toString().toByteArray()) }

        val body = conn.inputStream.bufferedReader().readText()
        val json = JSONObject(body)

        LicenseResult(
            ok          = json.optBoolean("ok", false),
            message     = json.optString("message", ""),
            needKeyForm = json.optBoolean("need_key_form", false),
            expiredAt   = if (json.has("expired_at"))   json.getString("expired_at")   else null,
            activeUntil = if (json.has("active_until")) json.getString("active_until") else null,
            style       = json.optInt("style", 1),
            cssUrl      = json.optString("css_url", ""),
            image       = json.optString("image", ""),
            favicon     = json.optString("favicon", ""),
            powered     = json.optString("powered", "NF22 License"),
        )
    } catch (e: Exception) {
        LicenseResult(ok = false, message = "Tidak dapat menghubungi server lisensi.")
    }
}

suspend fun cekLicenseKey(context: Context): LicenseResult {
    val fingerprint = getHardwareFingerprint(context)
    return callLicenseApi(JSONObject().apply {
        put("license_code", LICENSE_CODE)
        put("action",       "key")
        put("domain",       fingerprint) // wajib untuk Android
    })
}

suspend fun submitLicenseKey(context: Context, activationKey: String): LicenseResult {
    val fingerprint = getHardwareFingerprint(context)
    return callLicenseApi(JSONObject().apply {
        put("license_code", LICENSE_CODE)
        put("action",       "submit_key")
        put("key",          activationKey)
        put("domain",       fingerprint) // harus sama dengan cekLicenseKey()
    })
}

// ========================= CONTOH PENGGUNAAN DI ACTIVITY =========================

// Di dalam Activity atau ViewModel (gunakan lifecycleScope atau viewModelScope):
//
// lifecycleScope.launch {
//     val license = cekLicenseKey(this@MainActivity)
//     if (license.ok) {
//         // Lanjutkan ke halaman utama
//     } else if (license.needKeyForm) {
//         // Tampilkan dialog input KEY
//         // Gunakan license.cssUrl, license.image, dll untuk styling
//         if (license.expiredAt != null) {
//             // Tampilkan info "Expired sejak: ${license.expiredAt}"
//         }
//     } else {
//         // Tampilkan pesan error license.message (tidak bisa self-service)
//     }
// }

// Saat user submit KEY dari dialog:
//
// lifecycleScope.launch {
//     val result = submitLicenseKey(this@MainActivity, activationKey)
//     if (result.ok) {
//         // "Aktif hingga: ${result.activeUntil}"
//         // Lanjutkan ke halaman utama
//     } else {
//         // Tampilkan result.message sebagai error
//     }
// }
