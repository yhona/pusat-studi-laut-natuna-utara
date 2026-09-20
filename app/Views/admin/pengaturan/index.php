<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6 max-w-3xl">
    <!-- Header -->
    <div>
        <h2 class="text-xl font-extrabold text-navy-950">Pengaturan Akun & Keamanan</h2>
        <p class="text-xs text-slate-500 mt-1">
            Kelola profil administrator portal NNSRC UMRAH, perbarui alamat email notifikasi resmi, dan ganti kata sandi akses panel.
        </p>
    </div>

    <!-- User Profile Card -->
    <div class="bg-navy-950 rounded-2xl p-6 text-white border border-slate-800 shadow-md flex items-center gap-4">
        <div class="w-14 h-14 rounded-2xl bg-gold-500 text-navy-950 flex items-center justify-center text-2xl font-black shrink-0">
            <i class="fa-solid fa-shield-halved"></i>
        </div>
        <div class="min-w-0">
            <span class="text-gold-400 uppercase text-[10px] font-bold tracking-widest block">Hak Akses Sistem</span>
            <h3 class="text-lg font-bold text-white truncate"><?= esc($user['name'] ?? session('admin_name')) ?></h3>
            <p class="text-xs text-slate-300 font-mono"><?= esc($user['email'] ?? session('admin_email')) ?></p>
        </div>
    </div>

    <!-- Edit Form -->
    <form action="<?= base_url('admin/pengaturan/update') ?>" method="POST" class="space-y-6">
        <?= csrf_field() ?>

        <!-- Identitas Akun -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs space-y-4">
            <h3 class="text-sm font-bold text-navy-950 border-b border-slate-100 pb-2">Identitas Administrator</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap / Instansi <span class="text-rose-500">*</span></label>
                    <input type="text" name="name" value="<?= esc($user['name'] ?? '') ?>" required
                           class="w-full text-xs rounded-xl border border-slate-300 focus:border-maritime-500 focus:ring-1 focus:ring-maritime-500 p-2.5">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Username Login <span class="text-rose-500">*</span></label>
                    <input type="text" name="username" value="<?= esc($user['username'] ?? '') ?>" required
                           class="w-full text-xs rounded-xl border border-slate-300 focus:border-maritime-500 focus:ring-1 focus:ring-maritime-500 p-2.5 font-mono">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Email Resmi (Tujuan Pemberitahuan) <span class="text-rose-500">*</span></label>
                <input type="email" name="email" value="<?= esc($user['email'] ?? '') ?>" required
                       class="w-full text-xs rounded-xl border border-slate-300 focus:border-maritime-500 focus:ring-1 focus:ring-maritime-500 p-2.5 font-mono">
                <p class="text-[11px] text-slate-400 mt-1">Digunakan untuk menerima notifikasi permohonan unduh berkas dan pesan kemitraan baru.</p>
            </div>
        </div>

        <!-- Ubah Kata Sandi -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs space-y-4">
            <div class="border-b border-slate-100 pb-2 flex items-center justify-between">
                <h3 class="text-sm font-bold text-navy-950">Ganti Kata Sandi</h3>
                <span class="text-[11px] text-slate-400">Kosongkan bila tidak ingin mengubah kata sandi</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Kata Sandi Baru</label>
                    <input type="password" name="new_password" placeholder="Minimal 8 karakter"
                           class="w-full text-xs rounded-xl border border-slate-300 focus:border-maritime-500 focus:ring-1 focus:ring-maritime-500 p-2.5">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Konfirmasi Kata Sandi Baru</label>
                    <input type="password" name="confirm_password" placeholder="Ulangi kata sandi baru"
                           class="w-full text-xs rounded-xl border border-slate-300 focus:border-maritime-500 focus:ring-1 focus:ring-maritime-500 p-2.5">
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-end gap-3">
            <button type="submit"
                    class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-950 font-bold text-xs shadow-md transition-all active:scale-[0.98] cursor-pointer">
                <i class="fa-solid fa-floppy-disk"></i>
                <span>Simpan Pengaturan Akun</span>
            </button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
