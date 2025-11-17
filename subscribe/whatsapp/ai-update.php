<?php
// Sample request for action: ai-update

// URL API Subscribe WhatsApp NetFlazz
$url = "https://api.nf22.my.id/subscribe/whatsapp";

// Data yang akan dikirimkan via POST (x-www-form-urlencoded)
$data = [
    'api_key'    => 'xxxxxxxxxxxxxxxxxxxxx', // Ganti dengan API Key Anda
    'secret_key' => 'xxxxxxxxxxxxxxxxxxxxx', // Ganti dengan Secret Key Anda
    'action'     => 'ai-update',
    'sender'             => '62888xxxxxxx',
    'typebot'            => 2,
    'reply_when'         => 'All',
    'reject_call'        => 1,
    'reject_message'     => 'Maaf, nomor ini tidak menerima panggilan. Silakan chat saja ya 😊',
    'can_read_message'   => 1,
    'bot_typing'         => 1,
    'system_instructions'=> 'Kamu adalah CS NetFlazz yang ramah dan profesional, jawab singkat, jelas, dan gunakan bahasa Indonesia santai.',
    'chatgpt_name'       => 'NF ChatGPT Bot',
    'chatgpt_api'        => 'sk-chatgpt-xxxxxxxxxxxx',
    'chatgpt_model'      => 'gpt-5-mini',
    'gemini_name'        => 'NF Gemini Bot',
    'gemini_api'         => 'sk-gemini-xxxxxxxxxxxx',
    'gemini_model'       => 'gemini-2.5-pro',
    'claude_name'        => 'NF Claude Bot',
    'claude_api'         => 'sk-claude-xxxxxxxxxxxx',
    'claude_model'       => 'claude-3-5-haiku-20241022',
    'dalle_name'         => 'NF Image Bot',
    'dalle_api'          => 'sk-dalle-xxxxxxxxxxxx',
];

// Keterangan parameter tambahan:
// sender            : nomor device untuk diatur AI Bot-nya
typebot           : 0=disable,1=one bot,2=multi bot
reply_when        : Group|Personal|All
reject_call       : 0/1
reject_message    : pesan balasan jika panggilan ditolak
can_read_message  : 0/1
bot_typing        : 0/1
system_instructions: prompt global AI
chatgpt_*, gemini_*, claude_*, dalle_* : konfigurasi model & API key

// Inisiasi cURL
$ch = curl_init($url);

// Set opsi cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

// Eksekusi cURL dan simpan respons
$response = curl_exec($ch);

// Cek apakah ada error saat mengambil data
if ($response === false) {
    echo 'Error: ' . curl_error($ch);
} else {
    // Menampilkan respons API
    header('Content-Type: application/json; charset=utf-8');
    echo $response;
}

// Tutup koneksi cURL
curl_close($ch);
?>
