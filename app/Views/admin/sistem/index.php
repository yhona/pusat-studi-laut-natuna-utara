<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-extrabold text-navy-950">Status Sistem & Otomatisasi 20 Menit</h2>
            <p class="text-xs text-slate-500 mt-1">
                Pantau kesehatan server, antrean email otomatisasi, status integritas basis data, dan riwayat cron daemon.
            </p>
        </div>
        <div class="flex items-center gap-2">
            <form action="<?= base_url('admin/sistem/clear-cache') ?>" method="POST">
                <?= csrf_field() ?>
                <button type="submit" 
                        class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors cursor-pointer">
                    <i class="fa-solid fa-broom"></i>
                    <span>Bersihkan Cache</span>
                </button>
            </form>
            <form action="<?= base_url('admin/cron/run') ?>" method="POST">
                <?= csrf_field() ?>
                <button type="submit" 
                        class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-950 text-xs font-bold shadow-xs transition-colors cursor-pointer">
                    <i class="fa-solid fa-arrows-rotate"></i>
                    <span>Jalankan Cron (20-Min)</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Status Cron 20-Menit Banner -->
    <div class="bg-gradient-to-r from-navy-950 via-navy-900 to-maritime-900 rounded-2xl p-6 text-white border border-slate-800 shadow-md">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-2">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 text-xs font-semibold">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    Cronjob Interval: 20 Menit (*/20 * * * *)
                </div>
                <h3 class="text-lg font-bold text-white">Pemeliharaan Terjadwal Latar Belakang</h3>
                <p class="text-xs text-slate-300 leading-relaxed max-w-xl">
                    Sistem menjalankan pembersihan berkala, pemrosesan antrean notifikasi permohonan unduh ke pemilik naskah, dan verifikasi integritas data secara otomatis setiap 20 menit.
                </p>
            </div>

            <div class="bg-white/10 backdrop-blur-md p-4 rounded-xl border border-white/15 space-y-2 text-xs shrink-0 min-w-[220px]">
                <div class="flex justify-between text-slate-300">
                    <span>Status Terakhir:</span>
                    <span class="font-bold text-emerald-400"><?= $cronStatus['status'] ?? 'STANDBY' ?></span>
                </div>
                <div class="flex justify-between text-slate-300">
                    <span>Waktu Eksekusi:</span>
                    <span class="font-mono text-white font-bold"><?= $cronStatus ? esc($cronStatus['last_run_human']) : '-' ?></span>
                </div>
                <div class="flex justify-between text-slate-300">
                    <span>Durasi:</span>
                    <span class="font-mono text-gold-400"><?= $cronStatus ? esc($cronStatus['duration_sec']) . 's' : '-' ?></span>
                </div>
            </div>
        </div>

        <?php if (!empty($cronStatus['tasks'])): ?>
            <div class="mt-4 pt-4 border-t border-white/10 grid grid-cols-1 sm:grid-cols-3 gap-3 text-xs">
                <?php foreach ($cronStatus['tasks'] as $t): ?>
                    <div class="flex items-center gap-2 bg-white/5 rounded-lg px-3 py-2 text-slate-200">
                        <i class="fa-solid fa-circle-check text-emerald-400 text-xs shrink-0"></i>
                        <span class="truncate"><?= esc($t) ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- System Diagnostics Grid -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs space-y-1">
            <span class="text-[11px] text-slate-400 uppercase font-bold tracking-wider">Versi PHP & Engine</span>
            <div class="text-base font-extrabold text-navy-950 font-mono">PHP <?= esc($systemInfo['php_version']) ?></div>
            <span class="text-[11px] text-slate-500 block">CI <?= esc($systemInfo['ci_version']) ?></span>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs space-y-1">
            <span class="text-[11px] text-slate-400 uppercase font-bold tracking-wider">Basis Data (SQLite3)</span>
            <div class="text-base font-extrabold text-navy-950 font-mono"><?= esc($systemInfo['db_size']) ?></div>
            <span class="text-[11px] text-emerald-600 font-semibold block"><i class="fa-solid fa-check"></i> Terkoneksi & Sehat</span>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs space-y-1">
            <span class="text-[11px] text-slate-400 uppercase font-bold tracking-wider">Berkas Cache Aktif</span>
            <div class="text-base font-extrabold text-navy-950 font-mono"><?= esc($systemInfo['cache_files']) ?> berkas</div>
            <span class="text-[11px] text-slate-500 block">writable/cache/</span>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs space-y-1">
            <span class="text-[11px] text-slate-400 uppercase font-bold tracking-wider">Penggunaan Memori</span>
            <div class="text-base font-extrabold text-navy-950 font-mono"><?= esc($systemInfo['memory_usage']) ?></div>
            <span class="text-[11px] text-slate-500 block">Memory Allocation</span>
        </div>
    </div>

    <!-- Recent Logs Console -->
    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs space-y-3">
        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-terminal text-gold-500 text-sm"></i>
                <h3 class="text-sm font-bold text-navy-950">Riwayat Catatan Eksekusi Cronjob 20 Menit</h3>
            </div>
            <span class="text-[10px] font-mono text-slate-400">writable/logs/cron_maintenance.log</span>
        </div>

        <div class="bg-slate-950 rounded-xl p-4 font-mono text-xs text-slate-300 max-h-72 overflow-y-auto space-y-1 leading-relaxed">
            <?php if (!empty($recentLogs)): ?>
                <?php foreach ($recentLogs as $log): ?>
                    <div class="hover:text-gold-300 transition-colors">
                        <span class="text-slate-500">&gt;</span> <?= esc($log) ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-slate-500 italic">Belum ada riwayat catatan eksekusi cron tersimpan.</div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
