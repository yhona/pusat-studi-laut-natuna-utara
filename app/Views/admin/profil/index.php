<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-extrabold text-navy-950">Kelola Profil & Landasan Lembaga</h2>
            <p class="text-xs text-slate-500 mt-1">
                Perbarui narasi mandat Tridharma, nomor Nota Kesepahaman (MoU) BSKLN Kemenlu RI, visi & misi, serta falsafah Gurindam Dua Belas Pasal 5.
            </p>
        </div>
        <a href="<?= base_url('profil') ?>" target="_blank" 
           class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors shrink-0">
            <i class="fa-solid fa-arrow-up-right-from-square"></i>
            <span>Pratinjau Halaman Profil</span>
        </a>
    </div>

    <!-- Edit Form -->
    <form action="<?= base_url('admin/profil/update') ?>" method="POST" class="space-y-6">
        <?= csrf_field() ?>

        <!-- Panel 1: Mandat Pendirian & Kerjasama BSKLN Kemenlu RI -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs space-y-5">
            <div class="border-b border-slate-100 pb-3 flex items-center justify-between">
                <div class="flex items-center gap-2 text-sm font-bold text-navy-950">
                    <i class="fa-solid fa-landmark text-gold-500"></i>
                    <span>Dasar Filosofis & Mandat Hukum Pendirian (Tentang Kami)</span>
                </div>
                <span class="text-[11px] font-mono text-slate-400">Section: Mandat Historis</span>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Narasi Mandat Pendirian & Kerjasama BSKLN Kemenlu RI <span class="text-rose-500">*</span>
                    </label>
                    <textarea name="mandat_id" rows="5" required
                              class="w-full text-xs rounded-xl border border-slate-300 focus:border-maritime-500 focus:ring-1 focus:ring-maritime-500 p-3 leading-relaxed"><?= esc($profile['mandat_id'] ?? '') ?></textarea>
                    <p class="text-[11px] text-slate-400 mt-1">
                        Sesuai ketetapan: Mengoptimalkan kajian bersama UMRAH dan Badan Strategi Kebijakan Luar Negeri Kementerian Luar Negeri RI.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">
                            Nomor MoU BSKLN Kementerian Luar Negeri RI <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="mou_kemenlu" value="<?= esc($profile['mou_kemenlu'] ?? '') ?>" required
                               class="w-full text-xs rounded-xl border border-slate-300 focus:border-maritime-500 focus:ring-1 focus:ring-maritime-500 p-2.5 font-mono">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">
                            Nomor MoU Universitas Maritim Raja Ali Haji <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="mou_umrah" value="<?= esc($profile['mou_umrah'] ?? '') ?>" required
                               class="w-full text-xs rounded-xl border border-slate-300 focus:border-maritime-500 focus:ring-1 focus:ring-maritime-500 p-2.5 font-mono">
                    </div>
                </div>
            </div>
        </div>

        <!-- Panel 2: Falsafah Gurindam Dua Belas (Pasal 5) & Visi Misi -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs space-y-5">
            <div class="border-b border-slate-100 pb-3 flex items-center justify-between">
                <div class="flex items-center gap-2 text-sm font-bold text-navy-950">
                    <i class="fa-solid fa-scroll text-gold-500"></i>
                    <span>Falsafah Tamadun Bahari Melayu (Gurindam 12 Pasal 5) & Visi Misi</span>
                </div>
                <span class="text-[11px] font-mono text-slate-400">Section: Visi & Falsafah</span>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Rumusan Visi Utama Pusat Studi <span class="text-rose-500">*</span>
                    </label>
                    <textarea name="visi_id" rows="2" required
                              class="w-full text-xs rounded-xl border border-slate-300 focus:border-maritime-500 focus:ring-1 focus:ring-maritime-500 p-3 leading-relaxed"><?= esc($profile['visi_id'] ?? '') ?></textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-4 rounded-xl bg-amber-50/60 border border-amber-200/70 space-y-2">
                        <label class="block text-xs font-bold text-amber-900">
                            <i class="fa-solid fa-feather-pointed mr-1 text-gold-600"></i> Gurindam Bait Ke-1 (Insan Berilmu)
                        </label>
                        <textarea name="gurindam_bait1" rows="2" required
                                  class="w-full text-xs rounded-lg border border-amber-300 bg-white p-2.5 font-serif italic text-slate-800"><?= esc($profile['gurindam_bait1'] ?? '') ?></textarea>
                        <span class="text-[10px] text-amber-800 block">Dasar etos kerja saintifik periset kemaritiman.</span>
                    </div>

                    <div class="p-4 rounded-xl bg-amber-50/60 border border-amber-200/70 space-y-2">
                        <label class="block text-xs font-bold text-amber-900">
                            <i class="fa-solid fa-feather-pointed mr-1 text-gold-600"></i> Gurindam Bait Ke-2 (Insan Berakal)
                        </label>
                        <textarea name="gurindam_bait2" rows="2" required
                                  class="w-full text-xs rounded-lg border border-amber-300 bg-white p-2.5 font-serif italic text-slate-800"><?= esc($profile['gurindam_bait2'] ?? '') ?></textarea>
                        <span class="text-[10px] text-amber-800 block">Dasar perumusan naskah kebijakan (bekal diplomasi).</span>
                    </div>
                </div>

                <div class="space-y-3 pt-2">
                    <span class="block text-xs font-bold text-slate-700">Misi Tridharma Berlandaskan Falsafah Gurindam:</span>

                    <div>
                        <label class="block text-[11px] font-semibold text-slate-600 mb-1">Misi 1: Eksplorasi Sains Bahari Berkelanjutan</label>
                        <textarea name="misi_1" rows="2" required
                                  class="w-full text-xs rounded-xl border border-slate-300 focus:border-maritime-500 focus:ring-1 focus:ring-maritime-500 p-2.5"><?= esc($profile['misi_1'] ?? '') ?></textarea>
                    </div>

                    <div>
                        <label class="block text-[11px] font-semibold text-slate-600 mb-1">Misi 2: Penguatan Kedaulatan & Diplomasi ZEE</label>
                        <textarea name="misi_2" rows="2" required
                                  class="w-full text-xs rounded-xl border border-slate-300 focus:border-maritime-500 focus:ring-1 focus:ring-maritime-500 p-2.5"><?= esc($profile['misi_2'] ?? '') ?></textarea>
                    </div>

                    <div>
                        <label class="block text-[11px] font-semibold text-slate-600 mb-1">Misi 3: Hilirisasi & Pemberdayaan Masyarakat Pesisir</label>
                        <textarea name="misi_3" rows="2" required
                                  class="w-full text-xs rounded-xl border border-slate-300 focus:border-maritime-500 focus:ring-1 focus:ring-maritime-500 p-2.5"><?= esc($profile['misi_3'] ?? '') ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-end gap-3 pt-2">
            <button type="submit"
                    class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-950 font-bold text-xs shadow-md transition-all active:scale-[0.98] cursor-pointer">
                <i class="fa-solid fa-floppy-disk"></i>
                <span>Simpan Perubahan Profil & Mandat</span>
            </button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
