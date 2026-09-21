<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6 max-w-4xl">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-extrabold text-navy-950">Edit Paket Layanan</h2>
            <p class="text-xs text-slate-500 mt-1">Perbarui spesifikasi teknis, instrumen, atau dokumen SOP layanan.</p>
        </div>
        <a href="<?= base_url('admin/layanan') ?>" 
           class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Daftar</span>
        </a>
    </div>

    <!-- Form -->
    <form action="<?= base_url('admin/layanan/update/' . $service['id']) ?>" method="POST" class="space-y-6">
        <?= csrf_field() ?>

        <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-xs space-y-5">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Slug URL <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="slug" required value="<?= esc($service['slug']) ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5 font-mono focus:ring-1 focus:ring-maritime-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Ikon FontAwesome <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="icon" required value="<?= esc($service['icon']) ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5 font-mono">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Kode SOP / Dokumen
                    </label>
                    <input type="text" name="code" value="<?= esc($service['code'] ?? '') ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5 font-mono">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Nama Layanan (Indonesia) <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="title" required value="<?= esc($service['title']) ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Nama Layanan (Inggris)
                    </label>
                    <input type="text" name="title_en" value="<?= esc($service['title_en'] ?? '') ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Deskripsi Layanan (Indonesia) <span class="text-rose-500">*</span>
                    </label>
                    <textarea name="desc" rows="4" required
                              class="w-full text-xs rounded-xl border border-slate-300 p-2.5 leading-relaxed"><?= esc($service['desc']) ?></textarea>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Deskripsi Layanan (Inggris)
                    </label>
                    <textarea name="desc_en" rows="4"
                              class="w-full text-xs rounded-xl border border-slate-300 p-2.5 leading-relaxed"><?= esc($service['desc_en'] ?? '') ?></textarea>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Standar Regulasi / Acuan Teknis
                    </label>
                    <input type="text" name="standards" value="<?= esc($service['standards'] ?? '') ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Judul Dokumen SOP
                    </label>
                    <input type="text" name="sop_name" value="<?= esc($service['sop_name'] ?? '') ?>"
                           class="w-full text-xs rounded-xl border border-slate-300 p-2.5">
                </div>
            </div>

            <!-- Dynamic Instruments List -->
            <?php 
                $insts = !empty($service['instruments']) && is_array($service['instruments']) ? $service['instruments'] : ['']; 
                $dels  = !empty($service['deliverables']) && is_array($service['deliverables']) ? $service['deliverables'] : ['']; 
            ?>
            <div class="space-y-2 pt-2" x-data="{ instruments: <?= htmlspecialchars(json_encode($insts), ENT_QUOTES, 'UTF-8') ?> }">
                <div class="flex items-center justify-between">
                    <label class="block text-xs font-bold text-slate-700">
                        Instrumen / Fasilitas Laboratorium Terkait
                    </label>
                    <button type="button" @click="instruments.push('')" class="text-[11px] text-maritime-700 font-bold hover:underline">
                        + Tambah Baris Instrumen
                    </button>
                </div>
                <template x-for="(inst, idx) in instruments" :key="idx">
                    <div class="flex items-center gap-2">
                        <input type="text" name="instruments[]" :value="inst"
                               class="w-full text-xs rounded-xl border border-slate-300 p-2">
                        <button type="button" @click="if (instruments.length > 1) instruments.splice(idx, 1)" class="text-rose-500 hover:text-rose-700 px-2 text-xs">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </template>
            </div>

            <!-- Dynamic Deliverables List -->
            <div class="space-y-2 pt-2" x-data="{ deliverables: <?= htmlspecialchars(json_encode($dels), ENT_QUOTES, 'UTF-8') ?> }">
                <div class="flex items-center justify-between">
                    <label class="block text-xs font-bold text-slate-700">
                        Dokumen Luaran / Produk Akhir (Deliverables)
                    </label>
                    <button type="button" @click="deliverables.push('')" class="text-[11px] text-maritime-700 font-bold hover:underline">
                        + Tambah Baris Luaran
                    </button>
                </div>
                <template x-for="(del, idx) in deliverables" :key="idx">
                    <div class="flex items-center gap-2">
                        <input type="text" name="deliverables[]" :value="del"
                               class="w-full text-xs rounded-xl border border-slate-300 p-2">
                        <button type="button" @click="if (deliverables.length > 1) deliverables.splice(idx, 1)" class="text-rose-500 hover:text-rose-700 px-2 text-xs">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </template>
            </div>

            <div class="pt-2 flex items-center gap-2">
                <input type="checkbox" name="is_active" id="is_active" value="1" <?= $service['is_active'] ? 'checked' : '' ?>
                       class="rounded border-slate-300 text-maritime-600 focus:ring-maritime-500">
                <label for="is_active" class="text-xs text-slate-700 font-semibold">
                    Tampilkan paket layanan di website publik
                </label>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3">
            <a href="<?= base_url('admin/layanan') ?>" 
               class="px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors">
                Batal
            </a>
            <button type="submit" 
                    class="px-5 py-2.5 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-950 text-xs font-bold shadow-md transition-all">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
