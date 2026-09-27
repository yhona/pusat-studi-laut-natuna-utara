<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div x-data="adminTable({ defaultSortCol: 'order', defaultSortAsc: true, defaultPageSize: 9, defaultViewMode: 'table' })" class="space-y-5">
    
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2.5">
                <h2 class="text-xl font-extrabold text-navy-950">Kelola Banner & Slider Beranda</h2>
                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-navy-100 text-navy-800 font-mono">
                    <?= count($banners) ?> Slide
                </span>
            </div>
            <p class="text-xs text-slate-500 mt-0.5">
                Atur tayangan sorotan utama, agenda konferensi maritim, dan rekomendasi kebijakan di slider beranda web.
            </p>
        </div>
        <div class="flex items-center gap-2.5">
            <a href="<?= base_url() ?>" target="_blank"
               class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors shrink-0">
                <i class="fa-solid fa-arrow-up-right-from-square text-[11px]"></i>
                <span class="hidden sm:inline">Beranda Publik</span>
            </a>
            <a href="<?= base_url('admin/banners/create') ?>"
               class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-950 text-xs font-bold shadow-sm transition-all active:scale-[0.98] shrink-0">
                <i class="fa-solid fa-plus"></i>
                <span>Tambah Banner Slider</span>
            </a>
        </div>
    </div>

    <!-- Advanced Controls Toolbar -->
    <div class="bg-white rounded-2xl border border-slate-200 p-3 sm:p-4 shadow-xs space-y-3">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-3">
            
            <!-- Left: Search Box & Filters -->
            <div class="flex flex-wrap items-center gap-2.5 flex-1">
                <div class="relative flex-1 min-w-[220px]">
                    <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="search" x-model="search" data-table-search
                           placeholder="Cari judul banner, badge, tag, link..." 
                           class="w-full pl-9 pr-9 py-2 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-navy-900 bg-slate-50/70 focus:bg-white transition-all">
                    <button type="button" x-show="search" @click="search = ''" 
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 text-xs">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                    <kbd x-show="!search" class="hidden sm:inline-block absolute right-3 top-1/2 -translate-y-1/2 px-1.5 py-0.5 text-[9px] font-mono text-slate-400 bg-slate-100 rounded border border-slate-200">/</kbd>
                </div>

                <!-- Status Filter -->
                <select x-model="statusFilter" 
                        class="px-3 py-2 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-navy-900 bg-slate-50/70">
                    <option value="">Semua Status</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Nonaktif">Nonaktif</option>
                </select>

                <button type="button" x-show="hasActiveFilters" @click="resetFilters()" x-cloak
                        class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-semibold transition-colors">
                    <i class="fa-solid fa-rotate-left text-[10px]"></i>
                    <span>Reset</span>
                </button>
            </div>

            <!-- Right: View Switcher & Utilities -->
            <div class="flex items-center justify-end gap-2 border-t lg:border-t-0 pt-2 lg:pt-0">
                <!-- View Mode Switcher -->
                <div class="inline-flex items-center p-0.5 rounded-xl border border-slate-200 bg-slate-100 text-slate-600 text-xs">
                    <button type="button" @click="viewMode = 'table'" 
                            :class="viewMode === 'table' ? 'bg-white text-navy-950 font-bold shadow-xs' : 'text-slate-500 hover:text-slate-800'"
                            class="px-2.5 py-1.5 rounded-lg transition-all flex items-center gap-1.5" title="Tampilan Tabel Data">
                        <i class="fa-solid fa-table-list text-[11px]"></i>
                        <span class="hidden md:inline">Tabel</span>
                    </button>
                    <button type="button" @click="viewMode = 'grid'" 
                            :class="viewMode === 'grid' ? 'bg-white text-navy-950 font-bold shadow-xs' : 'text-slate-500 hover:text-slate-800'"
                            class="px-2.5 py-1.5 rounded-lg transition-all flex items-center gap-1.5" title="Tampilan Kartu Slider">
                        <i class="fa-solid fa-grip text-[11px]"></i>
                        <span class="hidden md:inline">Slider</span>
                    </button>
                </div>

                <!-- Density Switcher -->
                <div x-show="viewMode === 'table'" class="inline-flex items-center p-0.5 rounded-xl border border-slate-200 bg-slate-100 text-slate-600 text-xs">
                    <button type="button" @click="density = 'comfortable'" 
                            :class="density === 'comfortable' ? 'bg-white text-navy-950 font-bold shadow-xs' : 'text-slate-500 hover:text-slate-800'"
                            class="px-2 py-1.5 rounded-lg transition-all" title="Mode Tampilan Nyaman">
                        <i class="fa-solid fa-bars text-[11px]"></i>
                    </button>
                    <button type="button" @click="density = 'compact'" 
                            :class="density === 'compact' ? 'bg-white text-navy-950 font-bold shadow-xs' : 'text-slate-500 hover:text-slate-800'"
                            class="px-2 py-1.5 rounded-lg transition-all" title="Mode Tampilan Rapat / Padat">
                        <i class="fa-solid fa-table-cells-large text-[11px]"></i>
                    </button>
                </div>

                <!-- Export CSV -->
                <button type="button" @click="exportCSV('banner-slider-nnsrc.csv')" 
                        class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-semibold shadow-xs transition-colors"
                        title="Ekspor seluruh banner ke format CSV">
                    <i class="fa-solid fa-file-csv text-emerald-600 text-sm"></i>
                    <span class="hidden sm:inline">Ekspor CSV</span>
                </button>

                <!-- Print Button -->
                <button type="button" @click="printTable()" 
                        class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-semibold shadow-xs transition-colors"
                        title="Cetak tabel banner">
                    <i class="fa-solid fa-print text-slate-500 text-sm"></i>
                    <span class="hidden sm:inline">Cetak</span>
                </button>
            </div>

        </div>
    </div>

    <!-- TABLE VIEW -->
    <div x-show="viewMode === 'table'" class="bg-white rounded-3xl border border-slate-200 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table :class="density === 'compact' ? 'table-compact' : ''" 
                   class="w-full text-left text-xs text-slate-600 transition-all">
                <thead class="bg-slate-50/80 border-b border-slate-200 text-slate-700 font-bold uppercase text-[10px] tracking-wider select-none">
                    <tr>
                        <!-- Master Checkbox & Number -->
                        <th data-no-export class="py-3.5 px-4 w-12 text-center">
                            <div class="flex items-center justify-center">
                                <input type="checkbox" 
                                       :checked="allSelected" 
                                       :indeterminate.prop="someSelected" 
                                       @change="toggleSelectAll()" 
                                       class="rounded border-slate-300 text-navy-900 focus:ring-navy-900 cursor-pointer">
                            </div>
                        </th>

                        <!-- Sortable Columns -->
                        <th @click="sortBy('title', 'text')" class="py-3.5 px-4 cursor-pointer hover:bg-slate-100 transition-colors">
                            <div class="flex items-center gap-1.5">
                                <span>Preview & Judul Banner</span>
                                <span class="text-slate-400">
                                    <i x-show="sortCol !== 'title'" class="fa-solid fa-sort text-[10px]"></i>
                                    <i x-show="sortCol === 'title' && sortAsc" class="fa-solid fa-sort-up text-navy-900"></i>
                                    <i x-show="sortCol === 'title' && !sortAsc" class="fa-solid fa-sort-down text-navy-900"></i>
                                </span>
                            </div>
                        </th>

                        <th class="py-3.5 px-4 w-48">Badge / Tag</th>

                        <th class="py-3.5 px-4 w-40">Tautan Tombol</th>

                        <th @click="sortBy('order', 'number')" class="py-3.5 px-4 text-center cursor-pointer hover:bg-slate-100 transition-colors w-24">
                            <div class="flex items-center justify-center gap-1.5">
                                <span>Urutan</span>
                                <span class="text-slate-400">
                                    <i x-show="sortCol !== 'order'" class="fa-solid fa-sort text-[10px]"></i>
                                    <i x-show="sortCol === 'order' && sortAsc" class="fa-solid fa-sort-up text-navy-900"></i>
                                    <i x-show="sortCol === 'order' && !sortAsc" class="fa-solid fa-sort-down text-navy-900"></i>
                                </span>
                            </div>
                        </th>

                        <th @click="sortBy('status', 'text')" class="py-3.5 px-4 text-center cursor-pointer hover:bg-slate-100 transition-colors w-24">
                            <div class="flex items-center justify-center gap-1.5">
                                <span>Status</span>
                                <span class="text-slate-400">
                                    <i x-show="sortCol !== 'status'" class="fa-solid fa-sort text-[10px]"></i>
                                    <i x-show="sortCol === 'status' && sortAsc" class="fa-solid fa-sort-up text-navy-900"></i>
                                    <i x-show="sortCol === 'status' && !sortAsc" class="fa-solid fa-sort-down text-navy-900"></i>
                                </span>
                            </div>
                        </th>

                        <th data-no-export class="py-3.5 px-4 text-center w-28">Aksi</th>
                    </tr>
                </thead>
                <tbody data-table-body class="divide-y divide-slate-100">
                    <?php foreach ($banners as $idx => $b): 
                        $statusText = $b['is_active'] ? 'Aktif' : 'Nonaktif';
                    ?>
                    <tr data-table-row 
                        data-id="<?= $b['id'] ?>"
                        data-title="<?= esc($b['title']) ?>"
                        data-badge="<?= esc($b['badge']) ?>"
                        data-order="<?= (int)$b['order_seq'] ?>"
                        data-status="<?= esc($statusText) ?>"
                        data-search="<?= esc($b['title'] . ' ' . $b['badge'] . ' ' . ($b['tag'] ?? '') . ' ' . ($b['link_url'] ?? '') . ' ' . $b['desc']) ?>"
                        :class="isSelected('<?= $b['id'] ?>') ? 'bg-gold-50/50 hover:bg-gold-50/70' : 'hover:bg-slate-50/80'"
                        class="transition-colors">
                        
                        <!-- Row Checkbox & Number -->
                        <td data-no-export class="py-3.5 px-4 text-center font-mono text-[11px] text-slate-400">
                            <div class="flex items-center justify-center gap-2">
                                <input type="checkbox" 
                                       :checked="isSelected('<?= $b['id'] ?>')" 
                                       @change="toggleRow('<?= $b['id'] ?>')" 
                                       class="rounded border-slate-300 text-navy-900 focus:ring-navy-900 cursor-pointer">
                                <span class="hidden sm:inline"><?= $idx + 1 ?></span>
                            </div>
                        </td>

                        <!-- Thumbnail & Title -->
                        <td class="py-3.5 px-4 min-w-[280px]">
                            <div class="flex items-center gap-3">
                                <div class="w-16 h-10 rounded-lg overflow-hidden bg-navy-950 shrink-0 border border-slate-200">
                                    <img src="<?= base_url(esc($b['image'])) ?>" alt="<?= esc($b['title']) ?>" class="w-full h-full object-cover">
                                </div>
                                <div class="space-y-0.5">
                                    <div class="font-bold text-navy-950 leading-snug line-clamp-1"><?= esc($b['title']) ?></div>
                                    <p class="text-[11px] text-slate-500 line-clamp-1"><?= esc($b['desc']) ?></p>
                                </div>
                            </div>
                        </td>

                        <!-- Badge / Tag -->
                        <td class="py-3.5 px-4">
                            <div class="flex flex-wrap items-center gap-1.5">
                                <span class="px-2 py-0.5 rounded bg-gold-50 text-gold-800 border border-gold-200 text-[10px] font-bold">
                                    <?= esc($b['badge']) ?>
                                </span>
                                <?php if (!empty($b['tag'])): ?>
                                <span class="px-1.5 py-0.5 rounded bg-slate-100 text-slate-600 text-[10px]">
                                    <i class="fa-solid fa-tag text-[9px] mr-1 text-slate-400"></i><?= esc($b['tag']) ?>
                                </span>
                                <?php endif; ?>
                            </div>
                        </td>

                        <!-- Link URL -->
                        <td class="py-3.5 px-4 font-mono text-[11px] text-slate-500 truncate max-w-[160px]">
                            <?= esc($b['link_url'] ?: '/') ?>
                        </td>

                        <!-- Order -->
                        <td class="py-3.5 px-4 text-center font-mono text-xs font-bold text-slate-600">
                            #<?= esc($b['order_seq']) ?>
                        </td>

                        <!-- Status -->
                        <td class="py-3.5 px-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold font-mono <?= $b['is_active'] ? 'bg-emerald-100 text-emerald-800 border border-emerald-200' : 'bg-slate-100 text-slate-600 border border-slate-200' ?>">
                                <?= $statusText ?>
                            </span>
                        </td>

                        <!-- Actions -->
                        <td data-no-export class="py-3.5 px-4 text-center">
                            <div class="flex items-center justify-center gap-1.5">
                                <a href="<?= base_url('admin/banners/edit/' . $b['id']) ?>" 
                                   class="p-1.5 px-2 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 transition-colors" title="Edit Banner">
                                    <i class="fa-solid fa-pen-to-square text-xs"></i>
                                </a>
                                <form action="<?= base_url('admin/banners/delete/' . $b['id']) ?>" method="POST" onsubmit="return confirm('Hapus banner slider ini?');" class="inline">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="p-1.5 px-2 rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-700 transition-colors" title="Hapus Banner">
                                        <i class="fa-regular fa-trash-can text-xs"></i>
                                    </button>
                                </form>
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
                                <h4 class="text-sm font-bold text-navy-950 mb-1">Tidak Ada Banner yang Cocok</h4>
                                <p class="text-xs text-slate-500 mb-4">Tidak ditemukan banner slider yang sesuai dengan kata kunci pencarian Anda.</p>
                                <button type="button" @click="resetFilters()" 
                                        class="px-3.5 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors">
                                    Reset Filter
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Table Footer / Pagination -->
        <div class="p-4 border-t border-slate-200 bg-slate-50/50 flex flex-col sm:flex-row sm:items-center justify-between gap-4 text-xs text-slate-600">
            <!-- Left Info -->
            <div>
                Menampilkan <span class="font-bold text-navy-950" x-text="pageStart"></span> - <span class="font-bold text-navy-950" x-text="pageEnd"></span> dari <span class="font-bold text-navy-950" x-text="filteredCount"></span> slide
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
                        <option value="6">6</option>
                        <option value="9">9</option>
                        <option value="18">18</option>
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

    <!-- BANNERS SLIDER GRID VIEW -->
    <div x-show="viewMode === 'grid'" x-cloak class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($banners as $b): ?>
        <div class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-xs flex flex-col justify-between hover:border-maritime-500 hover:shadow-md transition-all">
            <!-- Preview Image -->
            <div class="h-44 relative bg-navy-950 overflow-hidden">
                <img src="<?= base_url(esc($b['image'])) ?>" alt="<?= esc($b['title']) ?>" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-navy-950/80 via-transparent to-black/20"></div>
                <div class="absolute top-3 left-3 right-3 flex items-center justify-between gap-2">
                    <span class="px-2.5 py-1 rounded bg-gold-500/90 text-navy-950 text-[10px] font-bold uppercase tracking-wider shadow-sm">
                        <?= esc($b['badge']) ?>
                    </span>
                    <span class="px-2 py-0.5 rounded text-[10px] font-bold font-mono <?= $b['is_active'] ? 'bg-emerald-500/90 text-white' : 'bg-slate-700 text-slate-300' ?>">
                        <?= $b['is_active'] ? 'Aktif' : 'Nonaktif' ?>
                    </span>
                </div>
                <?php if (!empty($b['tag'])): ?>
                <div class="absolute bottom-3 left-3 text-white text-[11px] font-medium flex items-center gap-1.5">
                    <i class="fa-solid fa-tag text-gold-400 text-xs"></i>
                    <span><?= esc($b['tag']) ?></span>
                </div>
                <?php endif; ?>
            </div>

            <!-- Content -->
            <div class="p-5 flex-grow flex flex-col justify-between space-y-3">
                <div class="space-y-2">
                    <h3 class="text-sm font-bold text-navy-950 leading-snug line-clamp-2">
                        <?= esc($b['title']) ?>
                    </h3>
                    <p class="text-xs text-slate-600 line-clamp-3 leading-relaxed">
                        <?= esc($b['desc']) ?>
                    </p>
                </div>

                <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-500">
                    <span>Urutan: #<?= esc($b['order_seq']) ?></span>
                    <span class="font-mono text-slate-400 truncate max-w-[150px]">Link: <?= esc($b['link_url'] ?: '/') ?></span>
                </div>
            </div>

            <!-- Actions -->
            <div class="px-5 pb-5 pt-0 flex items-center justify-end gap-2 border-t border-slate-50">
                <a href="<?= base_url('admin/banners/edit/' . $b['id']) ?>" 
                   class="px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors">
                    <i class="fa-solid fa-pen-to-square mr-1"></i> Edit
                </a>
                <form action="<?= base_url('admin/banners/delete/' . $b['id']) ?>" method="POST" onsubmit="return confirm('Hapus banner slider ini?');">
                    <?= csrf_field() ?>
                    <button type="submit" class="px-3 py-1.5 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-semibold transition-colors">
                        <i class="fa-regular fa-trash-can mr-1"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Floating Bulk Selection Bar -->
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
            <span class="font-medium text-slate-200">banner dipilih</span>
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
