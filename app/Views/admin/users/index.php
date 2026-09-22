<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-extrabold text-navy-950">Manajemen Pengguna Admin</h2>
            <p class="text-xs text-slate-500 mt-1">
                Kelola hak akses administrator, staf pengelola data riset, dan kredensial portal sistem NNSRC UMRAH.
            </p>
        </div>
        <div class="flex items-center gap-2.5">
            <a href="<?= base_url('admin/users/create') ?>"
               class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-950 text-xs font-bold shadow-sm transition-all active:scale-[0.98] shrink-0">
                <i class="fa-solid fa-user-plus"></i>
                <span>Tambah Admin Baru</span>
            </a>
        </div>
    </div>

    <!-- Users Table Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-xs overflow-hidden">
        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-bold text-sm text-navy-950 flex items-center gap-2">
                <i class="fa-solid fa-users-gear text-maritime-600"></i>
                <span>Daftar Akun Administrator (<?= count($users) ?>)</span>
            </h3>
            <span class="text-xs text-slate-400">Total: <?= count($users) ?> pengguna terdaftar</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50/80 text-slate-700 uppercase font-bold text-[11px] border-b border-slate-200 tracking-wider">
                    <tr>
                        <th class="px-5 py-3.5">Pengguna & Nama</th>
                        <th class="px-5 py-3.5">Email</th>
                        <th class="px-5 py-3.5">Peran / Role</th>
                        <th class="px-5 py-3.5 text-center">Status</th>
                        <th class="px-5 py-3.5">Login Terakhir</th>
                        <th class="px-5 py-3.5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    <?php 
                    $currentAdminId = (int) (session('admin_id') ?? 0);
                    foreach ($users as $u): 
                        $isCurrent = ((int) $u['id'] === $currentAdminId);
                    ?>
                    <tr class="hover:bg-slate-50/60 transition-colors <?= $isCurrent ? 'bg-amber-50/30' : '' ?>">
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-navy-900 text-gold-400 flex items-center justify-center font-bold text-xs shrink-0 shadow-xs">
                                    <?= mb_strtoupper(mb_substr($u['name'], 0, 2)) ?>
                                </div>
                                <div>
                                    <div class="font-bold text-slate-900 text-xs flex items-center gap-2">
                                        <span><?= esc($u['name']) ?></span>
                                        <?php if ($isCurrent): ?>
                                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-gold-100 text-gold-800 border border-gold-200">
                                                Akun Anda
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <span class="text-[11px] text-slate-400 font-mono">@<?= esc($u['username']) ?></span>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-4 font-mono text-slate-600">
                            <?= esc($u['email']) ?>
                        </td>
                        <td class="px-5 py-4">
                            <?php if ($u['role'] === 'superadmin'): ?>
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[11px] font-bold bg-purple-50 text-purple-700 border border-purple-200">
                                    <i class="fa-solid fa-crown text-[10px]"></i> Superadmin
                                </span>
                            <?php elseif ($u['role'] === 'administrator'): ?>
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[11px] font-bold bg-blue-50 text-blue-700 border border-blue-200">
                                    <i class="fa-solid fa-shield-halved text-[10px]"></i> Administrator
                                </span>
                            <?php else: ?>
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[11px] font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                    <i class="fa-solid fa-pen-nib text-[10px]"></i> Editor
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="px-5 py-4 text-center">
                            <?php if ((int) ($u['is_active'] ?? 1) === 1): ?>
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Aktif
                                </span>
                            <?php else: ?>
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                    Nonaktif
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="px-5 py-4 text-slate-500">
                            <?php if (!empty($u['last_login'])): ?>
                                <span><?= date('d M Y, H:i', strtotime($u['last_login'])) ?> WIB</span>
                            <?php else: ?>
                                <span class="text-slate-400 italic">Belum pernah login</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-5 py-4 text-right whitespace-nowrap">
                            <div class="inline-flex items-center gap-2">
                                <a href="<?= base_url('admin/users/edit/' . $u['id']) ?>" 
                                   class="p-2 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 transition-colors"
                                   title="Edit Pengguna">
                                    <i class="fa-solid fa-user-pen text-xs"></i>
                                </a>

                                <?php if (! $isCurrent): ?>
                                    <form action="<?= base_url('admin/users/delete/' . $u['id']) ?>" method="POST" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun pengguna <?= esc($u['username']) ?>? Tindakan ini tidak dapat dibatalkan.');" 
                                          class="inline">
                                        <?= csrf_field() ?>
                                        <button type="submit" 
                                                class="p-2 rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-600 transition-colors cursor-pointer"
                                                title="Hapus Pengguna">
                                            <i class="fa-solid fa-trash text-xs"></i>
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <span class="p-2 rounded-lg text-slate-300 cursor-not-allowed" title="Anda tidak dapat menghapus akun Anda sendiri">
                                        <i class="fa-solid fa-lock text-xs"></i>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
