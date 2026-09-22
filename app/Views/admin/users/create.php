<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="max-w-3xl space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <div class="flex items-center gap-2 text-xs text-slate-500 mb-1">
                <a href="<?= base_url('admin/users') ?>" class="hover:text-gold-600 transition-colors">Manajemen Pengguna</a>
                <span>/</span>
                <span class="text-slate-700 font-semibold">Tambah Admin Baru</span>
            </div>
            <h2 class="text-xl font-extrabold text-navy-950">Tambah Pengguna Admin Baru</h2>
        </div>
        <a href="<?= base_url('admin/users') ?>" 
           class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali</span>
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-xs p-6 sm:p-8">
        <form action="<?= base_url('admin/users/store') ?>" method="POST" class="space-y-6">
            <?= csrf_field() ?>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <!-- Name -->
                <div class="space-y-2 sm:col-span-2">
                    <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                        Nama Lengkap <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" id="name" name="name" value="<?= old('name') ?>" required
                           placeholder="Contoh: Dr. Herman Setyawan, M.Si."
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-navy-900 focus:border-transparent">
                </div>

                <!-- Username -->
                <div class="space-y-2">
                    <label for="username" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                        Nama Pengguna (Username) <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" id="username" name="username" value="<?= old('username') ?>" required
                           placeholder="huruf kecil, angka, atau underscore"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-mono focus:outline-none focus:ring-2 focus:ring-navy-900 focus:border-transparent">
                </div>

                <!-- Email -->
                <div class="space-y-2">
                    <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                        Alamat Email <span class="text-rose-500">*</span>
                    </label>
                    <input type="email" id="email" name="email" value="<?= old('email') ?>" required
                           placeholder="email@umrah.ac.id"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-mono focus:outline-none focus:ring-2 focus:ring-navy-900 focus:border-transparent">
                </div>

                <!-- Role -->
                <div class="space-y-2">
                    <label for="role" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                        Peran / Hak Akses <span class="text-rose-500">*</span>
                    </label>
                    <select id="role" name="role" required
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-navy-900 focus:border-transparent">
                        <option value="administrator" <?= old('role') === 'administrator' ? 'selected' : '' ?>>Administrator (Akses Penuh Kelola Konten)</option>
                        <option value="superadmin" <?= old('role') === 'superadmin' ? 'selected' : '' ?>>Superadmin (Akses Penuh Konten & Pengguna)</option>
                        <option value="editor" <?= old('role') === 'editor' ? 'selected' : '' ?>>Editor (Kelola Publikasi & Berita)</option>
                    </select>
                </div>

                <!-- Status Aktif -->
                <div class="space-y-2">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                        Status Akun
                    </label>
                    <div class="pt-2">
                        <label class="inline-flex items-center gap-2.5 cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" <?= old('is_active', '1') === '1' ? 'checked' : '' ?>
                                   class="w-4 h-4 rounded text-navy-950 border-slate-300 focus:ring-navy-900">
                            <span class="text-xs text-slate-700 font-medium">Aktifkan akun ini segera</span>
                        </label>
                    </div>
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                        Kata Sandi <span class="text-rose-500">*</span>
                    </label>
                    <input type="password" id="password" name="password" required minlength="8"
                           placeholder="Minimal 8 karakter"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-navy-900 focus:border-transparent">
                </div>

                <!-- Confirm Password -->
                <div class="space-y-2">
                    <label for="confirm_password" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                        Konfirmasi Kata Sandi <span class="text-rose-500">*</span>
                    </label>
                    <input type="password" id="confirm_password" name="confirm_password" required minlength="8"
                           placeholder="Ulangi kata sandi di atas"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-navy-900 focus:border-transparent">
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="<?= base_url('admin/users') ?>" 
                   class="px-5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition-colors">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-2.5 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-950 text-xs font-bold shadow-sm transition-all active:scale-[0.98] cursor-pointer">
                    <i class="fa-solid fa-save mr-1.5"></i> Simpan Pengguna Baru
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
