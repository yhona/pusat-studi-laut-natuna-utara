<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-extrabold text-navy-950">Audit Trail & Log Aktivitas Admin</h2>
            <p class="text-xs text-slate-500 mt-1">
                Rekam jejak kepatuhan dan audit keamanan sistem untuk setiap tindakan autentikasi, modifikasi data, dan konfigurasi portal.
            </p>
        </div>
        <div class="flex items-center gap-2.5">
            <?php if ($oldLogsCount > 0): ?>
            <form action="<?= base_url('admin/logs/clear') ?>" method="POST" 
                  onsubmit="return confirm('Apakah Anda yakin ingin membersihkan <?= $oldLogsCount ?> riwayat log aktivitas yang lebih lama dari 30 hari?');">
                <?= csrf_field() ?>
                <button type="submit" 
                        class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-bold border border-rose-200 transition-colors cursor-pointer">
                    <i class="fa-solid fa-broom"></i>
                    <span>Bersihkan <?= $oldLogsCount ?> Log (>30 Hari)</span>
                </button>
            </form>
            <?php else: ?>
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-medium text-slate-400 bg-slate-100">
                    <i class="fa-solid fa-check"></i> Tidak ada log usang (>30 Hari)
                </span>
            <?php endif; ?>
        </div>
    </div>

    <!-- Filters & Search Toolbar -->
    <div class="bg-white rounded-2xl p-4 sm:p-5 border border-slate-200 shadow-xs flex flex-col md:flex-row items-stretch md:items-center justify-between gap-3 text-xs">
        <form action="<?= base_url('admin/logs') ?>" method="GET" class="flex flex-wrap items-center gap-2.5 flex-1">
            <!-- Filter Action -->
            <select name="action" onchange="this.form.submit()" 
                    class="px-3.5 py-2 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-navy-900 bg-slate-50">
                <option value="">Semua Kategori Aksi</option>
                <?php foreach ($availableActions as $key => $lbl): ?>
                    <option value="<?= $key ?>" <?= $actionFilter === $key ? 'selected' : '' ?>><?= esc($lbl) ?></option>
                <?php endforeach; ?>
            </select>

            <!-- Search input -->
            <div class="relative flex-1 min-w-[200px]">
                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                <input type="text" name="q" value="<?= esc($searchQuery) ?>" 
                       placeholder="Cari deskripsi, administrator, atau IP..."
                       class="w-full pl-9 pr-4 py-2 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-navy-900">
            </div>

            <button type="submit" class="px-4 py-2 rounded-xl bg-navy-950 text-white font-bold hover:bg-navy-900 transition-colors">
                Cari
            </button>

            <?php if (!empty($actionFilter) || !empty($searchQuery)): ?>
                <a href="<?= base_url('admin/logs') ?>" class="px-3.5 py-2 rounded-xl bg-slate-100 text-slate-600 hover:bg-slate-200 transition-colors font-medium">
                    Reset
                </a>
            <?php endif; ?>
        </form>

        <div class="text-slate-400 text-xs text-right whitespace-nowrap">
            Menampilkan <?= count($logs) ?> dari <?= $totalLogs ?> catatan log
        </div>
    </div>

    <!-- Logs Table Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50/80 text-slate-700 uppercase font-bold text-[11px] border-b border-slate-200 tracking-wider">
                    <tr>
                        <th class="px-5 py-3.5 w-16">#ID</th>
                        <th class="px-5 py-3.5 w-44">Waktu Kejadian</th>
                        <th class="px-5 py-3.5 w-44">Administrator</th>
                        <th class="px-5 py-3.5 w-36">Jenis Aksi</th>
                        <th class="px-5 py-3.5">Detail Aktivitas</th>
                        <th class="px-5 py-3.5 w-36 text-right">Alamat IP</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    <?php if (empty($logs)): ?>
                    <tr>
                        <td colspan="6" class="px-5 py-12 text-center text-slate-400">
                            <i class="fa-solid fa-clipboard-list text-3xl mb-2 text-slate-300 block"></i>
                            <span>Tidak ditemukan riwayat log aktivitas yang sesuai kriteria pencarian.</span>
                        </td>
                    </tr>
                    <?php else: ?>
                        <?php foreach ($logs as $log): ?>
                        <tr class="hover:bg-slate-50/70 transition-colors">
                            <td class="px-5 py-3.5 font-mono text-slate-400 text-[11px]">
                                #<?= $log['id'] ?>
                            </td>
                            <td class="px-5 py-3.5 whitespace-nowrap text-slate-500">
                                <?= date('d M Y, H:i:s', strtotime($log['created_at'])) ?>
                            </td>
                            <td class="px-5 py-3.5">
                                <div class="font-bold text-navy-950 flex items-center gap-1.5">
                                    <i class="fa-solid fa-user-shield text-slate-400 text-[10px]"></i>
                                    <span><?= esc($log['admin_name'] ?? 'System') ?></span>
                                </div>
                                <?php if (!empty($log['admin_id'])): ?>
                                    <span class="text-[10px] text-slate-400 font-mono">UID: <?= $log['admin_id'] ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="px-5 py-3.5 whitespace-nowrap">
                                <?php
                                $act = $log['action'];
                                $badgeClass = 'bg-slate-100 text-slate-700 border-slate-200';
                                if ($act === 'LOGIN') {
                                    $badgeClass = 'bg-emerald-50 text-emerald-700 border-emerald-200';
                                } elseif ($act === 'LOGOUT') {
                                    $badgeClass = 'bg-amber-50 text-amber-700 border-amber-200';
                                } elseif ($act === 'USER_CREATE') {
                                    $badgeClass = 'bg-blue-50 text-blue-700 border-blue-200';
                                } elseif ($act === 'USER_UPDATE') {
                                    $badgeClass = 'bg-indigo-50 text-indigo-700 border-indigo-200';
                                } elseif ($act === 'USER_DELETE') {
                                    $badgeClass = 'bg-rose-50 text-rose-700 border-rose-200';
                                } elseif ($act === 'SETTINGS_UPDATE') {
                                    $badgeClass = 'bg-teal-50 text-teal-700 border-teal-200';
                                } elseif ($act === 'LOGS_CLEANUP') {
                                    $badgeClass = 'bg-purple-50 text-purple-700 border-purple-200';
                                }
                                ?>
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[10px] font-bold border <?= $badgeClass ?>">
                                    <?= esc($act) ?>
                                </span>
                            </td>
                            <td class="px-5 py-3.5 text-slate-800 leading-relaxed">
                                <?= esc($log['description']) ?>
                            </td>
                            <td class="px-5 py-3.5 text-right font-mono text-[11px] text-slate-500 whitespace-nowrap" title="<?= esc($log['user_agent'] ?? '') ?>">
                                <div class="inline-flex items-center gap-1.5">
                                    <i class="fa-solid fa-network-wired text-[10px] text-slate-400"></i>
                                    <span><?= esc($log['ip_address'] ?? '127.0.0.1') ?></span>
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
