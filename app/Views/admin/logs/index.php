<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div x-data="adminTable({ defaultSortCol: 'id', defaultSortAsc: false, defaultPageSize: 25 })" class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2.5">
                <h2 class="text-xl font-extrabold text-navy-950">Audit Trail & Log Aktivitas Admin</h2>
                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-navy-100 text-navy-800 font-mono">
                    <?= count($logs) ?> Catatan
                </span>
            </div>
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
    <div class="bg-white rounded-2xl p-4 sm:p-5 border border-slate-200 shadow-xs space-y-3">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-3 text-xs">
            <!-- Server-Side + Client-Side Unified Search -->
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
                    <input type="text" name="q" value="<?= esc($searchQuery) ?>" x-model="search" data-table-search
                           placeholder="Filter cepat deskripsi, administrator, atau IP..."
                           class="w-full pl-9 pr-9 py-2 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-navy-900 bg-slate-50/70 focus:bg-white transition-all">
                    <button type="button" x-show="search" @click="search = ''" 
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 text-xs">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                    <kbd x-show="!search" class="hidden sm:inline-block absolute right-3 top-1/2 -translate-y-1/2 px-1.5 py-0.5 text-[9px] font-mono text-slate-400 bg-slate-100 rounded border border-slate-200">/</kbd>
                </div>

                <button type="submit" class="px-4 py-2 rounded-xl bg-navy-950 text-white font-bold hover:bg-navy-900 transition-colors">
                    Filter Server
                </button>

                <?php if (!empty($actionFilter) || !empty($searchQuery)): ?>
                    <a href="<?= base_url('admin/logs') ?>" class="px-3.5 py-2 rounded-xl bg-slate-100 text-slate-600 hover:bg-slate-200 transition-colors font-medium">
                        Reset Filter Server
                    </a>
                <?php endif; ?>
            </form>

            <!-- Table Utilities (Density, CSV Export, Print) -->
            <div class="flex items-center justify-end gap-2 border-t lg:border-t-0 pt-2 lg:pt-0">
                <!-- Density Switcher -->
                <div class="inline-flex items-center p-0.5 rounded-xl border border-slate-200 bg-slate-100 text-slate-600 text-xs">
                    <button type="button" @click="density = 'comfortable'" 
                            :class="density === 'comfortable' ? 'bg-white text-navy-950 font-bold shadow-xs' : 'text-slate-500 hover:text-slate-800'"
                            class="px-2.5 py-1.5 rounded-lg transition-all" title="Mode Tampilan Nyaman">
                        <i class="fa-solid fa-bars text-[11px]"></i>
                    </button>
                    <button type="button" @click="density = 'compact'" 
                            :class="density === 'compact' ? 'bg-white text-navy-950 font-bold shadow-xs' : 'text-slate-500 hover:text-slate-800'"
                            class="px-2.5 py-1.5 rounded-lg transition-all" title="Mode Tampilan Rapat / Padat (Rekomendasi Audit Log)">
                        <i class="fa-solid fa-table-cells-large text-[11px]"></i>
                    </button>
                </div>

                <!-- Export CSV -->
                <button type="button" @click="exportCSV('audit-log-nnsrc.csv')" 
                        class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-semibold shadow-xs transition-colors"
                        title="Ekspor catatan log ke CSV">
                    <i class="fa-solid fa-file-csv text-emerald-600 text-sm"></i>
                    <span class="hidden sm:inline">Ekspor CSV</span>
                </button>

                <!-- Print -->
                <button type="button" @click="printTable()" 
                        class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-semibold shadow-xs transition-colors"
                        title="Cetak log audit">
                    <i class="fa-solid fa-print text-slate-500 text-sm"></i>
                    <span class="hidden sm:inline">Cetak</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Logs Table Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table :class="density === 'compact' ? 'table-compact' : ''" 
                   class="w-full text-left text-xs text-slate-600 transition-all">
                <thead class="bg-slate-50/80 text-slate-700 uppercase font-bold text-[10px] border-b border-slate-200 tracking-wider select-none">
                    <tr>
                        <!-- Master Checkbox & ID -->
                        <th data-no-export class="py-3.5 px-4 w-12 text-center">
                            <div class="flex items-center justify-center">
                                <input type="checkbox" 
                                       :checked="allSelected" 
                                       :indeterminate.prop="someSelected" 
                                       @change="toggleSelectAll()" 
                                       class="rounded border-slate-300 text-navy-900 focus:ring-navy-900 cursor-pointer">
                            </div>
                        </th>

                        <th @click="sortBy('id', 'number')" class="px-5 py-3.5 w-20 cursor-pointer hover:bg-slate-100 transition-colors">
                            <div class="flex items-center gap-1.5">
                                <span>#ID</span>
                                <span class="text-slate-400">
                                    <i x-show="sortCol !== 'id'" class="fa-solid fa-sort text-[10px]"></i>
                                    <i x-show="sortCol === 'id' && sortAsc" class="fa-solid fa-sort-up text-navy-900"></i>
                                    <i x-show="sortCol === 'id' && !sortAsc" class="fa-solid fa-sort-down text-navy-900"></i>
                                </span>
                            </div>
                        </th>

                        <th @click="sortBy('date', 'date')" class="px-5 py-3.5 w-44 cursor-pointer hover:bg-slate-100 transition-colors">
                            <div class="flex items-center gap-1.5">
                                <span>Waktu Kejadian</span>
                                <span class="text-slate-400">
                                    <i x-show="sortCol !== 'date'" class="fa-solid fa-sort text-[10px]"></i>
                                    <i x-show="sortCol === 'date' && sortAsc" class="fa-solid fa-sort-up text-navy-900"></i>
                                    <i x-show="sortCol === 'date' && !sortAsc" class="fa-solid fa-sort-down text-navy-900"></i>
                                </span>
                            </div>
                        </th>

                        <th @click="sortBy('admin', 'text')" class="px-5 py-3.5 w-44 cursor-pointer hover:bg-slate-100 transition-colors">
                            <div class="flex items-center gap-1.5">
                                <span>Administrator</span>
                                <span class="text-slate-400">
                                    <i x-show="sortCol !== 'admin'" class="fa-solid fa-sort text-[10px]"></i>
                                    <i x-show="sortCol === 'admin' && sortAsc" class="fa-solid fa-sort-up text-navy-900"></i>
                                    <i x-show="sortCol === 'admin' && !sortAsc" class="fa-solid fa-sort-down text-navy-900"></i>
                                </span>
                            </div>
                        </th>

                        <th @click="sortBy('action', 'text')" class="px-5 py-3.5 w-36 cursor-pointer hover:bg-slate-100 transition-colors">
                            <div class="flex items-center gap-1.5">
                                <span>Jenis Aksi</span>
                                <span class="text-slate-400">
                                    <i x-show="sortCol !== 'action'" class="fa-solid fa-sort text-[10px]"></i>
                                    <i x-show="sortCol === 'action' && sortAsc" class="fa-solid fa-sort-up text-navy-900"></i>
                                    <i x-show="sortCol === 'action' && !sortAsc" class="fa-solid fa-sort-down text-navy-900"></i>
                                </span>
                            </div>
                        </th>

                        <th class="px-5 py-3.5">Detail Aktivitas</th>

                        <th @click="sortBy('ip', 'text')" class="px-5 py-3.5 w-36 text-right cursor-pointer hover:bg-slate-100 transition-colors">
                            <div class="flex items-center justify-end gap-1.5">
                                <span>Alamat IP</span>
                                <span class="text-slate-400">
                                    <i x-show="sortCol !== 'ip'" class="fa-solid fa-sort text-[10px]"></i>
                                    <i x-show="sortCol === 'ip' && sortAsc" class="fa-solid fa-sort-up text-navy-900"></i>
                                    <i x-show="sortCol === 'ip' && !sortAsc" class="fa-solid fa-sort-down text-navy-900"></i>
                                </span>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody data-table-body class="divide-y divide-slate-100 font-medium">
                    <?php if (empty($logs)): ?>
                    <tr>
                        <td colspan="7" class="px-5 py-12 text-center text-slate-400">
                            <i class="fa-solid fa-clipboard-list text-3xl mb-2 text-slate-300 block"></i>
                            <span>Tidak ditemukan riwayat log aktivitas yang sesuai kriteria pencarian.</span>
                        </td>
                    </tr>
                    <?php else: ?>
                        <?php foreach ($logs as $log): ?>
                        <tr data-table-row
                            data-id="<?= $log['id'] ?>"
                            data-date="<?= esc($log['created_at']) ?>"
                            data-admin="<?= esc($log['admin_name'] ?? 'System') ?>"
                            data-action="<?= esc($log['action']) ?>"
                            data-ip="<?= esc($log['ip_address'] ?? '127.0.0.1') ?>"
                            data-search="<?= esc($log['id'] . ' ' . ($log['admin_name'] ?? 'System') . ' ' . $log['action'] . ' ' . $log['description'] . ' ' . ($log['ip_address'] ?? '')) ?>"
                            :class="isSelected('<?= $log['id'] ?>') ? 'bg-gold-50/50 hover:bg-gold-50/70' : 'hover:bg-slate-50/70'"
                            class="transition-colors">
                            
                            <!-- Checkbox -->
                            <td data-no-export class="py-3.5 px-4 text-center font-mono text-[11px] text-slate-400">
                                <input type="checkbox" 
                                       :checked="isSelected('<?= $log['id'] ?>')" 
                                       @change="toggleRow('<?= $log['id'] ?>')" 
                                       class="rounded border-slate-300 text-navy-900 focus:ring-navy-900 cursor-pointer">
                            </td>

                            <!-- ID -->
                            <td class="px-5 py-3.5 font-mono text-slate-400 text-[11px]">
                                #<?= $log['id'] ?>
                            </td>

                            <!-- Timestamp -->
                            <td class="px-5 py-3.5 whitespace-nowrap text-slate-500">
                                <?= date('d M Y, H:i:s', strtotime($log['created_at'])) ?>
                            </td>

                            <!-- Administrator -->
                            <td class="px-5 py-3.5">
                                <div class="font-bold text-navy-950 flex items-center gap-1.5">
                                    <i class="fa-solid fa-user-shield text-slate-400 text-[10px]"></i>
                                    <span><?= esc($log['admin_name'] ?? 'System') ?></span>
                                </div>
                                <?php if (!empty($log['admin_id'])): ?>
                                    <span class="text-[10px] text-slate-400 font-mono">UID: <?= $log['admin_id'] ?></span>
                                <?php endif; ?>
                            </td>

                            <!-- Action Badge -->
                            <td class="px-5 py-3.5 whitespace-nowrap">
                                <?php
                                $act = $log['action'];
                                $badgeClass = 'bg-slate-100 text-slate-700 border-slate-200';
                                if ($act === 'LOGIN') {
                                    $badgeClass = 'bg-emerald-50 text-emerald-700 border-emerald-200';
                                } elseif ($act === 'LOGIN_FAILED') {
                                    $badgeClass = 'bg-rose-50 text-rose-700 border-rose-200';
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

                            <!-- Description -->
                            <td class="px-5 py-3.5 text-slate-800 leading-relaxed">
                                <?= esc($log['description']) ?>
                            </td>

                            <!-- IP Address -->
                            <td class="px-5 py-3.5 text-right font-mono text-[11px] text-slate-500 whitespace-nowrap" title="<?= esc($log['user_agent'] ?? '') ?>">
                                <div class="inline-flex items-center gap-1.5">
                                    <i class="fa-solid fa-network-wired text-[10px] text-slate-400"></i>
                                    <span><?= esc($log['ip_address'] ?? '127.0.0.1') ?></span>
                                    <button type="button" @click="copyToClipboard('<?= esc($log['ip_address'] ?? '127.0.0.1') ?>', 'IP Address')" 
                                            class="text-slate-400 hover:text-slate-700 transition-colors" title="Salin IP">
                                        <i class="fa-regular fa-copy text-[9px]"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>

                        <!-- No Match Filter Empty State -->
                        <tr data-table-nomatch style="display: none;">
                            <td colspan="7" class="py-12 px-4 text-center">
                                <div class="flex flex-col items-center justify-center max-w-sm mx-auto">
                                    <div class="w-12 h-12 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mb-3 text-xl">
                                        <i class="fa-solid fa-filter-circle-xmark"></i>
                                    </div>
                                    <h4 class="text-sm font-bold text-navy-950 mb-1">Tidak Ada Log yang Cocok</h4>
                                    <p class="text-xs text-slate-500 mb-4">Tidak ditemukan entri log aktivitas yang cocok dengan kata kunci pencarian Anda.</p>
                                    <button type="button" @click="resetFilters()" 
                                            class="px-3.5 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors">
                                        Reset Filter Pencarian
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Table Footer / Pagination -->
        <div class="p-4 border-t border-slate-200 bg-slate-50/50 flex flex-col sm:flex-row sm:items-center justify-between gap-4 text-xs text-slate-600">
            <!-- Left Info -->
            <div>
                Menampilkan <span class="font-bold text-navy-950" x-text="pageStart"></span> - <span class="font-bold text-navy-950" x-text="pageEnd"></span> dari <span class="font-bold text-navy-950" x-text="filteredCount"></span> catatan
                <span x-show="filteredCount < totalRows" x-cloak class="text-slate-400">
                    (difilter dari <span x-text="totalRows"></span> total)
                </span>
            </div>

            <!-- Middle / Right Pagination & Sizer -->
            <div class="flex flex-wrap items-center gap-3">
                <!-- Page Size Selector -->
                <div class="flex items-center gap-1.5">
                    <span class="text-slate-500 text-[11px]">Baris:</span>
                    <select x-model="pageSize" class="px-2 py-1 rounded-lg border border-slate-200 text-xs bg-white focus:outline-none">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="-1">Semua</option>
                    </select>
                </div>

                <!-- Pagination Buttons -->
                <div class="inline-flex items-center gap-1" x-show="totalPages > 1" x-cloak>
                    <!-- Prev -->
                    <button type="button" @click="prevPage()" :disabled="currentPage === 1"
                            :class="currentPage === 1 ? 'opacity-40 cursor-not-allowed text-slate-400' : 'hover:bg-slate-200 text-slate-700'"
                            class="p-1.5 px-2.5 rounded-lg border border-slate-200 bg-white transition-colors">
                        <i class="fa-solid fa-chevron-left text-[10px]"></i>
                    </button>

                    <!-- Page Numbers -->
                    <template x-for="p in pageNumbers" :key="p">
                        <button type="button" 
                                @click="goToPage(p)"
                                :disabled="p === '...'"
                                :class="p === currentPage ? 'bg-navy-950 text-white font-bold' : (p === '...' ? 'cursor-default text-slate-400 border-none' : 'bg-white hover:bg-slate-100 text-slate-700 border border-slate-200')"
                                class="w-7 h-7 rounded-lg text-xs flex items-center justify-center transition-colors">
                            <span x-text="p"></span>
                        </button>
                    </template>

                    <!-- Next -->
                    <button type="button" @click="nextPage()" :disabled="currentPage === totalPages"
                            :class="currentPage === totalPages ? 'opacity-40 cursor-not-allowed text-slate-400' : 'hover:bg-slate-200 text-slate-700'"
                            class="p-1.5 px-2.5 rounded-lg border border-slate-200 bg-white transition-colors">
                        <i class="fa-solid fa-chevron-right text-[10px]"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Bulk Selection Action Bar -->
    <div x-show="selectedIds.length > 0" x-cloak 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-8"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-8"
         class="fixed bottom-6 left-1/2 -translate-x-1/2 z-40 bg-navy-950 text-white px-5 py-3 rounded-2xl shadow-2xl border border-gold-500/40 flex items-center gap-4 text-xs">
        <div class="flex items-center gap-2">
            <span class="w-6 h-6 rounded-full bg-gold-500 text-navy-950 font-bold flex items-center justify-center text-[11px]" x-text="selectedIds.length"></span>
            <span class="font-medium text-slate-200">log dipilih</span>
        </div>
        <div class="h-4 w-px bg-white/20"></div>
        <div class="flex items-center gap-2">
            <button type="button" @click="copySelectedIds()" 
                    class="px-3 py-1.5 rounded-xl bg-white/10 hover:bg-white/20 text-white font-medium transition-colors flex items-center gap-1.5">
                <i class="fa-regular fa-copy text-[11px]"></i>
                <span>Salin ID</span>
            </button>
            <button type="button" @click="clearSelection()" 
                    class="px-3 py-1.5 rounded-xl hover:bg-white/10 text-slate-300 hover:text-white font-medium transition-colors">
                Batal
            </button>
        </div>
    </div>

    <!-- Toast Notification Container -->
    <div x-show="toast.show" x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 translate-y-2 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-2 scale-95"
         class="fixed bottom-6 right-6 z-50 bg-navy-950 text-white px-4 py-2.5 rounded-xl shadow-xl border border-gold-500/40 flex items-center gap-2.5 text-xs font-medium">
        <i class="fa-solid fa-circle-check text-gold-400 text-sm"></i>
        <span x-text="toast.message"></span>
    </div>
</div>

<?= $this->endSection() ?>
