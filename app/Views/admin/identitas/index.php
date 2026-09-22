<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="max-w-4xl space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-extrabold text-navy-950">Pengaturan Identitas Situs & Kontak Institusi</h2>
            <p class="text-xs text-slate-500 mt-1">
                Kelola alamat sekretariat, kontak resmi, waktu operasional layanan, dan tautan media sosial yang tertera pada footer dan halaman kontak publik.
            </p>
        </div>
        <div class="flex items-center gap-2.5">
            <a href="<?= base_url('kontak') ?>" target="_blank"
               class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors shrink-0">
                <i class="fa-solid fa-arrow-up-right-from-square text-[11px]"></i>
                <span>Tinjau Halaman Kontak</span>
            </a>
        </div>
    </div>

    <!-- Form Card -->
    <form action="<?= base_url('admin/identitas/update') ?>" method="POST" class="space-y-6">
        <?= csrf_field() ?>

        <!-- 1. Alamat & Kontak Utama -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-xs p-6 sm:p-8 space-y-5">
            <div class="border-b border-slate-100 pb-3 flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-navy-900 text-gold-400 flex items-center justify-center text-xs">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                <div>
                    <h3 class="font-bold text-sm text-navy-950">Alamat Sekretariat & Kontak Resmi</h3>
                    <p class="text-[11px] text-slate-500">Informasi lokasi dan kanal komunikasi utama pusat studi</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <!-- Alamat ID -->
                <div class="space-y-2 sm:col-span-2">
                    <label for="address" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                        Alamat Kantor (Bahasa Indonesia) <span class="text-rose-500">*</span>
                    </label>
                    <textarea id="address" name="address" rows="2" required
                              class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs leading-relaxed focus:outline-none focus:ring-2 focus:ring-navy-900 focus:border-transparent"><?= old('address', $settings['address'] ?? '') ?></textarea>
                </div>

                <!-- Alamat EN -->
                <div class="space-y-2 sm:col-span-2">
                    <label for="address_en" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                        Alamat Kantor (English) <span class="text-rose-500">*</span>
                    </label>
                    <textarea id="address_en" name="address_en" rows="2" required
                              class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs leading-relaxed focus:outline-none focus:ring-2 focus:ring-navy-900 focus:border-transparent"><?= old('address_en', $settings['address_en'] ?? '') ?></textarea>
                </div>

                <!-- Email -->
                <div class="space-y-2">
                    <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                        Email Resmi <span class="text-rose-500">*</span>
                    </label>
                    <input type="email" id="email" name="email" value="<?= old('email', $settings['email'] ?? '') ?>" required
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-mono focus:outline-none focus:ring-2 focus:ring-navy-900 focus:border-transparent">
                </div>

                <!-- Phone / Whatsapp -->
                <div class="space-y-2">
                    <label for="phone" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                        Telepon & Narahubung <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" id="phone" name="phone" value="<?= old('phone', $settings['phone'] ?? '') ?>" required
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-navy-900 focus:border-transparent">
                </div>
            </div>
        </div>

        <!-- 2. Waktu & Jam Layanan Operasional -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-xs p-6 sm:p-8 space-y-5">
            <div class="border-b border-slate-100 pb-3 flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-navy-900 text-gold-400 flex items-center justify-center text-xs">
                    <i class="fa-solid fa-clock"></i>
                </div>
                <div>
                    <h3 class="font-bold text-sm text-navy-950">Jam Layanan Operasional Sekretariat</h3>
                    <p class="text-[11px] text-slate-500">Waktu pelayanan permohonan riset, konsultasi, dan persuratan</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <!-- Weekday -->
                <div class="space-y-2">
                    <label for="hours_weekday" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                        Senin – Kamis <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" id="hours_weekday" name="hours_weekday" value="<?= old('hours_weekday', $settings['hours_weekday'] ?? '') ?>" required
                           placeholder="08.00 – 16.00 WIB"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-navy-900 focus:border-transparent">
                </div>

                <!-- Friday -->
                <div class="space-y-2">
                    <label for="hours_friday" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                        Jumat <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" id="hours_friday" name="hours_friday" value="<?= old('hours_friday', $settings['hours_friday'] ?? '') ?>" required
                           placeholder="08.00 – 16.30 WIB"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-navy-900 focus:border-transparent">
                </div>

                <!-- Weekend -->
                <div class="space-y-2">
                    <label for="hours_weekend" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                        Sabtu & Minggu <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" id="hours_weekend" name="hours_weekend" value="<?= old('hours_weekend', $settings['hours_weekend'] ?? '') ?>" required
                           placeholder="Tutup / Closed"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-navy-900 focus:border-transparent">
                </div>
            </div>
        </div>

        <!-- 3. Tautan Media Sosial -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-xs p-6 sm:p-8 space-y-5">
            <div class="border-b border-slate-100 pb-3 flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-navy-900 text-gold-400 flex items-center justify-center text-xs">
                    <i class="fa-solid fa-share-nodes"></i>
                </div>
                <div>
                    <h3 class="font-bold text-sm text-navy-950">Tautan Media Sosial Resmi</h3>
                    <p class="text-[11px] text-slate-500">Ikon dan tautan menuju kanal media sosial resmi di footer situs</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <!-- YouTube -->
                <div class="space-y-2">
                    <label for="youtube_url" class="block text-xs font-bold uppercase tracking-wider text-slate-700 flex items-center gap-2">
                        <i class="fa-brands fa-youtube text-red-600"></i> YouTube URL
                    </label>
                    <input type="text" id="youtube_url" name="youtube_url" value="<?= old('youtube_url', $settings['youtube_url'] ?? '') ?>"
                           placeholder="https://youtube.com/@umrah"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-mono focus:outline-none focus:ring-2 focus:ring-navy-900 focus:border-transparent">
                </div>

                <!-- Instagram -->
                <div class="space-y-2">
                    <label for="instagram_url" class="block text-xs font-bold uppercase tracking-wider text-slate-700 flex items-center gap-2">
                        <i class="fa-brands fa-instagram text-pink-600"></i> Instagram URL
                    </label>
                    <input type="text" id="instagram_url" name="instagram_url" value="<?= old('instagram_url', $settings['instagram_url'] ?? '') ?>"
                           placeholder="https://instagram.com/umrah.ac.id"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-mono focus:outline-none focus:ring-2 focus:ring-navy-900 focus:border-transparent">
                </div>

                <!-- Twitter / X -->
                <div class="space-y-2">
                    <label for="twitter_url" class="block text-xs font-bold uppercase tracking-wider text-slate-700 flex items-center gap-2">
                        <i class="fa-brands fa-x-twitter text-slate-800"></i> X / Twitter URL
                    </label>
                    <input type="text" id="twitter_url" name="twitter_url" value="<?= old('twitter_url', $settings['twitter_url'] ?? '') ?>"
                           placeholder="https://x.com/umrah_official"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-mono focus:outline-none focus:ring-2 focus:ring-navy-900 focus:border-transparent">
                </div>

                <!-- LinkedIn -->
                <div class="space-y-2">
                    <label for="linkedin_url" class="block text-xs font-bold uppercase tracking-wider text-slate-700 flex items-center gap-2">
                        <i class="fa-brands fa-linkedin text-blue-700"></i> LinkedIn URL
                    </label>
                    <input type="text" id="linkedin_url" name="linkedin_url" value="<?= old('linkedin_url', $settings['linkedin_url'] ?? '') ?>"
                           placeholder="https://linkedin.com/school/umrah"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-mono focus:outline-none focus:ring-2 focus:ring-navy-900 focus:border-transparent">
                </div>
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="flex items-center justify-end gap-3">
            <button type="submit" 
                    class="px-6 py-2.5 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-950 text-xs font-bold shadow-sm transition-all active:scale-[0.98] cursor-pointer">
                <i class="fa-solid fa-floppy-disk mr-1.5"></i> Simpan Seluruh Pengaturan
            </button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
