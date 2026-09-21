<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6 max-w-4xl">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-extrabold text-navy-950">Edit Data Peneliti</h2>
            <p class="text-xs text-slate-500 mt-1">Perbarui profil akademis, jabatan, atau foto peneliti.</p>
        </div>
        <a href="<?= base_url('admin/peneliti') ?>" 
           class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Daftar</span>
        </a>
    </div>

    <!-- Form -->
    <form action="<?= base_url('admin/peneliti/update/' . $peneliti['id']) ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
        <?= csrf_field() ?>

        <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-xs space-y-5">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Kategori Keanggotaan <span class="text-rose-500">*</span>
                    </label>
                    <select name="category" required class="w-full text-xs rounded-xl border border-slate-300 p-2.5 bg-white focus:ring-1 focus:ring-maritime-500">
                        <option value="dewan_peneliti" <?= $peneliti['category'] === 'dewan_peneliti' ? 'selected' : '' ?>>Dewan Peneliti (Research Fellow)</option>
                        <option value="pimpinan" <?= $peneliti['category'] === 'pimpinan' ? 'selected' : '' ?>>Pimpinan Eksekutif Lembaga</option>
                        <option value="eksternal" <?= $peneliti['category'] === 'eksternal' ? 'selected' : '' ?>>Mitra Riset Eksternal</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Urutan Tampilan (Sort Order)
                    </label>
                    <input type="number" name="order_num" value="<?= esc($peneliti['order_num']) ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">
                    Nama Lengkap & Gelar Akademis <span class="text-rose-500">*</span>
                </label>
                <input type="text" name="name" required value="<?= esc($peneliti['name']) ?>"
                       class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:ring-1 focus:ring-maritime-500">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Jabatan / Role (Indonesia) <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="role" required value="<?= esc($peneliti['role']) ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Jabatan / Role (Inggris)
                    </label>
                    <input type="text" name="role_en" value="<?= esc($peneliti['role_en'] ?? '') ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Fakultas / Asal Lembaga (Indonesia)
                    </label>
                    <input type="text" name="faculty" value="<?= esc($peneliti['faculty'] ?? '') ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Fakultas / Asal Lembaga (Inggris)
                    </label>
                    <input type="text" name="faculty_en" value="<?= esc($peneliti['faculty_en'] ?? '') ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Fokus Bidang Keahlian (Indonesia) <span class="text-rose-500">*</span>
                    </label>
                    <textarea name="focus" rows="3" required
                              class="w-full text-xs rounded-xl border border-slate-300 p-2.5"><?= esc($peneliti['focus']) ?></textarea>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Fokus Bidang Keahlian (Inggris)
                    </label>
                    <textarea name="focus_en" rows="3"
                              class="w-full text-xs rounded-xl border border-slate-300 p-2.5"><?= esc($peneliti['focus_en'] ?? '') ?></textarea>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Klaster Riset Terkait
                    </label>
                    <input type="text" name="cluster" value="<?= esc($peneliti['cluster'] ?? '') ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Nomor Induk Pegawai (NIP)
                    </label>
                    <input type="text" name="nip" value="<?= esc($peneliti['nip'] ?? '') ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5 font-mono">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Scopus ID / SINTA ID
                    </label>
                    <input type="text" name="scopus" value="<?= esc($peneliti['scopus'] ?? '') ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5 font-mono">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Email Resmi Institusi <span class="text-rose-500">*</span>
                    </label>
                    <input type="email" name="email" required value="<?= esc($peneliti['email']) ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5 font-mono">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Ganti Foto Profil (Biarkan kosong jika tetap)
                    </label>
                    <input type="file" name="image" accept="image/*"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2 bg-slate-50">
                    <?php if (!empty($peneliti['image'])): ?>
                        <div class="flex items-center gap-2 mt-2">
                            <img src="<?= base_url($peneliti['image']) ?>" alt="Current photo" class="w-8 h-8 rounded-lg object-cover">
                            <span class="text-[11px] text-slate-500">Foto saat ini tersimpan</span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="pt-2 flex items-center gap-2">
                <input type="checkbox" name="is_active" id="is_active" value="1" <?= $peneliti['is_active'] ? 'checked' : '' ?>
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
                Simpan Perubahan Peneliti
            </button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
