<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6 max-w-4xl">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-extrabold text-navy-950">Tambah Fase Roadmap Riset</h2>
            <p class="text-xs text-slate-500 mt-1">Tambahkan periode atau tahapan baru ke peta jalan riset maritim.</p>
        </div>
        <a href="<?= base_url('admin/roadmap') ?>" 
           class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Daftar</span>
        </a>
    </div>

    <!-- Form -->
    <form action="<?= base_url('admin/roadmap/store') ?>" method="POST" class="space-y-6">
        <?= csrf_field() ?>

        <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-xs space-y-5">
            <!-- Phase Period & Status -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Periode / Tahun Fase <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="phase" required placeholder="Contoh: 2025 - 2026"
                           value="<?= old('phase') ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-2 focus:ring-maritime-500 focus:outline-none font-mono">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Status Milestone (ID) <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="status" required placeholder="Contoh: Sedang Berjalan"
                           value="<?= old('status', 'Sedang Berjalan') ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-2 focus:ring-maritime-500 focus:outline-none">
                    <span class="text-[10px] text-slate-400">Contoh: Sedang Berjalan, Rencana Strategis, dsb.</span>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Status Milestone (EN)
                    </label>
                    <input type="text" name="status_en" placeholder="Contoh: In Progress"
                           value="<?= old('status_en', 'In Progress') ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-2 focus:ring-maritime-500 focus:outline-none">
                    <span class="text-[10px] text-slate-400">Contoh: In Progress, Strategic Plan, dsb.</span>
                </div>
            </div>

            <!-- Title ID & EN -->
            <div class="space-y-4 pt-2">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Judul Fase (Bahasa Indonesia) <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="title" required placeholder="Contoh: Fase 1: Konsolidasi Baseline Data Oseanografi & Pemetaan Potensi"
                           value="<?= old('title') ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-2 focus:ring-maritime-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Judul Fase (Bahasa Inggris)
                    </label>
                    <input type="text" name="title_en" placeholder="Contoh: Phase 1: Oceanographic Baseline Data Consolidation & Resource Mapping"
                           value="<?= old('title_en') ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-2 focus:ring-maritime-500 focus:outline-none">
                </div>
            </div>

            <!-- Desc ID & EN -->
            <div class="space-y-4 pt-2">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Uraian Target & Capaian (Bahasa Indonesia) <span class="text-rose-500">*</span>
                    </label>
                    <textarea name="desc" rows="3" required placeholder="Uraikan fokus penelitian, output sains, dan implementasi pada fase ini..."
                              class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-2 focus:ring-maritime-500 focus:outline-none"><?= old('desc') ?></textarea>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Uraian Target & Capaian (Bahasa Inggris)
                    </label>
                    <textarea name="desc_en" rows="3" placeholder="Describe the research milestones, scientific outputs, and practical applications in this phase..."
                              class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-2 focus:ring-maritime-500 focus:outline-none"><?= old('desc_en') ?></textarea>
                </div>
            </div>

            <!-- Order Sequence & Active -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-center pt-2">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Urutan Fase (Order Sequence)
                    </label>
                    <input type="number" name="order_seq" value="<?= old('order_seq', '1') ?>" min="0"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-2 focus:ring-maritime-500 focus:outline-none">
                </div>
                <div class="pt-5">
                    <label class="inline-flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" <?= old('is_active', '1') ? 'checked' : '' ?>
                               class="rounded text-maritime-600 focus:ring-maritime-500 w-4 h-4">
                        <span class="text-xs font-semibold text-slate-700">Aktifkan & Tampilkan di Halaman Riset</span>
                    </label>
                </div>
            </div>

            <!-- Buttons -->
            <div class="pt-5 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="<?= base_url('admin/roadmap') ?>" 
                   class="px-4 py-2.5 rounded-xl border border-slate-300 text-slate-700 hover:bg-slate-50 text-xs font-semibold transition-colors">
                    Batal
                </a>
                <button type="submit" 
                        class="px-5 py-2.5 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-950 text-xs font-bold shadow-sm transition-all active:scale-[0.98]">
                    <i class="fa-solid fa-save mr-1.5"></i> Simpan Fase Roadmap
                </button>
            </div>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
