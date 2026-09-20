<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6 max-w-4xl">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <a href="<?= base_url('admin/klaster') ?>" class="text-xs text-slate-500 hover:text-navy-950 font-semibold inline-flex items-center gap-1 mb-2">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Klaster
            </a>
            <h2 class="text-xl font-extrabold text-navy-950">Edit Klaster: <?= esc($klaster['short_title'] ?? $klaster['title']) ?></h2>
            <p class="text-xs text-slate-500 mt-0.5">ID Slug: <code class="bg-slate-100 px-2 py-0.5 rounded text-[11px] font-mono"><?= esc($klaster['slug']) ?></code></p>
        </div>
    </div>

    <!-- Edit Form -->
    <form action="<?= base_url('admin/klaster/update/' . $klaster['id']) ?>" method="POST" class="space-y-6">
        <?= csrf_field() ?>

        <!-- Basic Cluster Meta -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs space-y-4">
            <h3 class="text-sm font-bold text-navy-950 border-b border-slate-100 pb-2">Informasi Umum Klaster</h3>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Judul Singkat <span class="text-rose-500">*</span></label>
                    <input type="text" name="short_title" value="<?= esc($klaster['short_title'] ?? '') ?>" required
                           class="w-full text-xs rounded-xl border border-slate-300 focus:border-maritime-500 focus:ring-1 focus:ring-maritime-500 p-2.5">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Badge Kategori <span class="text-rose-500">*</span></label>
                    <input type="text" name="badge" value="<?= esc($klaster['badge'] ?? '') ?>" required
                           class="w-full text-xs rounded-xl border border-slate-300 focus:border-maritime-500 focus:ring-1 focus:ring-maritime-500 p-2.5">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Judul Lengkap Klaster <span class="text-rose-500">*</span></label>
                <input type="text" name="title" value="<?= esc($klaster['title'] ?? '') ?>" required
                       class="w-full text-xs rounded-xl border border-slate-300 focus:border-maritime-500 focus:ring-1 focus:ring-maritime-500 p-2.5">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Ikon FontAwesome (Class) <span class="text-rose-500">*</span></label>
                <div class="flex items-center gap-3">
                    <span class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-base text-navy-950 shrink-0">
                        <i class="<?= esc($klaster['icon'] ?? 'fa-solid fa-anchor') ?>"></i>
                    </span>
                    <input type="text" name="icon" value="<?= esc($klaster['icon'] ?? '') ?>" required
                           class="w-full text-xs rounded-xl border border-slate-300 focus:border-maritime-500 focus:ring-1 focus:ring-maritime-500 p-2.5 font-mono">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Mandat & Deskripsi Strategis <span class="text-rose-500">*</span></label>
                <textarea name="mandate" rows="4" required
                          class="w-full text-xs rounded-xl border border-slate-300 focus:border-maritime-500 focus:ring-1 focus:ring-maritime-500 p-3 leading-relaxed"><?= esc($klaster['mandate'] ?? '') ?></textarea>
            </div>
        </div>

        <!-- Coordinator Meta -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs space-y-4">
            <h3 class="text-sm font-bold text-navy-950 border-b border-slate-100 pb-2">Koordinator Klaster Riset</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap & Gelar <span class="text-rose-500">*</span></label>
                    <input type="text" name="coordinator_name" value="<?= esc($klaster['coordinator']['name'] ?? '') ?>" required
                           class="w-full text-xs rounded-xl border border-slate-300 focus:border-maritime-500 focus:ring-1 focus:ring-maritime-500 p-2.5">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Jabatan / Peran <span class="text-rose-500">*</span></label>
                    <input type="text" name="coordinator_role" value="<?= esc($klaster['coordinator']['role'] ?? '') ?>" required
                           class="w-full text-xs rounded-xl border border-slate-300 focus:border-maritime-500 focus:ring-1 focus:ring-maritime-500 p-2.5">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">NIP</label>
                    <input type="text" name="coordinator_nip" value="<?= esc($klaster['coordinator']['nip'] ?? '') ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 focus:border-maritime-500 focus:ring-1 focus:ring-maritime-500 p-2.5 font-mono">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Scopus / SINTA ID</label>
                    <input type="text" name="coordinator_scopus" value="<?= esc($klaster['coordinator']['scopus'] ?? '') ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 focus:border-maritime-500 focus:ring-1 focus:ring-maritime-500 p-2.5 font-mono">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Email Koordinator</label>
                    <input type="email" name="coordinator_email" value="<?= esc($klaster['coordinator']['email'] ?? '') ?>"
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
                <?php 
                    $focusString = is_array($klaster['focus_areas']) ? implode("\n", $klaster['focus_areas']) : '';
                ?>
                <textarea name="focus_areas" rows="4"
                          class="w-full text-xs rounded-xl border border-slate-300 focus:border-maritime-500 focus:ring-1 focus:ring-maritime-500 p-3 font-mono leading-relaxed"><?= esc($focusString) ?></textarea>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">
                    Proyek Unggulan / Riset Berjalan (Satu judul per baris)
                </label>
                <?php 
                    $projectTitles = [];
                    if (is_array($klaster['flagship_projects'])) {
                        foreach ($klaster['flagship_projects'] as $p) {
                            $projectTitles[] = is_array($p) ? ($p['title'] ?? '') : $p;
                        }
                    }
                    $projectString = implode("\n", array_filter($projectTitles));
                ?>
                <textarea name="flagship_projects" rows="4"
                          class="w-full text-xs rounded-xl border border-slate-300 focus:border-maritime-500 focus:ring-1 focus:ring-maritime-500 p-3 font-mono leading-relaxed"><?= esc($projectString) ?></textarea>
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
                <i class="fa-solid fa-floppy-disk"></i>
                <span>Simpan Perubahan Klaster</span>
            </button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
