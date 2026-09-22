<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<?php $isEn = (service('request')->getLocale() === 'en'); ?>

<!-- Page Header Banner -->
<div class="bg-navy-950 text-white py-14 relative overflow-hidden border-b-2 border-gold-500">
    <div class="absolute inset-0 opacity-10 bg-pattern"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <nav class="flex items-center space-x-2 text-xs text-gold-400 mb-2 font-medium">
            <a href="<?= base_url() ?>" class="hover:underline flex items-center gap-1">
                <i class="fa-solid fa-house text-[10px]"></i> <?= lang('App.nav_home') ?>
            </a>
            <span>/</span>
            <span class="text-slate-300"><?= lang('App.nav_contact') ?></span>
        </nav>
        <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight text-white">
            <?= $isEn ? 'Contact & Research Partnership Inquiries' : 'Kontak & Pengajuan Kerjasama Riset' ?>
        </h1>
        <p class="text-slate-300 text-xs sm:text-sm mt-1 max-w-2xl">
            <?= $isEn 
                ? 'Reach the secretariat of the North Natuna Sea Research Center (NNSRC) UMRAH for collaborative research initiatives, oceanographic survey services, and marine policy advisory.' 
                : 'Hubungi sekretariat Pusat Studi Laut Natuna Utara (North Natuna Sea Research Center) UMRAH untuk diskusi inisiasi penelitian kolaboratif, permohonan jasa survei, dan konsultasi kebijakan.' ?>
        </p>
    </div>
</div>

<!-- Main Content -->
<div class="py-16 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <?php if (!empty($success)): ?>
        <div class="mb-8 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs sm:text-sm flex items-center gap-3">
            <i class="fa-solid fa-circle-check text-emerald-600 text-lg"></i>
            <span><?= esc($success) ?></span>
        </div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
        <div class="mb-8 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs sm:text-sm flex items-center gap-3">
            <i class="fa-solid fa-triangle-exclamation text-rose-600 text-lg"></i>
            <span><?= esc($error) ?></span>
        </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            
            <!-- Col 1: Information & Address -->
            <div class="lg:col-span-5 space-y-6">
                
                <div class="bg-white rounded-2xl p-7 border border-slate-200 shadow-xs space-y-6">
                    <div class="border-b border-slate-100 pb-4">
                        <span class="text-maritime-600 uppercase text-xs font-bold tracking-wider block"><?= $isEn ? 'Official Secretariat' : 'Sekretariat Resmi' ?></span>
                        <h3 class="text-lg font-bold text-navy-950 mt-1">Pusat Studi Laut Natuna Utara (NNSRC UMRAH)</h3>
                    </div>

                    <div class="space-y-4 text-xs sm:text-sm text-slate-600">
                        <?php 
                        $siteSettings = \App\Models\SiteSettingModel::getSettings();
                        $contactAddress = $isEn ? (!empty($siteSettings['address_en']) ? $siteSettings['address_en'] : 'LPPM UMRAH Building, 2nd Floor, Dompak Main Campus, Jl. Politeknik, Tanjungpinang City, Riau Islands 29111, Indonesia') : (!empty($siteSettings['address']) ? $siteSettings['address'] : 'Gedung LPPM UMRAH Lantai 2, Kampus Terpadu Dompak, Jl. Politeknik, Kota Tanjungpinang, Kepulauan Riau 29111');
                        $contactEmail = !empty($siteSettings['email']) ? $siteSettings['email'] : 'pusatstudilautnatunautara@umrah.ac.id';
                        $contactPhone = !empty($siteSettings['phone']) ? $siteSettings['phone'] : '(0771) 4500089 | WhatsApp: 0812-7000-8991';
                        $contactHours = $isEn 
                            ? 'Monday – Friday: ' . (!empty($siteSettings['hours_weekday']) ? $siteSettings['hours_weekday'] : '08:00 – 16:00 WIB') . ' (UTC+7)'
                            : 'Senin – Jumat: ' . (!empty($siteSettings['hours_weekday']) ? $siteSettings['hours_weekday'] : '08.00 – 16.00 WIB');
                        ?>
                        <div class="flex items-start gap-3">
                            <div class="w-9 h-9 rounded-lg bg-navy-900 text-gold-400 flex items-center justify-center flex-shrink-0 text-sm mt-0.5">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div>
                                <strong class="text-navy-900 block"><?= $isEn ? 'Office Address:' : 'Alamat Kantor:' ?></strong>
                                <span><?= esc($contactAddress) ?></span>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg bg-navy-900 text-gold-400 flex items-center justify-center flex-shrink-0 text-sm">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <div>
                                <strong class="text-navy-900 block"><?= $isEn ? 'Official Email:' : 'Email Resmi:' ?></strong>
                                <span><a href="mailto:<?= esc($contactEmail) ?>" class="hover:text-gold-600 transition-colors font-medium"><?= esc($contactEmail) ?></a></span>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg bg-navy-900 text-gold-400 flex items-center justify-center flex-shrink-0 text-sm">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <div>
                                <strong class="text-navy-900 block"><?= $isEn ? 'Phone / Contact Persons:' : 'Telepon / Narahubung:' ?></strong>
                                <span><?= esc($contactPhone) ?></span>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="w-9 h-9 rounded-lg bg-navy-900 text-gold-400 flex items-center justify-center flex-shrink-0 text-sm mt-0.5">
                                <i class="fa-solid fa-clock"></i>
                            </div>
                            <div>
                                <strong class="text-navy-900 block"><?= $isEn ? 'Service Hours:' : 'Waktu Layanan:' ?></strong>
                                <span><?= esc($contactHours) ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Campus Location Map Box Placeholder -->
                <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs space-y-3">
                    <h4 class="text-xs font-bold text-navy-950 uppercase tracking-wider flex items-center gap-2">
                        <i class="fa-solid fa-map text-maritime-600"></i> <?= $isEn ? 'UMRAH Dompak Campus Location' : 'Lokasi Kampus Dompak UMRAH' ?>
                    </h4>
                    <div class="h-44 rounded-xl bg-slate-100 border border-slate-200 flex flex-col items-center justify-center text-slate-400 text-xs p-4 text-center space-y-2">
                        <i class="fa-solid fa-location-crosshairs text-3xl text-maritime-600"></i>
                        <span class="font-medium text-slate-600"><?= $isEn ? 'Dompak Island, Tanjungpinang' : 'Pulau Dompak, Tanjungpinang' ?></span>
                        <a href="https://maps.google.com/?q=Universitas+Maritim+Raja+Ali+Haji+Dompak" target="_blank" class="text-maritime-600 underline font-semibold">
                            <?= $isEn ? 'Open in Google Maps →' : 'Buka di Google Maps →' ?>
                        </a>
                    </div>
                </div>

            </div>

            <!-- Col 2: Consultation & Collaboration Form -->
            <div class="lg:col-span-7" id="kerjasama">
                <div class="bg-white rounded-2xl p-7 sm:p-9 border border-slate-200 shadow-sm space-y-6">
                    <div>
                        <span class="text-gold-600 uppercase text-xs font-bold tracking-wider block"><?= $isEn ? 'Integrated Portal' : 'Formulir Terpadu' ?></span>
                        <h3 class="text-xl sm:text-2xl font-bold text-navy-950 mt-1"><?= $isEn ? 'Research Partnership & Consultation Inquiry' : 'Pengajuan Inisiasi Riset & Konsultasi' ?></h3>
                        <p class="text-xs sm:text-sm text-slate-600 mt-1"><?= $isEn ? 'Please fill in the form below. Our secretariat will respond within 1x24 business hours.' : 'Silakan lengkapi formulir berikut. Tim sekretariat akan menindaklanjuti dalam kurun 1x24 jam kerja.' ?></p>
                    </div>

                    <form action="<?= base_url('kontak/kirim') ?>" method="POST" class="space-y-4 text-xs sm:text-sm">
                        <?= csrf_field() ?>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="space-y-1.5">
                                <label class="block font-semibold text-slate-700"><?= $isEn ? 'Full Name & Degree' : 'Nama Lengkap & Gelar' ?> <span class="text-rose-500">*</span></label>
                                <input type="text" name="nama" value="<?= esc(old('nama')) ?>" required placeholder="<?= $isEn ? 'e.g., Dr. Ahmad Fauzi' : 'Contoh: Dr. Ahmad Fauzi' ?>" class="w-full px-3.5 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:border-maritime-600 text-xs sm:text-sm">
                            </div>
                            <div class="space-y-1.5">
                                <label class="block font-semibold text-slate-700"><?= $isEn ? 'Institution / Organization / Corporation' : 'Institusi / Lembaga / Perusahaan' ?> <span class="text-rose-500">*</span></label>
                                <input type="text" name="instansi" value="<?= esc(old('instansi')) ?>" required placeholder="<?= $isEn ? 'e.g., Marine Agency / Corporate Partner' : 'Contoh: Dinas Kelautan & Perikanan / PT XYZ' ?>" class="w-full px-3.5 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:border-maritime-600 text-xs sm:text-sm">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="space-y-1.5">
                                <label class="block font-semibold text-slate-700"><?= $isEn ? 'Official Email' : 'Email Resmi' ?> <span class="text-rose-500">*</span></label>
                                <input type="email" name="email" value="<?= esc(old('email')) ?>" required placeholder="name@agency.gov / name@corp.com" class="w-full px-3.5 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:border-maritime-600 text-xs sm:text-sm">
                            </div>
                            <div class="space-y-1.5">
                                <label class="block font-semibold text-slate-700"><?= $isEn ? 'Contact / WhatsApp Number' : 'Nomor Kontak / WhatsApp' ?> <span class="text-rose-500">*</span></label>
                                <input type="tel" name="telepon" value="<?= esc(old('telepon')) ?>" required placeholder="0812xxxxxxxx / +62812..." class="w-full px-3.5 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:border-maritime-600 text-xs sm:text-sm">
                            </div>
                        </div>

                        <div class="space-y-1.5">
                            <label class="block font-semibold text-slate-700"><?= $isEn ? 'Inquiry / Service Category' : 'Kategori Keperluan / Layanan' ?> <span class="text-rose-500">*</span></label>
                            <?php $selectedKat = old('kategori') ?: service('request')->getGet('layanan'); ?>
                            <select name="kategori" required class="w-full px-3.5 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:border-maritime-600 text-xs sm:text-sm bg-white text-slate-700">
                                <option value=""><?= $isEn ? '-- Select Service Category --' : '-- Pilih Kategori Layanan --' ?></option>
                                <option value="kerjasama" <?= $selectedKat === 'kerjasama' ? 'selected' : '' ?>><?= $isEn ? 'MoU / Joint Research Collaboration Agreement' : 'Inisiasi MoU / Perjanjian Kerjasama Riset' ?></option>
                                <option value="pelabuhan" <?= $selectedKat === 'pelabuhan' ? 'selected' : '' ?>><?= $isEn ? 'Port Engineering & Maritime Infrastructure Consultation' : 'Perancangan & Jasa Kepelabuhanan (DED Dermaga)' ?></option>
                                <option value="pemberdayaan" <?= $selectedKat === 'pemberdayaan' ? 'selected' : '' ?>><?= $isEn ? 'Border Community Empowerment & Maritime Potential Studies' : 'Pemberdayaan Masyarakat Perbatasan & Kajian Potensi' ?></option>
                                <option value="zonasi" <?= $selectedKat === 'zonasi' ? 'selected' : '' ?>><?= $isEn ? 'Marine Spatial Planning & Small Islands Development (RZWP-3-K)' : 'Pengembangan Tata Ruang Laut & Pulau-Pulau Kecil (RZWP-3-K)' ?></option>
                                <option value="lainnya" <?= $selectedKat === 'lainnya' ? 'selected' : '' ?>><?= $isEn ? 'General Inquiry / Others' : 'Pertanyaan Umum / Lainnya' ?></option>
                            </select>
                        </div>

                        <div class="space-y-1.5">
                            <label class="block font-semibold text-slate-700"><?= $isEn ? 'Brief Description of Request / Collaboration' : 'Uraian Ringkas Kebutuhan / Kerjasama' ?> <span class="text-rose-500">*</span></label>
                            <textarea name="pesan" rows="4" required placeholder="<?= $isEn ? 'Briefly describe your objectives, target marine area, and expected timeline...' : 'Jelaskan secara singkat latar belakang kebutuhan, lokasi perairan terkait, dan jadwal yang diharapkan...' ?>" class="w-full px-3.5 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:border-maritime-600 text-xs sm:text-sm"><?= esc(old('pesan')) ?></textarea>
                        </div>

                        <div class="pt-2">
                            <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-lg bg-navy-900 hover:bg-navy-950 text-gold-400 font-bold text-xs sm:text-sm shadow-md transition-all">
                                <i class="fa-solid fa-paper-plane"></i> <?= $isEn ? 'Submit Partnership Inquiry' : 'Kirim Pengajuan Kerjasama' ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>
</div>

<?= $this->endSection() ?>
