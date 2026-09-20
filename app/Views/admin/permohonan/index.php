<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6">
    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-navy-950">Rekap Permohonan Unduh Naskah</h2>
            <p class="text-xs text-slate-500 mt-0.5">Daftar instansi, akademisi, dan peneliti yang memohon akses dokumen/policy brief</p>
        </div>
        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-slate-200/70 text-slate-700 text-xs font-semibold">
            <i class="fa-solid fa-database text-slate-500"></i>
            <span>Total: <?= count($requests) ?> Permohonan</span>
        </div>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-700 font-bold uppercase text-[10px] tracking-wider">
                    <tr>
                        <th class="py-3.5 px-4 w-12 text-center">#</th>
                        <th class="py-3.5 px-4">Dokumen yang Dimohon</th>
                        <th class="py-3.5 px-4">Pemohon & Lembaga</th>
                        <th class="py-3.5 px-4">Keperluan / Riset</th>
                        <th class="py-3.5 px-4">Waktu Akses</th>
                        <th class="py-3.5 px-4 text-center">Email Penyusun</th>
                        <th class="py-3.5 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php if (empty($requests)): ?>
                    <tr>
                        <td colspan="7" class="py-8 text-center text-slate-400 italic">Belum ada permohonan unduh yang masuk.</td>
                    </tr>
                    <?php else: ?>
                    <?php foreach ($requests as $idx => $r): ?>
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="py-3.5 px-4 text-center font-mono text-[11px] text-slate-400"><?= $idx + 1 ?></td>
                        <td class="py-3.5 px-4 min-w-[220px]">
                            <div class="font-bold text-navy-950 leading-snug"><?= esc($r['document_title']) ?></div>
                            <span class="font-mono text-[10px] text-slate-400 block mt-0.5"><?= esc($r['document_slug']) ?></span>
                        </td>
                        <td class="py-3.5 px-4 min-w-[180px]">
                            <span class="font-bold text-slate-800 block"><?= esc($r['applicant_name']) ?></span>
                            <span class="text-slate-600 block text-[11px]"><?= esc($r['applicant_institution']) ?></span>
                            <div class="flex items-center gap-2 text-[10px] text-slate-400 mt-0.5">
                                <span><i class="fa-regular fa-envelope"></i> <?= esc($r['applicant_email']) ?></span>
                                <?php if (!empty($r['applicant_phone'])): ?>
                                <span>&bull;</span>
                                <span><i class="fa-brands fa-whatsapp text-emerald-600"></i> <?= esc($r['applicant_phone']) ?></span>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td class="py-3.5 px-4 min-w-[200px]">
                            <p class="text-slate-600 text-[11px] line-clamp-2 italic">"<?= esc($r['purpose']) ?>"</p>
                            <span class="text-[10px] text-slate-400 font-mono block mt-0.5">IP: <?= esc($r['ip_address'] ?? '-') ?></span>
                        </td>
                        <td class="py-3.5 px-4 whitespace-nowrap text-[11px]">
                            <?= date('d M Y, H:i', strtotime($r['created_at'])) ?> WIB
                        </td>
                        <td class="py-3.5 px-4 text-center whitespace-nowrap">
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold uppercase <?= $r['email_status'] === 'sent' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-amber-50 text-amber-700 border border-amber-200' ?>">
                                <i class="fa-solid <?= $r['email_status'] === 'sent' ? 'fa-check' : 'fa-clock' ?> text-[9px]"></i>
                                <?= esc($r['email_status']) ?>
                            </span>
                            <span class="block text-[10px] text-slate-400 truncate max-w-[120px] mx-auto mt-0.5" title="<?= esc($r['recipient_email']) ?>">
                                <?= esc($r['recipient_email']) ?>
                            </span>
                        </td>
                        <td class="py-3.5 px-4 text-center whitespace-nowrap">
                            <div class="inline-flex items-center gap-1">
                                <form action="<?= base_url('admin/permohonan/resend/' . $r['id']) ?>" method="POST" class="inline"
                                      onsubmit="return confirm('Kirim ulang email notifikasi permohonan ini ke penyusun naskah?')">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="p-1.5 rounded-lg text-blue-600 hover:text-blue-800 hover:bg-blue-50 cursor-pointer" title="Kirim Ulang Notifikasi">
                                        <i class="fa-solid fa-paper-plane text-xs"></i>
                                    </button>
                                </form>
                                <form action="<?= base_url('admin/permohonan/delete/' . $r['id']) ?>" method="POST" class="inline"
                                      onsubmit="return confirm('Hapus riwayat permohonan ini?')">
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
