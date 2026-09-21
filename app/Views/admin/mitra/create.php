<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6 max-w-3xl">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-extrabold text-navy-950">Tambah Mitra Kerjasama Baru</h2>
            <p class="text-xs text-slate-500 mt-1">Daftarkan logo dan profil instansi mitra strategis.</p>
        </div>
        <a href="<?= base_url('admin/mitra') ?>" 
           class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Daftar</span>
        </a>
    </div>

    <!-- Form -->
    <form action="<?= base_url('admin/mitra/store') ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
        <?= csrf_field() ?>

        <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-xs space-y-5">
            <!-- Name & Short Name -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Nama Lengkap Lembaga / Mitra <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="name" required placeholder="Contoh: Badan Keamanan Laut Republik Indonesia"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Singkatan / Akronim
                    </label>
                    <input type="text" name="short_name" placeholder="Contoh: BAKAMLA RI"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5">
                </div>
            </div>

            <!-- Category & Website -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Kategori Mitra <span class="text-rose-500">*</span>
                    </label>
                    <select name="category" required class="w-full text-xs rounded-xl border border-slate-300 p-2.5 bg-white">
                        <option value="pemerintah">Pemerintah & Kementerian</option>
                        <option value="lembaga_riset">Lembaga Riset Nasional</option>
                        <option value="universitas">Universitas & Perguruan Tinggi</option>
                        <option value="internasional">Organisasi / Lembaga Internasional</option>
                        <option value="industri">Industri & Badan Usaha Maritim</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Tautan Website Resmi
                    </label>
                    <input type="url" name="website_url" placeholder="https://example.go.id"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5 font-mono">
                </div>
            </div>

            <!-- Logo Selection / Upload -->
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80 space-y-3">
                <span class="text-xs font-bold text-navy-950 block">Logo Mitra</span>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-600 mb-1">Pilih dari Preset Logo Mitra</label>
                        <select name="logo_preset" class="w-full text-xs rounded-xl border border-slate-300 p-2.5 bg-white">
                            <option value="images/partners/logo_brin.svg">BRIN (logo_brin.svg)</option>
                            <option value="images/partners/logo_bakamla.svg">BAKAMLA RI (logo_bakamla.svg)</option>
                            <option value="images/partners/logo_kkp.svg">KKP RI (logo_kkp.svg)</option>
                            <option value="images/partners/logo_kepri.svg">Pemprov Kepri (logo_kepri.svg)</option>
                            <option value="images/partners/logo_pushidrosal.svg">Pushidrosal (logo_pushidrosal.svg)</option>
                            <option value="images/partners/logo_umt.svg">UMT Malaysia (logo_umt.svg)</option>
                            <option value="images/partners/logo_bappenas.svg">Bappenas RI (logo_bappenas.svg)</option>
                            <option value="images/partners/logo_big.svg">BIG (logo_big.svg)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-600 mb-1">Atau Unggah File Logo (SVG/PNG)</label>
                        <input type="file" name="logo" accept="image/*,.svg" class="w-full text-xs file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-navy-900 file:text-gold-400 hover:file:bg-navy-800">
                    </div>
                </div>
            </div>

            <!-- Order & Status -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-center pt-2">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Nomor Urutan Tampilan</label>
                    <input type="number" name="order_seq" value="1" min="1" max="99" class="w-32 text-xs rounded-xl border border-slate-300 p-2.5">
                </div>
                <div class="flex items-center gap-2 pt-5">
                    <input type="checkbox" name="is_active" id="is_active" value="1" checked class="rounded border-slate-300 text-maritime-600 focus:ring-maritime-500">
                    <label for="is_active" class="text-xs font-semibold text-slate-700">Tampilkan di Beranda Publik</label>
                </div>
            </div>

            <!-- Submit -->
            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="<?= base_url('admin/mitra') ?>" class="px-4 py-2.5 rounded-xl border border-slate-300 text-slate-700 text-xs font-semibold hover:bg-slate-50 transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-950 text-xs font-bold shadow-md transition-all active:scale-[0.98]">
                    <i class="fa-solid fa-save mr-1.5"></i> Simpan Mitra
                </button>
            </div>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
