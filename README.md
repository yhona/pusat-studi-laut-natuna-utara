# Pusat Studi Laut Natuna Utara (North Natuna Sea Research Center)
### Universitas Maritim Raja Ali Haji (UMRAH)

Portal resmi Pusat Studi Laut Natuna Utara (*North Natuna Sea Research Center* / NNSRC) di bawah naungan Lembaga Penelitian dan Pengabdian kepada Masyarakat (LPPM) Universitas Maritim Raja Ali Haji (UMRAH), Tanjungpinang, Kepulauan Riau.

---

## 🌟 Fitur Utama

- **Profil Institusi & Bagan Organisasi Terverifikasi**: Struktur tata kelola eksekutif dan dewan pakar lintas fakultas (FIKP, FISIP, FTTK, FH).
- **4 Klaster Riset Strategis**:
  1. *Hukum Laut Internasional* (Koordinator: Rachma Indriyani, S.H., LL.M., Ph.D.)
  2. *Logistik dan Konektivitas Kepulauan* (Koordinator: Dr. Ady Muzwardi, S.IP., M.A., M.H.I.)
  3. *Ketahanan Digital Kepulauan* (Koordinator: Dedy Afrizal, S.Sos., M.Si., Ph.D.)
  4. *Energi Terbarukan di Wilayah Kepulauan* (Koordinator: Ahmad Rusdi, M.T.)
- **Bilingual Support (ID / EN)**: Dukungan multi-bahasa terintegrasi pada navigasi, deskripsi klaster, profil pimpinan, dan konten.
- **Kalkulator Survei Kemaritiman**: Alat estimasi kebutuhan survei hidro-oseanografi berbasis Alpine.js.
- **Pusat Unduhan & Repositori Dokumen**: Naskah kebijakan (*Policy Brief*), SOP pengujian, dan dokumen kerjasama.
- **Portal Berita & Publikasi Ilmiah**: Jurnal, proceeding terindeks, dan warta riset terkini.
- **Presentation Deck Interaktif**: Tersedia di `/presentation.html` untuk pemaparan institusional.

---

## 🛠️ Tech Stack

- **Backend**: [CodeIgniter 4](https://codeigniter.com/) (PHP 8.1+)
- **Database**: SQLite3 (`writable/database.sqlite`)
- **Frontend / Styling**: Tailwind CSS v3.4, Font Awesome 6.5
- **Interactivity Engine**: Alpine.js v3.13
- **Typography**: Plus Jakarta Sans

---

## 🚀 Cara Menjalankan

### Persyaratan Sistem
- PHP >= 8.1 dengan ekstensi `pdo_sqlite`, `sqlite3`, `intl`, `mbstring`, `curl`.
- Node.js & NPM (hanya jika ingin mengompilasi ulang styling Tailwind CSS).

### Menjalankan Server Lokal

#### Di macOS / Linux:
```bash
./jalankan_mac.sh
# Atau langsung menggunakan spark:
php spark serve --host 0.0.0.0 --port 8080
```

#### Di Windows:
Cukup klik dua kali berkas:
```cmd
jalankan_windows.bat
```

Buka browser dan kunjungi:
- **Web Portal**: [http://localhost:8080](http://localhost:8080)
- **Deck Presentasi**: [http://localhost:8080/presentation.html](http://localhost:8080/presentation.html)

---

## 🎨 Kompilasi Aset Frontend (Tailwind CSS)

Jika melakukan perubahan pada kelas utility CSS atau template Blade/PHP:
```bash
# Install dependencies frontend
npm install

# Build CSS minified untuk produksi
npm run build:css

# Watch mode saat pengembangan
npm run watch:css
```

---

## 📁 Struktur Direktori

```
├── app/
│   ├── Config/           # Konfigurasi aplikasi & database
│   ├── Controllers/      # Controller MVC (Home, Profil, Riset, Berita, Layanan, Unduhan, dll.)
│   ├── Database/         # Migrasi & Seeder SQLite
│   ├── Language/         # Paket lokalisasi bilingual (id/en)
│   ├── Models/           # Model data riset, berita, unduhan
│   └── Views/            # Template tampilan, layout, dan komponen
├── public/
│   ├── css/              # Output CSS Tailwind hasil kompilasi
│   ├── images/           # Aset gambar dokumentasi, logo, dan foto peneliti
│   ├── presentation.html # Slide presentasi interaktif
│   └── index.php         # Entry point web server
├── writable/
│   └── database.sqlite   # Database lokal SQLite siap pakai
├── jalankan_mac.sh       # Script shortcut start server (macOS/Linux)
├── jalankan_windows.bat  # Script shortcut start server (Windows)
└── tailwind.config.js    # Konfigurasi tema dan warna UMRAH
```

---

## 📄 Lisensi

Dikembangkan untuk Universitas Maritim Raja Ali Haji (UMRAH). Hak cipta dilindungi.
