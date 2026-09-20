<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6 max-w-3xl">
    
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-navy-950">Tambah Dokumen Repositori Baru</h2>
            <p class="text-xs text-slate-500 mt-0.5">Unggah berkas SOP, format template, atau panduan penelitian resmi</p>
        </div>
        <a href="<?= base_url('admin/unduhan') ?>" class="text-xs text-slate-500 hover:text-navy-950 font-semibold">
            &larr; Kembali ke Daftar
        </a>
    </div>

    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-xs">
        <form action="<?= base_url('admin/unduhan/store') ?>" method="POST" class="space-y-5">
            <?= csrf_field() ?>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="space-y-1">
                    <label for="code" class="block text-xs font-bold text-slate-700">Kode Dokumen *</label>
                    <input type="text" id="code" name="code" required value="<?= old('code') ?>"
                           placeholder="Contoh: SOP-LPS-05"
                           class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-maritime-600 focus:border-transparent bg-white">
                </div>

                <div class="space-y-1 sm:col-span-2">
                    <label for="category_id" class="block text-xs font-bold text-slate-700">Kategori Dokumen *</label>
                    <select id="category_id" name="category_id" required class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-maritime-600 focus:border-transparent bg-white">
                        <option value="sop">SOP Laboratorium / Oseanografi</option>
                        <option value="policy-brief">Policy Brief Kemaritiman</option>
                        <option value="template">Template Dokumen Kerjasama / MoU</option>
                        <option value="panduan">Panduan Riset & Keselamatan Lapangan</option>
                    </select>
                </div>
            </div>

            <div class="space-y-1.5">
                <label for="title" class="block text-xs font-bold text-slate-700">Judul Dokumen Lengkap *</label>
                <input type="text" id="title" name="title" required value="<?= old('title') ?>"
                       placeholder="Contoh: Standar Operasional Prosedur Pengambilan Sampel Sedimen Laut Dangkal"
                       class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-maritime-600 focus:border-transparent bg-white">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="space-y-1">
                    <label for="file_type" class="block text-xs font-bold text-slate-700">Format Berkas *</label>
                    <select id="file_type" name="file_type" required class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-maritime-600 focus:border-transparent bg-white">
                        <option value="PDF">PDF</option>
                        <option value="DOCX">DOCX</option>
                    </select>
                </div>

                <div class="space-y-1">
                    <label for="file_size" class="block text-xs font-bold text-slate-700">Ukuran Berkas *</label>
                    <input type="text" id="file_size" name="file_size" required value="<?= old('file_size', '2.8 MB') ?>"
                           placeholder="Contoh: 3.2 MB"
                           class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-maritime-600 focus:border-transparent bg-white">
                </div>

                <div class="space-y-1">
                    <label for="year" class="block text-xs font-bold text-slate-700">Tahun *</label>
                    <input type="text" id="year" name="year" required value="<?= old('year', date('Y')) ?>"
                           placeholder="Contoh: 2026"
                           class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-maritime-600 focus:border-transparent bg-white">
                </div>
            </div>

            <div class="space-y-1.5">
                <label for="desc" class="block text-xs font-bold text-slate-700">Deskripsi / Ruang Lingkup Dokumen *</label>
                <textarea id="desc" name="desc" required rows="3"
                          placeholder="Penjelasan ringkas isi dan peruntukan dokumen ini..."
                          class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-maritime-600 focus:border-transparent bg-white"><?= old('desc') ?></textarea>
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="<?= base_url('admin/unduhan') ?>" class="px-4 py-2.5 text-xs font-semibold text-slate-600 hover:bg-slate-100 rounded-xl transition-colors">
                    Batal
                </a>
                <button type="submit" 
                        class="px-5 py-2.5 bg-navy-950 hover:bg-maritime-700 text-gold-400 hover:text-white rounded-xl font-bold text-xs shadow-md transition-all active:scale-[0.98] cursor-pointer flex items-center gap-2">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                    <span>Simpan Dokumen</span>
                </button>
            </div>
        </form>
    </div>

</div>

<?= $this->endSection() ?>
