<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6">
    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-navy-950">Pesan Kerjasama & Kontak Masuk</h2>
            <p class="text-xs text-slate-500 mt-0.5">Daftar aspirasi kemitraan riset pentahelix dan pertanyaan dari masyarakat</p>
        </div>
        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-slate-200/70 text-slate-700 text-xs font-semibold">
            <i class="fa-solid fa-inbox text-slate-500"></i>
            <span>Total: <?= count($messages) ?> Pesan</span>
        </div>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-700 font-bold uppercase text-[10px] tracking-wider">
                    <tr>
                        <th class="py-3.5 px-4 w-12 text-center">#</th>
                        <th class="py-3.5 px-4">Pengirim & Instansi</th>
                        <th class="py-3.5 px-4">Kategori Kerjasama</th>
                        <th class="py-3.5 px-4">Isi Pesan</th>
                        <th class="py-3.5 px-4">Waktu Kirim</th>
                        <th class="py-3.5 px-4 text-center">Status</th>
                        <th class="py-3.5 px-4 text-center">Aksi Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php if (empty($messages)): ?>
                    <tr>
                        <td colspan="7" class="py-12 px-4 text-center">
                            <div class="flex flex-col items-center justify-center max-w-sm mx-auto">
                                <div class="w-16 h-16 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mb-4 text-2xl">
                                    <i class="fa-regular fa-envelope-open"></i>
                                </div>
                                <h3 class="text-base font-bold text-navy-950 mb-1">Belum Ada Pesan Masuk</h3>
                                <p class="text-xs text-slate-500 leading-relaxed">Kotak masuk permohonan kemitraan, konsultasi, dan inisiasi riset saat ini masih kosong.</p>
                            </div>
                        </td>
                    </tr>
                    <?php else: ?>
                    <?php foreach ($messages as $idx => $m): ?>
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="py-3.5 px-4 text-center font-mono text-[11px] text-slate-400"><?= $idx + 1 ?></td>
                        <td class="py-3.5 px-4 min-w-[180px]">
                            <span class="font-bold text-slate-800 block"><?= esc($m['nama']) ?></span>
                            <span class="text-slate-500 block text-[11px]"><?= esc($m['instansi']) ?></span>
                            <div class="flex items-center gap-2 text-[10px] text-slate-400 mt-0.5">
                                <span><i class="fa-regular fa-envelope"></i> <?= esc($m['email']) ?></span>
                                <?php if (!empty($m['telepon'])): ?>
                                <span>&bull;</span>
                                <?php
                                    $rawPhone = (string) $m['telepon'];
                                    $cleanPhone = preg_replace('/\D+/', '', $rawPhone);
                                    if (str_starts_with($cleanPhone, '0')) {
                                        $cleanPhone = '62' . substr($cleanPhone, 1);
                                    }
                                ?>
                                <?php if (!empty($cleanPhone)): ?>
                                <a href="https://wa.me/<?= $cleanPhone ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1 text-emerald-600 hover:text-emerald-700 hover:underline font-medium" title="Hubungi via WhatsApp (<?= esc($cleanPhone) ?>)">
                                    <i class="fa-brands fa-whatsapp text-emerald-600"></i>
                                    <span><?= esc($rawPhone) ?></span>
                                </a>
                                <?php else: ?>
                                <span><i class="fa-solid fa-phone"></i> <?= esc($rawPhone) ?></span>
                                <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-maritime-700 bg-maritime-50 px-2.5 py-0.5 rounded-lg border border-maritime-200/50">
                                <?= esc($m['kategori']) ?>
                            </span>
                        </td>
                        <td class="py-3.5 px-4 min-w-[260px]">
                            <p class="text-slate-700 text-xs leading-relaxed italic">"<?= esc($m['pesan']) ?>"</p>
                            <span class="text-[10px] text-slate-400 font-mono block mt-0.5">IP: <?= esc($m['ip_address'] ?? '-') ?></span>
                        </td>
                        <td class="py-3.5 px-4 whitespace-nowrap text-[11px]">
                            <?= date('d M Y, H:i', strtotime($m['created_at'])) ?> WIB
                        </td>
                        <td class="py-3.5 px-4 text-center whitespace-nowrap">
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase <?= $m['status'] === 'baru' ? 'bg-rose-50 text-rose-700 border border-rose-200' : ($m['status'] === 'diproses' ? 'bg-amber-50 text-amber-700 border border-amber-200' : 'bg-emerald-50 text-emerald-700 border border-emerald-200') ?>">
                                <?= esc($m['status']) ?>
                            </span>
                        </td>
                        <td class="py-3.5 px-4 text-center whitespace-nowrap">
                            <form action="<?= base_url('admin/kontak/update-status/' . $m['id']) ?>" method="POST" class="inline-flex items-center gap-1">
                                <?= csrf_field() ?>
                                <select name="status" onchange="this.form.submit()" 
                                        class="text-[11px] py-1 px-2 rounded-lg border border-slate-300 bg-white focus:outline-none focus:ring-1 focus:ring-maritime-600">
                                    <option value="baru" <?= $m['status'] === 'baru' ? 'selected' : '' ?>>Baru</option>
                                    <option value="diproses" <?= $m['status'] === 'diproses' ? 'selected' : '' ?>>Diproses</option>
                                    <option value="selesai" <?= $m['status'] === 'selesai' ? 'selected' : '' ?>>Selesai</option>
                                </select>
                            </form>
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
