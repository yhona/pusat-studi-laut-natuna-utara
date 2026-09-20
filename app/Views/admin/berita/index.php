<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6">
    
    <!-- Header Toolbar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-navy-950">Kelola Berita & Agenda Kegiatan</h2>
            <p class="text-xs text-slate-500 mt-0.5">Daftar publikasi artikel riset, ekspedisi bahari, dan agenda kemaritiman</p>
        </div>
        <a href="<?= base_url('admin/berita/create') ?>" 
           class="inline-flex items-center gap-2 px-4 py-2.5 bg-navy-950 hover:bg-maritime-700 text-gold-400 hover:text-white rounded-xl font-bold text-xs shadow-sm transition-all active:scale-[0.98]">
            <i class="fa-solid fa-plus"></i>
            <span>Tambah Berita Baru</span>
        </a>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-700 font-bold uppercase text-[10px] tracking-wider">
                    <tr>
                        <th class="py-3.5 px-4 w-12 text-center">#</th>
                        <th class="py-3.5 px-4">Judul & Kategori</th>
                        <th class="py-3.5 px-4">Penulis</th>
                        <th class="py-3.5 px-4">Tanggal Rilis</th>
                        <th class="py-3.5 px-4 text-center">Status</th>
                        <th class="py-3.5 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php if (empty($articles)): ?>
                    <tr>
                        <td colspan="6" class="py-8 text-center text-slate-400 italic">Belum ada berita yang diterbitkan.</td>
                    </tr>
                    <?php else: ?>
                    <?php foreach ($articles as $idx => $art): ?>
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="py-3.5 px-4 text-center font-mono text-[11px] text-slate-400"><?= $idx + 1 ?></td>
                        <td class="py-3.5 px-4 min-w-[280px]">
                            <div class="font-bold text-navy-950 leading-snug line-clamp-2"><?= esc($art['title']) ?></div>
                            <div class="flex items-center gap-2 text-[11px] text-slate-400 mt-1">
                                <span class="text-maritime-700 font-semibold"><?= esc($art['category']) ?></span>
                                <span>&bull;</span>
                                <span class="font-mono"><?= esc($art['slug']) ?></span>
                            </div>
                        </td>
                        <td class="py-3.5 px-4 text-[11px] min-w-[150px]">
                            <span class="font-semibold text-slate-700 block"><?= esc($art['author']) ?></span>
                            <span class="text-slate-400 block text-[10px]"><?= esc($art['author_role']) ?></span>
                        </td>
                        <td class="py-3.5 px-4 whitespace-nowrap text-[11px]">
                            <?= esc($art['date_formatted'] ?? date('d M Y', strtotime($art['published_at']))) ?>
                        </td>
                        <td class="py-3.5 px-4 text-center">
                            <?php if (!empty($art['is_featured'])): ?>
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                <i class="fa-solid fa-star text-[9px]"></i> Unggulan
                            </span>
                            <?php else: ?>
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-medium bg-slate-100 text-slate-600">
                                Standar
                            </span>
                            <?php endif; ?>
                        </td>
                        <td class="py-3.5 px-4 text-center whitespace-nowrap">
                            <div class="inline-flex items-center gap-1">
                                <a href="<?= base_url('berita/' . $art['slug']) ?>" target="_blank" 
                                   class="p-1.5 rounded-lg text-slate-500 hover:text-navy-950 hover:bg-slate-100" title="Lihat di Web">
                                    <i class="fa-solid fa-eye text-xs"></i>
                                </a>
                                <a href="<?= base_url('admin/berita/edit/' . $art['id']) ?>" 
                                   class="p-1.5 rounded-lg text-blue-600 hover:text-blue-800 hover:bg-blue-50" title="Sunting">
                                    <i class="fa-solid fa-pen-to-square text-xs"></i>
                                </a>
                                <form action="<?= base_url('admin/berita/delete/' . $art['id']) ?>" method="POST" class="inline"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
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
