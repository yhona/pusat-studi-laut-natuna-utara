<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6">
    
    <!-- Header Toolbar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-navy-950">Kelola Repositori & SOP Unduhan</h2>
            <p class="text-xs text-slate-500 mt-0.5">Daftar naskah Standar Operasional Prosedur, template MoU, dan dokumen publikasi</p>
        </div>
        <a href="<?= base_url('admin/unduhan/create') ?>" 
           class="inline-flex items-center gap-2 px-4 py-2.5 bg-navy-950 hover:bg-maritime-700 text-gold-400 hover:text-white rounded-xl font-bold text-xs shadow-sm transition-all active:scale-[0.98]">
            <i class="fa-solid fa-plus"></i>
            <span>Tambah Dokumen Baru</span>
        </a>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-700 font-bold uppercase text-[10px] tracking-wider">
                    <tr>
                        <th class="py-3.5 px-4 w-12 text-center">#</th>
                        <th class="py-3.5 px-4">Kode & Judul Dokumen</th>
                        <th class="py-3.5 px-4">Kategori</th>
                        <th class="py-3.5 px-4">Format / Ukuran</th>
                        <th class="py-3.5 px-4 text-center">Diunduh</th>
                        <th class="py-3.5 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php if (empty($documents)): ?>
                    <tr>
                        <td colspan="6" class="py-12 px-4 text-center">
                            <div class="flex flex-col items-center justify-center max-w-sm mx-auto">
                                <div class="w-16 h-16 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mb-4 text-2xl">
                                    <i class="fa-solid fa-folder-open"></i>
                                </div>
                                <h3 class="text-base font-bold text-navy-950 mb-1">Belum Ada Dokumen Unduhan</h3>
                                <p class="text-xs text-slate-500 mb-5 leading-relaxed">Belum ada berkas SOP, format template, atau panduan penelitian resmi di repositori.</p>
                                <a href="<?= base_url('admin/unduhan/create') ?>"
                                   class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-950 text-xs font-bold shadow-sm transition-all active:scale-[0.98]">
                                    <i class="fa-solid fa-plus"></i>
                                    <span>Tambah Dokumen Baru</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php else: ?>
                    <?php foreach ($documents as $idx => $doc): ?>
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="py-3.5 px-4 text-center font-mono text-[11px] text-slate-400"><?= $idx + 1 ?></td>
                        <td class="py-3.5 px-4 min-w-[280px]">
                            <span class="font-mono text-[10px] font-bold text-slate-400 block"><?= esc($doc['code']) ?> &bull; <?= esc($doc['year']) ?></span>
                            <div class="font-bold text-navy-950 leading-snug"><?= esc($doc['title']) ?></div>
                            <div class="text-[11px] text-slate-400 line-clamp-1 mt-0.5"><?= esc($doc['desc']) ?></div>
                        </td>
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-maritime-700 bg-maritime-50 px-2.5 py-0.5 rounded-lg border border-maritime-200/50">
                                <?= esc($doc['category']) ?>
                            </span>
                        </td>
                        <td class="py-3.5 px-4 whitespace-nowrap text-[11px]">
                            <span class="font-bold text-slate-700"><?= esc($doc['file_type']) ?></span>
                            <span class="text-slate-400">(<?= esc($doc['file_size']) ?>)</span>
                        </td>
                        <td class="py-3.5 px-4 text-center font-mono font-bold text-gold-600 whitespace-nowrap">
                            <?= number_format($doc['downloads']) ?>x
                        </td>
                        <td class="py-3.5 px-4 text-center whitespace-nowrap">
                            <div class="inline-flex items-center gap-1">
                                <a href="<?= base_url('unduhan/unduh/' . $doc['slug']) ?>" 
                                   class="p-1.5 rounded-lg text-slate-500 hover:text-navy-950 hover:bg-slate-100" title="Unduh Berkas">
                                    <i class="fa-solid fa-download text-xs"></i>
                                </a>
                                <a href="<?= base_url('admin/unduhan/edit/' . $doc['id']) ?>" 
                                   class="p-1.5 rounded-lg text-blue-600 hover:text-blue-800 hover:bg-blue-50" title="Sunting">
                                    <i class="fa-solid fa-pen-to-square text-xs"></i>
                                </a>
                                <form action="<?= base_url('admin/unduhan/delete/' . $doc['id']) ?>" method="POST" class="inline"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?')">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="p-1.5 rounded-lg text-rose-500 hover:text-rose-700 hover:bg-rose-50 cursor-pointer" title="Hapus">
                                        <i class="fa-regular fa-trash-can text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?= $this->endSection() ?>
