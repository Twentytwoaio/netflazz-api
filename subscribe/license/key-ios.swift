/**
 * Sample Code - Cek & Submit Aktivasi Key
 * API License22 - NetFlazz
 * Platform: iOS (Swift)
 *
 * Alur:
 * 1. Generate hardware fingerprint dari identifierForVendor
 * 2. Panggil cekLicenseKey() saat aplikasi startup
 * 3. Jika needKeyForm = true -> tampilkan view input KEY
 * 4. Jika user submit KEY -> panggil submitLicenseKey()
 * 5. Jika ok = true -> lanjutkan aplikasi
 */

import Foundation
import UIKit
import CryptoKit

let LICENSE_CODE = "MASUKKAN_LICENSE_CODE_ANDA"
let LICENSE_API  = "https://api.nf22.my.id/subscribe/licenses"

// ========================= FINGERPRINT =========================

/**
 * Generate hardware fingerprint dari identifierForVendor iOS.
 * Menghasilkan string SHA-256 hex 64 karakter.
 * Nilai konsisten selama aplikasi tidak di-uninstall dari perangkat yang sama.
 */
func getHardwareFingerprint() -> String {
    let vendorId = UIDevice.current.identifierForVendor?.uuidString ?? "unknown"
    let model    = UIDevice.current.model
    let raw      = "\(vendorId)|\(model)"

    let data   = Data(raw.utf8)
    let digest = SHA256.hash(data: data)
    return digest.map { String(format: "%02x", $0) }.joined() // 64 char hex
}

// ========================= MODEL =========================

struct LicenseResult {
    let ok:          Bool
    let message:     String
    let needKeyForm: Bool
    let expiredAt:   String?
    let activeUntil: String?
    let style:       Int
    let cssUrl:      String
    let image:       String
    let favicon:     String
    let powered:     String

    static func error(_ message: String) -> LicenseResult {
        LicenseResult(ok: false, message: message, needKeyForm: false,
                      expiredAt: nil, activeUntil: nil, style: 1,
                      cssUrl: "", image: "", favicon: "", powered: "NF22 License")
    }
}

// ========================= API CALL =========================

func callLicenseApi(payload: [String: Any], completion: @escaping (LicenseResult) -> Void) {
    guard let url = URL(string: LICENSE_API) else {
        completion(.error("URL tidak valid.")); return
    }
    guard let body = try? JSONSerialization.data(withJSONObject: payload) else {
        completion(.error("Payload tidak valid.")); return
    }

    var request        = URLRequest(url: url, timeoutInterval: 10)
    request.httpMethod = "POST"
    request.httpBody   = body
    request.setValue("application/json", forHTTPHeaderField: "Content-Type")

    URLSession.shared.dataTask(with: request) { data, _, error in
        if let error = error {
            completion(.error("Tidak dapat menghubungi server lisensi: \(error.localizedDescription)"))
            return
        }
        guard let data = data,
              let json = try? JSONSerialization.jsonObject(with: data) as? [String: Any] else {
            completion(.error("Respon tidak valid.")); return
        }

        completion(LicenseResult(
            ok:          json["ok"]           as? Bool   ?? false,
            message:     json["message"]      as? String ?? "",
            needKeyForm: json["need_key_form"] as? Bool  ?? false,
            expiredAt:   json["expired_at"]   as? String,
            activeUntil: json["active_until"] as? String,
            style:       json["style"]        as? Int    ?? 1,
            cssUrl:      json["css_url"]      as? String ?? "",
            image:       json["image"]        as? String ?? "",
            favicon:     json["favicon"]      as? String ?? "",
            powered:     json["powered"]      as? String ?? "NF22 License"
        ))
    }.resume()
}

func cekLicenseKey(completion: @escaping (LicenseResult) -> Void) {
    let fingerprint = getHardwareFingerprint()
    callLicenseApi(payload: [
        "license_code": LICENSE_CODE,
        "action":       "key",
        "domain":       fingerprint, // wajib untuk iOS
    ], completion: completion)
}

func submitLicenseKey(activationKey: String, completion: @escaping (LicenseResult) -> Void) {
    let fingerprint = getHardwareFingerprint()
    callLicenseApi(payload: [
        "license_code": LICENSE_CODE,
        "action":       "submit_key",
        "key":          activationKey,
        "domain":       fingerprint, // harus sama dengan cekLicenseKey()
    ], completion: completion)
}

// ========================= CONTOH PENGGUNAAN =========================

// Di dalam AppDelegate atau SceneDelegate saat app launch:
//
// cekLicenseKey { result in
//     DispatchQueue.main.async {
//         if result.ok {
//             // Tampilkan halaman utama
//         } else if result.needKeyForm {
//             // Tampilkan view aktivasi KEY
//             // Gunakan result.cssUrl, result.image, dll untuk styling
//             if let expiredAt = result.expiredAt {
//                 // Tampilkan info "Expired sejak: \(expiredAt)"
//             }
//         } else {
//             // Tampilkan pesan error result.message (tidak bisa self-service)
//         }
//     }
// }

// Saat user submit KEY:
//
// submitLicenseKey(activationKey: keyFromInput) { result in
//     DispatchQueue.main.async {
//         if result.ok {
//             // "Aktif hingga: \(result.activeUntil ?? "-")"
//             // Tampilkan halaman utama
//         } else {
//             // Tampilkan result.message sebagai error
//         }
//     }
// }
