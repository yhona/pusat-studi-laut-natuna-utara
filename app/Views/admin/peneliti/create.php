<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6 max-w-4xl">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-extrabold text-navy-950">Tambah Peneliti / Pakar Baru</h2>
            <p class="text-xs text-slate-500 mt-1">Daftarkan pimpinan departemen atau anggota dewan peneliti baru.</p>
        </div>
        <a href="<?= base_url('admin/peneliti') ?>" 
           class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Daftar</span>
        </a>
    </div>

    <!-- Form -->
    <form action="<?= base_url('admin/peneliti/store') ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
        <?= csrf_field() ?>

        <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-xs space-y-5">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Kategori Keanggotaan <span class="text-rose-500">*</span>
                    </label>
                    <select name="category" required class="w-full text-xs rounded-xl border border-slate-300 p-2.5 bg-white focus:ring-1 focus:ring-maritime-500">
                        <option value="dewan_peneliti" selected>Dewan Peneliti (Research Fellow)</option>
                        <option value="pimpinan">Pimpinan Eksekutif Lembaga</option>
                        <option value="eksternal">Mitra Riset Eksternal</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Urutan Tampilan (Sort Order)
                    </label>
                    <input type="number" name="order_num" value="0"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">
                    Nama Lengkap & Gelar Akademis <span class="text-rose-500">*</span>
                </label>
                <input type="text" name="name" required placeholder="Contoh: Dr. Atika Thahira, S.H., M.H."
                       class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-1 focus:ring-maritime-500">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Jabatan / Role (Indonesia) <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="role" required placeholder="Contoh: Koordinator Pusat Studi"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Jabatan / Role (Inggris)
                    </label>
                    <input type="text" name="role_en" placeholder="Contoh: Center Coordinator"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Fakultas / Asal Lembaga (Indonesia)
                    </label>
                    <input type="text" name="faculty" placeholder="Contoh: Fakultas Hukum (FH) UMRAH"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Fakultas / Asal Lembaga (Inggris)
                    </label>
                    <input type="text" name="faculty_en" placeholder="Contoh: Faculty of Law UMRAH"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Fokus Bidang Keahlian (Indonesia) <span class="text-rose-500">*</span>
                    </label>
                    <textarea name="focus" rows="3" required placeholder="Bidang riset spesifik..."
                              class="w-full text-xs rounded-xl border border-slate-300 p-2.5"></textarea>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Fokus Bidang Keahlian (Inggris)
                    </label>
                    <textarea name="focus_en" rows="3" placeholder="Research focus in English..."
                              class="w-full text-xs rounded-xl border border-slate-300 p-2.5"></textarea>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Klaster Riset Terkait
                    </label>
                    <input type="text" name="cluster" placeholder="Contoh: Hukum Laut Internasional"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Nomor Induk Pegawai (NIP)
                    </label>
                    <input type="text" name="nip" placeholder="19820714..."
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5 font-mono">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Scopus ID / SINTA ID
                    </label>
                    <input type="text" name="scopus" placeholder="Scopus ID: 58164669100"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5 font-mono">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Email Resmi Institusi <span class="text-rose-500">*</span>
                    </label>
                    <input type="email" name="email" required placeholder="nama@umrah.ac.id"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5 font-mono">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Foto Profil (JPG/PNG max 2MB)
                    </label>
                    <input type="file" name="image" accept="image/*"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2 bg-slate-50">
                </div>
            </div>

            <div class="pt-2 flex items-center gap-2">
                <input type="checkbox" name="is_active" id="is_active" value="1" checked
                       class="rounded border-slate-300 text-maritime-600 focus:ring-maritime-500">
                <label for="is_active" class="text-xs text-slate-700 font-semibold">
                    Aktifkan profil di halaman publik portal
                </label>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3">
            <a href="<?= base_url('admin/peneliti') ?>" 
               class="px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors">
                Batal
            </a>
            <button type="submit" 
                    class="px-5 py-2.5 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-950 text-xs font-bold shadow-md transition-all">
                Simpan Peneliti Baru
            </button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
