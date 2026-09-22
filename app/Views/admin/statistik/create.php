<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6 max-w-3xl">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-extrabold text-navy-950">Tambah Statistik Capaian Riset</h2>
            <p class="text-xs text-slate-500 mt-1">Tambahkan metrik angka capaian riset, publikasi, atau kemitraan baru.</p>
        </div>
        <a href="<?= base_url('admin/statistik') ?>" 
           class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Daftar</span>
        </a>
    </div>

    <!-- Form -->
    <form action="<?= base_url('admin/statistik/store') ?>" method="POST" class="space-y-6">
        <?= csrf_field() ?>

        <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-xs space-y-5">
            <!-- Number & Icon -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Angka / Nilai Capaian <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="number" required placeholder="Contoh: 142+ atau 28"
                           value="<?= old('number') ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-2 focus:ring-maritime-500 focus:outline-none">
                    <span class="text-[10px] text-slate-400">Bisa menggunakan tanda plus (+) atau persentase (%).</span>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Ikon FontAwesome <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="icon" required placeholder="Contoh: fa-book-open-reader"
                           value="<?= old('icon', 'fa-chart-line') ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-2 focus:ring-maritime-500 focus:outline-none">
                    <span class="text-[10px] text-slate-400">Pilihan populer: fa-book-open-reader, fa-certificate, fa-handshake-angle, fa-anchor-circle-check, fa-microchip, fa-ship</span>
                </div>
            </div>

            <!-- Label ID -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">
                    Label Keterangan (Bahasa Indonesia) <span class="text-rose-500">*</span>
                </label>
                <input type="text" name="label" required placeholder="Contoh: Publikasi Scopus / SINTA Bereputasi"
                       value="<?= old('label') ?>"
                       class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-2 focus:ring-maritime-500 focus:outline-none">
            </div>

            <!-- Label EN -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">
                    Label Keterangan (Bahasa Inggris)
                </label>
                <input type="text" name="label_en" placeholder="Contoh: Reputable Scopus / SINTA Publications"
                       value="<?= old('label_en') ?>"
                       class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-2 focus:ring-maritime-500 focus:outline-none">
            </div>

            <!-- Order Sequence & Active -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-center pt-2">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Urutan Tampilan
                    </label>
                    <input type="number" name="order_seq" value="<?= old('order_seq', '1') ?>" min="0"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-2 focus:ring-maritime-500 focus:outline-none">
                </div>
                <div class="pt-5">
                    <label class="inline-flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" <?= old('is_active', '1') ? 'checked' : '' ?>
                               class="rounded text-maritime-600 focus:ring-maritime-500 w-4 h-4">
                        <span class="text-xs font-semibold text-slate-700">Aktifkan & Tampilkan di Beranda</span>
                    </label>
                </div>
            </div>

            <!-- Buttons -->
            <div class="pt-5 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="<?= base_url('admin/statistik') ?>" 
                   class="px-4 py-2.5 rounded-xl border border-slate-300 text-slate-700 hover:bg-slate-50 text-xs font-semibold transition-colors">
                    Batal
                </a>
                <button type="submit" 
                        class="px-5 py-2.5 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-950 text-xs font-bold shadow-sm transition-all active:scale-[0.98]">
                    <i class="fa-solid fa-save mr-1.5"></i> Simpan Statistik
                </button>
            </div>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
