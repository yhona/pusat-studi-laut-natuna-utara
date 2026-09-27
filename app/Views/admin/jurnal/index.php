<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<?php if (empty($journals)): ?>
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-extrabold text-navy-950">Kelola Jurnal Ilmiah Kemaritiman</h2>
            <p class="text-xs text-slate-500 mt-1">
                Kelola direktori berkala ilmiah, akreditasi SINTA, nomor ISSN, serta tautan portal OJS resmi UMRAH.
            </p>
        </div>
        <a href="<?= base_url('admin/jurnal/create') ?>"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-950 text-xs font-bold shadow-sm transition-all active:scale-[0.98] shrink-0">
            <i class="fa-solid fa-plus"></i>
            <span>Tambah Jurnal Baru</span>
        </a>
    </div>

    <div class="bg-white rounded-2xl p-12 text-center border border-slate-200 shadow-xs">
        <div class="w-16 h-16 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-4 text-2xl">
            <i class="fa-regular fa-folder-open"></i>
        </div>
        <h3 class="text-base font-bold text-navy-950 mb-1">Belum Ada Data Jurnal Ilmiah</h3>
        <p class="text-xs text-slate-500 mb-6">Tambahkan data jurnal kemaritiman pertama Anda melalui tombol di bawah.</p>
        <a href="<?= base_url('admin/jurnal/create') ?>"
           class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-950 text-xs font-bold shadow-sm transition-all">
            <i class="fa-solid fa-plus"></i>
            <span>Tambah Jurnal Pertama</span>
        </a>
    </div>
</div>
<?php else: ?>

<div x-data="adminTable({ defaultSortCol: 'name', defaultSortAsc: true, defaultPageSize: 10, defaultViewMode: 'table' })" class="space-y-5">
    
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2.5">
                <h2 class="text-xl font-extrabold text-navy-950">Kelola Jurnal Ilmiah Kemaritiman</h2>
                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-navy-100 text-navy-800 font-mono">
                    <?= count($journals) ?> Jurnal
                </span>
            </div>
            <p class="text-xs text-slate-500 mt-0.5">
                Kelola direktori berkala ilmiah, akreditasi SINTA, nomor ISSN, serta tautan portal OJS resmi UMRAH.
            </p>
        </div>
        <div class="flex items-center gap-2.5">
            <a href="<?= base_url('publikasi#jurnal') ?>" target="_blank"
               class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors shrink-0">
                <i class="fa-solid fa-arrow-up-right-from-square text-[11px]"></i>
                <span class="hidden sm:inline">Halaman Publik</span>
            </a>
            <a href="<?= base_url('admin/jurnal/create') ?>"
               class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-950 text-xs font-bold shadow-sm transition-all active:scale-[0.98] shrink-0">
                <i class="fa-solid fa-plus"></i>
                <span>Tambah Jurnal Baru</span>
            </a>
        </div>
    </div>

    <!-- Summary Metrics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-xs flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-maritime-50 text-maritime-600 flex items-center justify-center text-xl shrink-0">
                <i class="fa-solid fa-book-bookmark"></i>
            </div>
            <div>
                <span class="text-xs text-slate-500 font-medium">Total Jurnal Ilmiah</span>
                <h4 class="text-xl font-extrabold text-navy-950"><?= esc($totalCount ?? count($journals)) ?></h4>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-xs flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-gold-50 text-gold-600 flex items-center justify-center text-xl shrink-0">
                <i class="fa-solid fa-award"></i>
            </div>
            <div>
                <span class="text-xs text-slate-500 font-medium">Terakreditasi SINTA</span>
                <h4 class="text-xl font-extrabold text-navy-950"><?= esc($sintaCount ?? 0) ?></h4>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-xs flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl shrink-0">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div>
                <span class="text-xs text-slate-500 font-medium">Status Publikasi Aktif</span>
                <h4 class="text-xl font-extrabold text-navy-950"><?= esc($activeCount ?? 0) ?></h4>
            </div>
        </div>
    </div>

    <!-- Advanced Controls Toolbar -->
    <div class="bg-white rounded-2xl border border-slate-200 p-3 sm:p-4 shadow-xs space-y-3">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-3">
            
            <!-- Left: Search & Filter Inputs -->
            <div class="flex flex-wrap items-center gap-2.5 flex-1">
                <!-- Search Box -->
                <div class="relative flex-1 min-w-[220px]">
                    <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="search" x-model="search" data-table-search
                           placeholder="Cari nama jurnal, ISSN, indeksasi, deskripsi..." 
                           class="w-full pl-9 pr-9 py-2 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-navy-900 bg-slate-50/70 focus:bg-white transition-all">
                    <!-- Clear search button -->
                    <button type="button" x-show="search" @click="search = ''" 
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 text-xs">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                    <!-- Keyboard shortcut hint -->
                    <kbd x-show="!search" class="hidden sm:inline-block absolute right-3 top-1/2 -translate-y-1/2 px-1.5 py-0.5 text-[9px] font-mono text-slate-400 bg-slate-100 rounded border border-slate-200">/</kbd>
                </div>

                <!-- Indexing Filter -->
                <?php 
                    $indexings = array_unique(array_filter(array_column($journals, 'indexing')));
                    sort($indexings);
                ?>
                <select x-model="categoryFilter" 
                        class="px-3 py-2 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-navy-900 bg-slate-50/70">
                    <option value="">Semua Indeksasi</option>
                    <?php foreach ($indexings as $idx): ?>
                        <option value="<?= esc($idx) ?>"><?= esc($idx) ?></option>
                    <?php endforeach; ?>
                </select>

                <!-- Status Filter -->
                <select x-model="statusFilter" 
                        class="px-3 py-2 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-navy-900 bg-slate-50/70">
                    <option value="">Semua Status</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Nonaktif">Nonaktif</option>
                </select>

                <!-- Reset Filters Button -->
                <button type="button" x-show="hasActiveFilters" @click="resetFilters()" x-cloak
                        class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-semibold transition-colors">
                    <i class="fa-solid fa-rotate-left text-[10px]"></i>
                    <span>Reset</span>
                </button>
            </div>

            <!-- Right: View Switcher & Utilities -->
            <div class="flex items-center justify-end gap-2 border-t lg:border-t-0 pt-2 lg:pt-0">
                <!-- View Mode Switcher (Table vs Grid) -->
                <div class="inline-flex items-center p-0.5 rounded-xl border border-slate-200 bg-slate-100 text-slate-600 text-xs">
                    <button type="button" @click="viewMode = 'table'" 
                            :class="viewMode === 'table' ? 'bg-white text-navy-950 font-bold shadow-xs' : 'text-slate-500 hover:text-slate-800'"
                            class="px-2.5 py-1.5 rounded-lg transition-all flex items-center gap-1.5" title="Tampilan Tabel Data">
                        <i class="fa-solid fa-table-list text-[11px]"></i>
                        <span class="hidden md:inline">Tabel</span>
                    </button>
                    <button type="button" @click="viewMode = 'grid'" 
                            :class="viewMode === 'grid' ? 'bg-white text-navy-950 font-bold shadow-xs' : 'text-slate-500 hover:text-slate-800'"
                            class="px-2.5 py-1.5 rounded-lg transition-all flex items-center gap-1.5" title="Tampilan Kartu Grid">
                        <i class="fa-solid fa-grip text-[11px]"></i>
                        <span class="hidden md:inline">Kartu</span>
                    </button>
                </div>

                <!-- Density Switcher (visible in table mode) -->
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

                <!-- Export CSV Button -->
                <button type="button" @click="exportCSV('jurnal-ilmiah-nnsrc.csv')" 
                        class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-semibold shadow-xs transition-colors"
                        title="Ekspor seluruh jurnal ke format CSV">
                    <i class="fa-solid fa-file-csv text-emerald-600 text-sm"></i>
                    <span class="hidden sm:inline">Ekspor CSV</span>
                </button>

                <!-- Print Button -->
                <button type="button" @click="printTable()" 
                        class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-semibold shadow-xs transition-colors"
                        title="Cetak tabel jurnal">
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
                        <th @click="sortBy('name', 'text')" class="py-3.5 px-4 cursor-pointer hover:bg-slate-100 transition-colors">
                            <div class="flex items-center gap-1.5">
                                <span>Nama Jurnal</span>
                                <span class="text-slate-400">
                                    <i x-show="sortCol !== 'name'" class="fa-solid fa-sort text-[10px]"></i>
                                    <i x-show="sortCol === 'name' && sortAsc" class="fa-solid fa-sort-up text-navy-900"></i>
                                    <i x-show="sortCol === 'name' && !sortAsc" class="fa-solid fa-sort-down text-navy-900"></i>
                                </span>
                            </div>
                        </th>

                        <th @click="sortBy('indexing', 'text')" class="py-3.5 px-4 cursor-pointer hover:bg-slate-100 transition-colors w-32">
                            <div class="flex items-center gap-1.5">
                                <span>Indeksasi</span>
                                <span class="text-slate-400">
                                    <i x-show="sortCol !== 'indexing'" class="fa-solid fa-sort text-[10px]"></i>
                                    <i x-show="sortCol === 'indexing' && sortAsc" class="fa-solid fa-sort-up text-navy-900"></i>
                                    <i x-show="sortCol === 'indexing' && !sortAsc" class="fa-solid fa-sort-down text-navy-900"></i>
                                </span>
                            </div>
                        </th>

                        <th class="py-3.5 px-4">ISSN & Frekuensi</th>

                        <th class="py-3.5 px-4 text-center">Portal OJS</th>

                        <th @click="sortBy('status', 'text')" class="py-3.5 px-4 text-center cursor-pointer hover:bg-slate-100 transition-colors">
                            <div class="flex items-center justify-center gap-1.5">
                                <span>Status</span>
                                <span class="text-slate-400">
                                    <i x-show="sortCol !== 'status'" class="fa-solid fa-sort text-[10px]"></i>
                                    <i x-show="sortCol === 'status' && sortAsc" class="fa-solid fa-sort-up text-navy-900"></i>
                                    <i x-show="sortCol === 'status' && !sortAsc" class="fa-solid fa-sort-down text-navy-900"></i>
                                </span>
                            </div>
                        </th>

                        <th data-no-export class="py-3.5 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody data-table-body class="divide-y divide-slate-100">
                    <?php foreach ($journals as $idx => $j): 
                        $statusText = !empty($j['is_active']) ? 'Aktif' : 'Nonaktif';
                    ?>
                    <tr data-table-row 
                        data-id="<?= $j['id'] ?>"
                        data-name="<?= esc($j['name']) ?>"
                        data-indexing="<?= esc($j['indexing']) ?>"
                        data-category="<?= esc($j['indexing']) ?>"
                        data-status="<?= esc($statusText) ?>"
                        data-search="<?= esc($j['name'] . ' ' . ($j['name_en'] ?? '') . ' ' . $j['indexing'] . ' ' . $j['issn'] . ' ' . $j['frequency'] . ' ' . $j['description']) ?>"
                        :class="isSelected('<?= $j['id'] ?>') ? 'bg-gold-50/50 hover:bg-gold-50/70' : 'hover:bg-slate-50/80'"
                        class="transition-colors">
                        
                        <!-- Row Checkbox & Number -->
                        <td data-no-export class="py-3.5 px-4 text-center font-mono text-[11px] text-slate-400">
                            <div class="flex items-center justify-center gap-2">
                                <input type="checkbox" 
                                       :checked="isSelected('<?= $j['id'] ?>')" 
                                       @change="toggleRow('<?= $j['id'] ?>')" 
                                       class="rounded border-slate-300 text-navy-900 focus:ring-navy-900 cursor-pointer">
                                <span class="hidden sm:inline"><?= $idx + 1 ?></span>
                            </div>
                        </td>

                        <!-- Name -->
                        <td class="py-3.5 px-4 min-w-[260px]">
                            <div class="font-bold text-navy-950 leading-snug"><?= esc($j['name']) ?></div>
                            <?php if (!empty($j['name_en']) && $j['name_en'] !== $j['name']): ?>
                                <p class="text-[11px] text-slate-400 italic"><?= esc($j['name_en']) ?></p>
                            <?php endif; ?>
                            <div class="text-[11px] text-slate-500 line-clamp-1 mt-0.5"><?= esc($j['description']) ?></div>
                        </td>

                        <!-- Indexing -->
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg bg-maritime-50 text-maritime-700 text-xs font-bold border border-maritime-200">
                                <?= esc($j['indexing']) ?>
                            </span>
                        </td>

                        <!-- ISSN & Frequency -->
                        <td class="py-3.5 px-4 text-[11px]">
                            <div class="space-y-0.5 font-mono text-slate-600">
                                <div class="flex items-center gap-1.5">
                                    <i class="fa-solid fa-barcode text-slate-400 text-[10px]"></i>
                                    <span><?= esc($j['issn']) ?></span>
                                    <button type="button" @click="copyToClipboard('<?= esc($j['issn']) ?>', 'ISSN')" 
                                            class="text-slate-400 hover:text-slate-700 transition-colors" title="Salin ISSN">
                                        <i class="fa-regular fa-copy text-[9px]"></i>
                                    </button>
                                </div>
                                <div class="text-slate-500 text-[10px] flex items-center gap-1.5">
                                    <i class="fa-regular fa-calendar-check text-slate-400 text-[10px]"></i>
                                    <span><?= esc($j['frequency']) ?></span>
                                </div>
                            </div>
                        </td>

                        <!-- OJS Portal -->
                        <td class="py-3.5 px-4 text-center whitespace-nowrap">
                            <a href="<?= esc($j['journal_url']) ?>" target="_blank" rel="noopener noreferrer"
                               class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-maritime-50 text-maritime-700 hover:bg-maritime-100 border border-maritime-200 text-[11px] font-semibold transition-colors">
                                <i class="fa-solid fa-arrow-up-right-from-square text-[9px]"></i>
                                <span>OJS</span>
                            </a>
                        </td>

                        <!-- Status -->
                        <td class="py-3.5 px-4 text-center whitespace-nowrap">
                            <?php if (!empty($j['is_active'])): ?>
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Aktif
                                </span>
                            <?php else: ?>
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> Nonaktif
                                </span>
                            <?php endif; ?>
                        </td>

                        <!-- Actions -->
                        <td data-no-export class="py-3.5 px-4 text-center whitespace-nowrap">
                            <div class="inline-flex items-center gap-1">
                                <a href="<?= base_url('admin/jurnal/edit/' . $j['id']) ?>" 
                                   class="p-1.5 rounded-lg text-blue-600 hover:text-blue-800 hover:bg-blue-50 transition-colors" title="Sunting">
                                    <i class="fa-solid fa-pen-to-square text-xs"></i>
                                </a>
                                <form action="<?= base_url('admin/jurnal/delete/' . $j['id']) ?>" method="POST" class="inline"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus jurnal <?= esc($j['name'], 'js') ?>?')">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="p-1.5 rounded-lg text-rose-500 hover:text-rose-700 hover:bg-rose-50 transition-colors cursor-pointer" title="Hapus">
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
                                <h4 class="text-sm font-bold text-navy-950 mb-1">Tidak Ada Jurnal yang Cocok</h4>
                                <p class="text-xs text-slate-500 mb-4">Tidak ditemukan jurnal ilmiah yang cocok dengan kata kunci atau filter yang Anda terapkan.</p>
                                <button type="button" @click="resetFilters()" 
                                        class="px-3.5 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors">
                                    Reset Semua Filter
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
                Menampilkan <span class="font-bold text-navy-950" x-text="pageStart"></span> - <span class="font-bold text-navy-950" x-text="pageEnd"></span> dari <span class="font-bold text-navy-950" x-text="filteredCount"></span> jurnal
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

    <!-- GRID VIEW -->
    <div x-show="viewMode === 'grid'" x-cloak class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <?php foreach ($journals as $j): ?>
        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs flex flex-col justify-between hover:border-maritime-500 hover:shadow-md transition-all">
            <div class="space-y-4">
                <div class="flex items-start justify-between gap-3">
                    <span class="px-2.5 py-1 rounded-lg bg-maritime-50 text-maritime-700 text-xs font-bold border border-maritime-200">
                        <?= esc($j['indexing']) ?>
                    </span>
                    <div class="flex items-center gap-2">
                        <?php if (! empty($j['is_active'])): ?>
                            <span class="inline-flex items-center gap-1 text-[11px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Aktif
                            </span>
                        <?php else: ?>
                            <span class="inline-flex items-center gap-1 text-[11px] font-bold text-slate-500 bg-slate-100 px-2 py-0.5 rounded-full border border-slate-200">
                                Nonaktif
                            </span>
                        <?php endif; ?>
                        <span class="text-[11px] font-mono text-slate-400">#<?= esc($j['order_num']) ?></span>
                    </div>
                </div>

                <div>
                    <h3 class="text-base font-bold text-navy-950 leading-snug">
                        <?= esc($j['name']) ?>
                    </h3>
                    <?php if (! empty($j['name_en']) && $j['name_en'] !== $j['name']): ?>
                        <p class="text-xs text-slate-400 italic mt-0.5"><?= esc($j['name_en']) ?></p>
                    <?php endif; ?>
                </div>

                <div class="space-y-1.5 text-xs">
                    <div class="text-slate-500 flex items-center gap-2 font-mono">
                        <i class="fa-solid fa-barcode text-slate-400 text-[11px]"></i>
                        <span><?= esc($j['issn']) ?></span>
                    </div>
                    <div class="text-slate-500 flex items-center gap-2">
                        <i class="fa-regular fa-calendar-check text-slate-400 text-[11px]"></i>
                        <span><?= esc($j['frequency']) ?> (<?= esc($j['frequency_en'] ?? 'Biannual') ?>)</span>
                    </div>
                    <p class="text-slate-600 line-clamp-3 leading-relaxed pt-1">
                        <?= esc($j['description']) ?>
                    </p>
                </div>

                <div class="pt-2">
                    <a href="<?= esc($j['journal_url']) ?>" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center gap-1.5 text-xs text-maritime-700 font-semibold bg-maritime-50 px-3 py-1.5 rounded-lg border border-maritime-200 hover:bg-maritime-100 transition-colors">
                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                        <span>Portal OJS UMRAH</span>
                    </a>
                </div>
            </div>

            <div class="pt-5 mt-4 border-t border-slate-100 flex items-center justify-between gap-2">
                <span class="text-[11px] font-mono text-slate-400">
                    Slug: <?= esc($j['slug']) ?>
                </span>
                <div class="flex items-center gap-2">
                    <a href="<?= base_url('admin/jurnal/edit/' . $j['id']) ?>" 
                       class="px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors">
                        <i class="fa-solid fa-pen-to-square mr-1"></i> Edit
                    </a>
                    <form action="<?= base_url('admin/jurnal/delete/' . $j['id']) ?>" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jurnal <?= esc($j['name'], 'js') ?>?');">
                        <?= csrf_field() ?>
                        <button type="submit" class="px-3 py-1.5 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-semibold transition-colors">
                            <i class="fa-regular fa-trash-can mr-1"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
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
            <span class="font-medium text-slate-200">jurnal dipilih</span>
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

<?php endif; ?>

<?= $this->endSection() ?>
