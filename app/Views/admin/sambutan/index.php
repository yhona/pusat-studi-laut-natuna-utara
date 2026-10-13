<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6 max-w-4xl" x-data="{ currentTab: '<?= esc($activeTab ?? 'bskln') ?>' }">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-extrabold text-navy-950">Kelola Sambutan Pimpinan & Pejabat</h2>
            <p class="text-xs text-slate-500 mt-1">
                Atur foto, nama pimpinan, gelar, dan narasi sambutan resmi (Kepala BSKLN Kemlu RI & Koordinator Pusat Studi) yang tampil di beranda depan portal.
            </p>
        </div>
        <a href="<?= base_url() ?>#sambutan" target="_blank"
           class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors shrink-0">
            <i class="fa-solid fa-arrow-up-right-from-square text-[11px]"></i>
            <span>Lihat di Beranda</span>
        </a>
    </div>

    <!-- Tab Selector -->
    <div class="flex items-center gap-2 border-b border-slate-200 pb-3">
        <button type="button" @click="currentTab = 'bskln'"
                class="px-4 py-2.5 rounded-xl text-xs font-bold transition-all flex items-center gap-2 cursor-pointer"
                :class="currentTab === 'bskln' ? 'bg-navy-900 text-gold-400 shadow-sm' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200'">
            <i class="fa-solid fa-landmark"></i>
            <span>1. Kepala BSKLN Kemlu RI</span>
            <?php if (!empty($bskln['is_active'])): ?>
                <span class="w-2 h-2 rounded-full bg-emerald-500 ml-1" title="Aktif"></span>
            <?php endif; ?>
        </button>

        <button type="button" @click="currentTab = 'koordinator'"
                class="px-4 py-2.5 rounded-xl text-xs font-bold transition-all flex items-center gap-2 cursor-pointer"
                :class="currentTab === 'koordinator' ? 'bg-navy-900 text-gold-400 shadow-sm' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200'">
            <i class="fa-solid fa-compass"></i>
            <span>2. Koordinator Pusat Studi</span>
            <?php if (!empty($koordinator['is_active'])): ?>
                <span class="w-2 h-2 rounded-full bg-emerald-500 ml-1" title="Aktif"></span>
            <?php endif; ?>
        </button>
    </div>

    <!-- TAB 1: SAMBUTAN KEPALA BSKLN KEMLU RI -->
    <div x-show="currentTab === 'bskln'" x-cloak class="space-y-6">
        <form action="<?= base_url('admin/sambutan/update') ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
            <?= csrf_field() ?>
            <input type="hidden" name="id" value="<?= esc($bskln['id'] ?? '') ?>">

            <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-xs space-y-6">
                <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                    <div class="flex items-center gap-2.5 text-navy-900">
                        <div class="w-9 h-9 rounded-xl bg-gold-500/20 text-gold-600 flex items-center justify-center font-bold">
                            <i class="fa-solid fa-landmark"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-extrabold text-navy-950">Sambutan Kepala BSKLN Kementerian Luar Negeri RI</h3>
                            <p class="text-[11px] text-slate-500">Badan Strategi Kebijakan Luar Negeri - Mitra Strategis Pendirian Pusat Studi</p>
                        </div>
                    </div>
                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold <?= !empty($bskln['is_active']) ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-slate-100 text-slate-500' ?>">
                        <?= !empty($bskln['is_active']) ? 'Ditampilkan di Beranda' : 'Disembunyikan' ?>
                    </span>
                </div>

                <!-- Foto & Info Dasar -->
                <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-start pb-6 border-b border-slate-100">
                    <div class="md:col-span-4 flex flex-col items-center text-center">
                        <label class="block text-xs font-bold text-slate-700 mb-2">Foto Resmi Kepala BSKLN</label>
                        <div class="w-44 h-56 rounded-2xl overflow-hidden border-2 border-slate-200 shadow-md relative bg-slate-100">
                            <img src="<?= base_url(esc($bskln['image'] ?? 'images/kepala_bskln.jpg')) ?>" alt="<?= esc($bskln['name'] ?? 'Dr. Yayan G.H. Mulyana') ?>" class="w-full h-full object-cover object-top">
                        </div>
                        <div class="mt-3 w-full">
                            <input type="file" name="image" accept="image/jpeg,image/png,image/webp"
                                   class="text-xs text-slate-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-navy-900 file:text-gold-400 hover:file:bg-navy-800 cursor-pointer w-full">
                            <p class="text-[10px] text-slate-400 mt-1">JPG, PNG, atau WebP (Maks. 5MB)</p>
                        </div>
                    </div>

                    <div class="md:col-span-8 space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">
                                Nama Lengkap & Gelar Pejabat <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" name="name" required placeholder="Contoh: Dr. Yayan G.H. Mulyana"
                                   value="<?= old('name', $bskln['name'] ?? '') ?>"
                                   class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-2 focus:ring-maritime-500 focus:outline-none font-bold">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">
                                Jabatan / Instansi (Bahasa Indonesia) <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" name="title" required placeholder="Contoh: Kepala Badan Strategi Kebijakan Luar Negeri (BSKLN) Kementerian Luar Negeri RI"
                                   value="<?= old('title', $bskln['title'] ?? '') ?>"
                                   class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-2 focus:ring-maritime-500 focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">
                                Jabatan / Instansi (Bahasa Inggris)
                            </label>
                            <input type="text" name="title_en" placeholder="Contoh: Head of Foreign Policy Strategy Agency (BSKLN), Ministry of Foreign Affairs of Indonesia"
                                   value="<?= old('title_en', $bskln['title_en'] ?? '') ?>"
                                   class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-2 focus:ring-maritime-500 focus:outline-none">
                        </div>

                        <div class="pt-2">
                            <label class="inline-flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="is_active" value="1" <?= (!empty($bskln['is_active']) || !isset($bskln['is_active'])) ? 'checked' : '' ?>
                                       class="rounded text-maritime-600 focus:ring-maritime-500 w-4 h-4">
                                <span class="text-xs font-semibold text-slate-700">Tampilkan Tab Sambutan Ini di Beranda</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Judul Utama -->
                <div class="space-y-4">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-maritime-600">Judul Utama Sambutan</h4>
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Judul Utama (Bahasa Indonesia)</label>
                            <input type="text" name="heading" placeholder="Judul pokok pidato sambutan..."
                                   value="<?= old('heading', $bskln['heading'] ?? '') ?>"
                                   class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-2 focus:ring-maritime-500 focus:outline-none font-semibold">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Judul Utama (Bahasa Inggris)</label>
                            <input type="text" name="heading_en" placeholder="Main title in English..."
                                   value="<?= old('heading_en', $bskln['heading_en'] ?? '') ?>"
                                   class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-2 focus:ring-maritime-500 focus:outline-none">
                        </div>
                    </div>
                </div>

                <!-- Kutipan Highlight -->
                <div class="space-y-4 pt-4 border-t border-slate-100">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-maritime-600">Kutipan Kunci (Highlight Quote)</h4>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Kutipan Kunci (Bahasa Indonesia) <span class="text-rose-500">*</span></label>
                        <textarea name="quote" rows="3" required placeholder="Kutipan inti arahan pejabat..."
                                  class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-2 focus:ring-maritime-500 focus:outline-none italic"><?= old('quote', $bskln['quote'] ?? '') ?></textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Kutipan Kunci (Bahasa Inggris)</label>
                        <textarea name="quote_en" rows="3" placeholder="Key quote in English..."
                                  class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-2 focus:ring-maritime-500 focus:outline-none italic"><?= old('quote_en', $bskln['quote_en'] ?? '') ?></textarea>
                    </div>
                </div>

                <!-- Narasi Lengkap -->
                <div class="space-y-4 pt-4 border-t border-slate-100">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-maritime-600">Narasi Sambutan Lengkap</h4>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Narasi Sambutan (Bahasa Indonesia) <span class="text-rose-500">*</span></label>
                        <textarea name="content" rows="6" required placeholder="Paragraf lengkap sambutan..."
                                  class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-2 focus:ring-maritime-500 focus:outline-none leading-relaxed"><?= old('content', $bskln['content'] ?? '') ?></textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Narasi Sambutan (Bahasa Inggris)</label>
                        <textarea name="content_en" rows="6" placeholder="Full speech in English..."
                                  class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-2 focus:ring-maritime-500 focus:outline-none leading-relaxed"><?= old('content_en', $bskln['content_en'] ?? '') ?></textarea>
                    </div>
                </div>

                <!-- Tombol Simpan -->
                <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                    <button type="submit" 
                            class="px-6 py-2.5 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-950 text-xs font-bold shadow-sm transition-all active:scale-[0.98]">
                        <i class="fa-solid fa-save mr-1.5"></i> Simpan Sambutan Kepala BSKLN
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- TAB 2: SAMBUTAN KOORDINATOR PUSAT STUDI -->
    <div x-show="currentTab === 'koordinator'" x-cloak class="space-y-6">
        <form action="<?= base_url('admin/sambutan/update') ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
            <?= csrf_field() ?>
            <input type="hidden" name="id" value="<?= esc($koordinator['id'] ?? '') ?>">

            <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-xs space-y-6">
                <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                    <div class="flex items-center gap-2.5 text-navy-900">
                        <div class="w-9 h-9 rounded-xl bg-maritime-500/20 text-maritime-700 flex items-center justify-center font-bold">
                            <i class="fa-solid fa-compass"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-extrabold text-navy-950">Sambutan Koordinator Pusat Studi Laut Natuna Utara</h3>
                            <p class="text-[11px] text-slate-500">Pimpinan Pusat Studi Laut Natuna Utara (NNSRC) UMRAH</p>
                        </div>
                    </div>
                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold <?= !empty($koordinator['is_active']) ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-slate-100 text-slate-500' ?>">
                        <?= !empty($koordinator['is_active']) ? 'Ditampilkan di Beranda' : 'Disembunyikan' ?>
                    </span>
                </div>

                <!-- Foto & Info Dasar -->
                <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-start pb-6 border-b border-slate-100">
                    <div class="md:col-span-4 flex flex-col items-center text-center">
                        <label class="block text-xs font-bold text-slate-700 mb-2">Foto Resmi Koordinator</label>
                        <div class="w-44 h-56 rounded-2xl overflow-hidden border-2 border-slate-200 shadow-md relative bg-slate-100">
                            <img src="<?= base_url(esc($koordinator['image'] ?? 'images/kepala_pusat.jpg')) ?>" alt="<?= esc($koordinator['name'] ?? 'Dr. Atika Thahira, S.H., M.H.') ?>" class="w-full h-full object-cover object-top">
                        </div>
                        <div class="mt-3 w-full">
                            <input type="file" name="image" accept="image/jpeg,image/png,image/webp"
                                   class="text-xs text-slate-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-navy-900 file:text-gold-400 hover:file:bg-navy-800 cursor-pointer w-full">
                            <p class="text-[10px] text-slate-400 mt-1">JPG, PNG, atau WebP (Maks. 5MB)</p>
                        </div>
                    </div>

                    <div class="md:col-span-8 space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">
                                Nama Lengkap & Gelar Pimpinan <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" name="name" required placeholder="Contoh: Dr. Atika Thahira, S.H., M.H."
                                   value="<?= old('name', $koordinator['name'] ?? '') ?>"
                                   class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-2 focus:ring-maritime-500 focus:outline-none font-bold">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">
                                Jabatan / Amanah (Bahasa Indonesia) <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" name="title" required placeholder="Contoh: Koordinator Pusat Studi Laut Natuna Utara UMRAH"
                                   value="<?= old('title', $koordinator['title'] ?? '') ?>"
                                   class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-2 focus:ring-maritime-500 focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">
                                Jabatan / Amanah (Bahasa Inggris)
                            </label>
                            <input type="text" name="title_en" placeholder="Contoh: Center Coordinator of North Natuna Sea Research Center UMRAH"
                                   value="<?= old('title_en', $koordinator['title_en'] ?? '') ?>"
                                   class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-2 focus:ring-maritime-500 focus:outline-none">
                        </div>

                        <div class="pt-2">
                            <label class="inline-flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="is_active" value="1" <?= (!empty($koordinator['is_active']) || !isset($koordinator['is_active'])) ? 'checked' : '' ?>
                                       class="rounded text-maritime-600 focus:ring-maritime-500 w-4 h-4">
                                <span class="text-xs font-semibold text-slate-700">Tampilkan Tab Sambutan Ini di Beranda</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Judul Utama -->
                <div class="space-y-4">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-maritime-600">Judul Utama Sambutan</h4>
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Judul Utama (Bahasa Indonesia)</label>
                            <input type="text" name="heading" placeholder="Judul pokok pidato sambutan..."
                                   value="<?= old('heading', $koordinator['heading'] ?? '') ?>"
                                   class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-2 focus:ring-maritime-500 focus:outline-none font-semibold">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Judul Utama (Bahasa Inggris)</label>
                            <input type="text" name="heading_en" placeholder="Main title in English..."
                                   value="<?= old('heading_en', $koordinator['heading_en'] ?? '') ?>"
                                   class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-2 focus:ring-maritime-500 focus:outline-none">
                        </div>
                    </div>
                </div>

                <!-- Kutipan Highlight -->
                <div class="space-y-4 pt-4 border-t border-slate-100">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-maritime-600">Kutipan Kunci (Highlight Quote)</h4>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Kutipan Kunci (Bahasa Indonesia) <span class="text-rose-500">*</span></label>
                        <textarea name="quote" rows="3" required placeholder="Kutipan visi strategis koordinator..."
                                  class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-2 focus:ring-maritime-500 focus:outline-none italic"><?= old('quote', $koordinator['quote'] ?? '') ?></textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Kutipan Kunci (Bahasa Inggris)</label>
                        <textarea name="quote_en" rows="3" placeholder="Key quote in English..."
                                  class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-2 focus:ring-maritime-500 focus:outline-none italic"><?= old('quote_en', $koordinator['quote_en'] ?? '') ?></textarea>
                    </div>
                </div>

                <!-- Narasi Lengkap -->
                <div class="space-y-4 pt-4 border-t border-slate-100">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-maritime-600">Narasi Sambutan Lengkap</h4>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Narasi Sambutan (Bahasa Indonesia) <span class="text-rose-500">*</span></label>
                        <textarea name="content" rows="6" required placeholder="Paragraf lengkap sambutan..."
                                  class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-2 focus:ring-maritime-500 focus:outline-none leading-relaxed"><?= old('content', $koordinator['content'] ?? '') ?></textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Narasi Sambutan (Bahasa Inggris)</label>
                        <textarea name="content_en" rows="6" placeholder="Full speech in English..."
                                  class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-2 focus:ring-maritime-500 focus:outline-none leading-relaxed"><?= old('content_en', $koordinator['content_en'] ?? '') ?></textarea>
                    </div>
                </div>

                <!-- Tombol Simpan -->
                <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                    <button type="submit" 
                            class="px-6 py-2.5 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-950 text-xs font-bold shadow-sm transition-all active:scale-[0.98]">
                        <i class="fa-solid fa-save mr-1.5"></i> Simpan Sambutan Koordinator
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
