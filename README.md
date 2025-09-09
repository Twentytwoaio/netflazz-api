<p align="center">
  <img src="https://netflazz.com/app/assets/images/app/netflazz.png" alt="NetFlazz Logo" width="120" />
</p>

<!-- ====== HERO TITLE (SVG gradient + subtle sheen) ====== -->
<p align="center">
  <svg width="780" height="120" viewBox="0 0 780 120" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="NetFlazz API Center">
    <defs>
      <linearGradient id="grad" x1="0%" y1="0%" x2="100%" y2="0%">
        <stop offset="0%"  stop-color="#7c3aed"/>
        <stop offset="50%" stop-color="#2196f3"/>
        <stop offset="100%" stop-color="#00c2ff"/>
      </linearGradient>
      <linearGradient id="sheen" x1="0" y1="0" x2="1" y2="0">
        <stop offset="0" stop-color="rgba(255,255,255,0)" />
        <stop offset="0.5" stop-color="rgba(255,255,255,0.65)" />
        <stop offset="1" stop-color="rgba(255,255,255,0)" />
      </linearGradient>
      <clipPath id="text-clip">
        <text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle"
              font-family="Inter,Segoe UI,Roboto,Helvetica,Arial,sans-serif" font-size="44" font-weight="800">
          NetFlazz — API Center
        </text>
      </clipPath>
    </defs>

    <rect x="0" y="0" width="100%" height="100%" rx="16" fill="url(#grad)" opacity="0.15"/>
    <text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle"
          font-family="Inter,Segoe UI,Roboto,Helvetica,Arial,sans-serif" font-size="44" font-weight="800"
          fill="url(#grad)">NetFlazz — API Center</text>

    <!-- sheen sweep -->
    <rect x="-40%" y="0" width="40%" height="100%" clip-path="url(#text-clip)" fill="url(#sheen)">
      <animate attributeName="x" values="-40%;140%" dur="3.5s" repeatCount="indefinite"/>
    </rect>
  </svg>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/%F0%9F%94%A5-Pusat%20API%20Server%20Terbanyak-critical" />
  <img src="https://img.shields.io/badge/%E2%9A%A1-High%20Performance-blueviolet" />
  <img src="https://img.shields.io/badge/%F0%9F%94%92-Secure%20Integration-brightgreen" />
  <img src="https://img.shields.io/badge/%F0%9F%93%8A-Real%20Time%20Status-orange" />
</p>

---

<!-- ====== ANIMATED API NETWORK ====== -->
<p align="center">
  <svg width="900" height="260" viewBox="0 0 900 260" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="NetFlazz API Network Animation">
    <defs>
      <linearGradient id="nodeGrad" x1="0" y1="0" x2="1" y2="1">
        <stop offset="0%" stop-color="#2196f3"/>
        <stop offset="100%" stop-color="#7c3aed"/>
      </linearGradient>
      <filter id="glow">
        <feGaussianBlur stdDeviation="3.5" result="coloredBlur"/>
        <feMerge>
          <feMergeNode in="coloredBlur"/>
          <feMergeNode in="SourceGraphic"/>
        </feMerge>
      </filter>
      <style>
        .label { font: 600 12px/1.2 Inter,Segoe UI,Roboto,Helvetica,Arial,sans-serif; fill: #6b7280; }
      </style>
    </defs>

    <!-- Core Hub -->
    <circle cx="450" cy="130" r="34" fill="url(#nodeGrad)" filter="url(#glow)"/>
    <text x="450" y="132" text-anchor="middle" font-family="Inter,Segoe UI,Roboto,Helvetica,Arial,sans-serif" font-size="13" font-weight="800" fill="white">NetFlazz</text>

    <!-- Spokes (dashed lines with moving dashoffset) -->
    <!-- top-left -->
    <g>
      <line x1="450" y1="130" x2="220" y2="60" stroke="#94a3b8" stroke-width="2" stroke-dasharray="6 6">
        <animate attributeName="stroke-dashoffset" values="0;12" dur="1.4s" repeatCount="indefinite"/>
      </line>
      <circle cx="220" cy="60" r="18" fill="white" stroke="#d1d5db" stroke-width="2"/>
      <text x="220" y="64" text-anchor="middle" class="label">Pulsa/Data</text>
    </g>

    <!-- mid-left -->
    <g>
      <line x1="450" y1="130" x2="200" y2="130" stroke="#94a3b8" stroke-width="2" stroke-dasharray="6 6">
        <animate attributeName="stroke-dashoffset" values="0;12" dur="1.2s" repeatCount="indefinite"/>
      </line>
      <circle cx="200" cy="130" r="18" fill="white" stroke="#d1d5db" stroke-width="2"/>
      <text x="200" y="134" text-anchor="middle" class="label">PPOB</text>
    </g>

    <!-- bottom-left -->
    <g>
      <line x1="450" y1="130" x2="240" y2="200" stroke="#94a3b8" stroke-width="2" stroke-dasharray="6 6">
        <animate attributeName="stroke-dashoffset" values="0;12" dur="1.6s" repeatCount="indefinite"/>
      </line>
      <circle cx="240" cy="200" r="18" fill="white" stroke="#d1d5db" stroke-width="2"/>
      <text x="240" y="204" text-anchor="middle" class="label">E-Money</text>
    </g>

    <!-- top-right -->
    <g>
      <line x1="450" y1="130" x2="680" y2="60" stroke="#94a3b8" stroke-width="2" stroke-dasharray="6 6">
        <animate attributeName="stroke-dashoffset" values="0;12" dur="1.3s" repeatCount="indefinite"/>
      </line>
      <circle cx="680" cy="60" r="18" fill="white" stroke="#d1d5db" stroke-width="2"/>
      <text x="680" y="64" text-anchor="middle" class="label">Pascabayar</text>
    </g>

    <!-- mid-right -->
    <g>
      <line x1="450" y1="130" x2="700" y2="130" stroke="#94a3b8" stroke-width="2" stroke-dasharray="6 6">
        <animate attributeName="stroke-dashoffset" values="0;12" dur="1.05s" repeatCount="indefinite"/>
      </line>
      <circle cx="700" cy="130" r="18" fill="white" stroke="#d1d5db" stroke-width="2"/>
      <text x="700" y="134" text-anchor="middle" class="label">Prabayar</text>
    </g>

    <!-- bottom-right -->
    <g>
      <line x1="450" y1="130" x2="660" y2="200" stroke="#94a3b8" stroke-width="2" stroke-dasharray="6 6">
        <animate attributeName="stroke-dashoffset" values="0;12" dur="1.5s" repeatCount="indefinite"/>
      </line>
      <circle cx="660" cy="200" r="18" fill="white" stroke="#d1d5db" stroke-width="2"/>
      <text x="660" y="204" text-anchor="middle" class="label">SMM</text>
    </g>

    <!-- orbiting packets (small dots circling the hub) -->
    <g>
      <circle r="3" fill="#00c2ff">
        <animateMotion dur="6s" repeatCount="indefinite" path="M450,130 m-50,0 a50,50 0 1,0 100,0 a50,50 0 1,0 -100,0"/>
      </circle>
      <circle r="3" fill="#7c3aed">
        <animateMotion dur="8s" repeatCount="indefinite" path="M450,130 m-70,0 a70,70 0 1,0 140,0 a70,70 0 1,0 -140,0"/>
      </circle>
      <circle r="3" fill="#2196f3">
        <animateMotion dur="10s" repeatCount="indefinite" path="M450,130 m-90,0 a90,90 0 1,0 180,0 a90,90 0 1,0 -180,0"/>
      </circle>
    </g>
  </svg>
</p>

---

## 🚀 NetFlazz = Pusat API Server Terbanyak
**Satu pusat integrasi untuk ribuan layanan digital.**  
Fokus kami adalah **kecepatan, keamanan, dan skala** — dari reseller hingga enterprise.

### ✨ Highlight
- 🏢 **Pusat API Terbesar** — koneksi luas lintas kategori layanan
- ⚡ **Performa Tinggi** — infrastruktur modern, latensi rendah
- 🔒 **Keamanan Berlapis** — validasi & kontrol akses
- 📡 **Status Realtime** — transparan dan terpantau
- 🤝 **Integrasi Luas** — fleksibel untuk Buyer & Seller

> 💡 *NetFlazz: Satu Pusat API, Ribuan Solusi.*

---

<p align="center">
  <sub>Branding-first README • Tanpa contoh penggunaan • Fokus positioning sebagai pusat API server terbanyak</sub>
</p>
