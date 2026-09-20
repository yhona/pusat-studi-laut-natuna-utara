<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6 max-w-4xl">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <a href="<?= base_url('admin/klaster') ?>" class="text-xs text-slate-500 hover:text-navy-950 font-semibold inline-flex items-center gap-1 mb-2">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Klaster
            </a>
            <h2 class="text-xl font-extrabold text-navy-950">Tambah Klaster Riset Baru</h2>
            <p class="text-xs text-slate-500 mt-0.5">Daftarkan klaster riset kemaritiman baru yang akan tampil di peta jalan (roadmap) riset publik.</p>
        </div>
    </div>

    <!-- Create Form -->
    <form action="<?= base_url('admin/klaster/store') ?>" method="POST" class="space-y-6">
        <?= csrf_field() ?>

        <!-- Basic Cluster Meta -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs space-y-4">
            <h3 class="text-sm font-bold text-navy-950 border-b border-slate-100 pb-2">Informasi Umum Klaster</h3>
            
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Judul Singkat <span class="text-rose-500">*</span></label>
                    <input type="text" name="short_title" value="<?= old('short_title') ?>" required
                           placeholder="Contoh: Bioteknologi Maritim"
                           class="w-full text-xs rounded-xl border border-slate-300 focus:border-maritime-500 focus:ring-1 focus:ring-maritime-500 p-2.5">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Badge Kategori <span class="text-rose-500">*</span></label>
                    <input type="text" name="badge" value="<?= old('badge', 'Klaster V') ?>" required
                           placeholder="Contoh: Klaster V"
                           class="w-full text-xs rounded-xl border border-slate-300 focus:border-maritime-500 focus:ring-1 focus:ring-maritime-500 p-2.5">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Kustom Slug URL (Opsional)</label>
                    <input type="text" name="slug" value="<?= old('slug') ?>"
                           placeholder="bioteknologi-maritim"
                           class="w-full text-xs rounded-xl border border-slate-300 focus:border-maritime-500 focus:ring-1 focus:ring-maritime-500 p-2.5 font-mono">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Judul Lengkap Klaster <span class="text-rose-500">*</span></label>
                <input type="text" name="title" value="<?= old('title') ?>" required
                       placeholder="Contoh: Bioteknologi Kelautan & Konservasi Pesisir Tropis"
                       class="w-full text-xs rounded-xl border border-slate-300 focus:border-maritime-500 focus:ring-1 focus:ring-maritime-500 p-2.5">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Judul Bahasa Inggris (EN)</label>
                <input type="text" name="title_en" value="<?= old('title_en') ?>"
                       placeholder="Marine Biotechnology & Tropical Coastal Conservation"
                       class="w-full text-xs rounded-xl border border-slate-300 focus:border-maritime-500 focus:ring-1 focus:ring-maritime-500 p-2.5">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Ikon FontAwesome (Class) <span class="text-rose-500">*</span></label>
                <div class="flex items-center gap-3">
                    <span class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-base text-navy-950 shrink-0">
                        <i class="fa-solid fa-anchor"></i>
                    </span>
                    <input type="text" name="icon" value="<?= old('icon', 'fa-solid fa-dna') ?>" required
                           class="w-full text-xs rounded-xl border border-slate-300 focus:border-maritime-500 focus:ring-1 focus:ring-maritime-500 p-2.5 font-mono">
                </div>
                <span class="text-[10px] text-slate-400 mt-1 block">Contoh: <code>fa-solid fa-water</code>, <code>fa-solid fa-ship</code>, <code>fa-solid fa-dna</code>, <code>fa-solid fa-microchip</code></span>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Mandat & Deskripsi Strategis <span class="text-rose-500">*</span></label>
                <textarea name="mandate" rows="4" required
                          placeholder="Jelaskan mandat saintifik, urgensi riset di Natuna, dan fokus advokasi kebijakan..."
                          class="w-full text-xs rounded-xl border border-slate-300 focus:border-maritime-500 focus:ring-1 focus:ring-maritime-500 p-3 leading-relaxed"><?= old('mandate') ?></textarea>
            </div>
        </div>

        <!-- Coordinator Meta -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs space-y-4">
            <h3 class="text-sm font-bold text-navy-950 border-b border-slate-100 pb-2">Koordinator Klaster Riset</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap & Gelar <span class="text-rose-500">*</span></label>
                    <input type="text" name="coordinator_name" value="<?= old('coordinator_name') ?>" required
                           placeholder="Contoh: Dr. Nama Peneliti, M.Si."
                           class="w-full text-xs rounded-xl border border-slate-300 focus:border-maritime-500 focus:ring-1 focus:ring-maritime-500 p-2.5">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Jabatan / Peran <span class="text-rose-500">*</span></label>
                    <input type="text" name="coordinator_role" value="<?= old('coordinator_role', 'Koordinator Klaster Riset') ?>" required
                           class="w-full text-xs rounded-xl border border-slate-300 focus:border-maritime-500 focus:ring-1 focus:ring-maritime-500 p-2.5">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">NIP</label>
                    <input type="text" name="coordinator_nip" value="<?= old('coordinator_nip') ?>"
                           placeholder="19800101..."
                           class="w-full text-xs rounded-xl border border-slate-300 focus:border-maritime-500 focus:ring-1 focus:ring-maritime-500 p-2.5 font-mono">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Scopus / SINTA ID</label>
                    <input type="text" name="coordinator_scopus" value="<?= old('coordinator_scopus') ?>"
                           placeholder="Scopus ID: 581..."
                           class="w-full text-xs rounded-xl border border-slate-300 focus:border-maritime-500 focus:ring-1 focus:ring-maritime-500 p-2.5 font-mono">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Email Koordinator</label>
                    <input type="email" name="coordinator_email" value="<?= old('coordinator_email') ?>"
                           placeholder="peneliti@umrah.ac.id"
                           class="w-full text-xs rounded-xl border border-slate-300 focus:border-maritime-500 focus:ring-1 focus:ring-maritime-500 p-2.5">
                </div>
            </div>
        </div>

        <!-- Focus Areas & Flagship Projects -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs space-y-4">
            <h3 class="text-sm font-bold text-navy-950 border-b border-slate-100 pb-2">Fokus Riset & Proyek Unggulan</h3>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">
                    Area Fokus Riset (Satu item per baris)
                </label>
                <textarea name="focus_areas" rows="4"
                          placeholder="Eksplorasi potensi senyawa bioaktif spons laut&#10;Kajian mangrove blue carbon kepulauan&#10;Pengembangan pakan ramah lingkungan"
                          class="w-full text-xs rounded-xl border border-slate-300 focus:border-maritime-500 focus:ring-1 focus:ring-maritime-500 p-3 leading-relaxed"><?= old('focus_areas') ?></textarea>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">
                    Proyek Unggulan / Riset Berjalan (Satu judul per baris)
                </label>
                <textarea name="flagship_projects" rows="4"
                          placeholder="Inisiasi Pemetaan Biota Laut Perbatasan Natuna 2026&#10;Riset Konservasi Terumbu Karang Gugus Pulau Anambas"
                          class="w-full text-xs rounded-xl border border-slate-300 focus:border-maritime-500 focus:ring-1 focus:ring-maritime-500 p-3 leading-relaxed"><?= old('flagship_projects') ?></textarea>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-end gap-3">
            <a href="<?= base_url('admin/klaster') ?>" 
               class="px-5 py-2.5 rounded-xl border border-slate-200 hover:bg-slate-100 text-slate-600 font-bold text-xs transition-colors">
                Batal
            </a>
            <button type="submit"
                    class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-950 font-bold text-xs shadow-md transition-all active:scale-[0.98] cursor-pointer">
                <i class="fa-solid fa-plus"></i>
                <span>Simpan Klaster Baru</span>
            </button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
