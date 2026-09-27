<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<?php if (empty($documents)): ?>
<div class="space-y-6">
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

    <div class="bg-white rounded-3xl border border-slate-200 shadow-xs p-12 text-center">
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
    </div>
</div>
<?php else: ?>

<div x-data="adminTable({ defaultSortCol: 'downloads', defaultSortAsc: false, defaultPageSize: 10 })" class="space-y-5">
    
    <!-- Header Toolbar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2.5">
                <h2 class="text-xl font-bold text-navy-950">Kelola Repositori & SOP Unduhan</h2>
                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-navy-100 text-navy-800 font-mono">
                    <?= count($documents) ?> Dokumen
                </span>
            </div>
            <p class="text-xs text-slate-500 mt-0.5">Daftar naskah Standar Operasional Prosedur, template MoU, dan dokumen publikasi</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="<?= base_url('unduhan') ?>" target="_blank"
               class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors">
                <i class="fa-solid fa-arrow-up-right-from-square text-[11px]"></i>
                <span class="hidden sm:inline">Portal Unduhan</span>
            </a>
            <a href="<?= base_url('admin/unduhan/create') ?>" 
               class="inline-flex items-center gap-2 px-4 py-2 bg-navy-950 hover:bg-maritime-700 text-gold-400 hover:text-white rounded-xl font-bold text-xs shadow-sm transition-all active:scale-[0.98] shrink-0">
                <i class="fa-solid fa-plus"></i>
                <span>Tambah Dokumen Baru</span>
            </a>
        </div>
    </div>

    <!-- Advanced Table Controls Toolbar -->
    <div class="bg-white rounded-2xl border border-slate-200 p-3 sm:p-4 shadow-xs space-y-3">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-3">
            
            <!-- Left: Search & Filter Inputs -->
            <div class="flex flex-wrap items-center gap-2.5 flex-1">
                <!-- Search Box -->
                <div class="relative flex-1 min-w-[220px]">
                    <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="search" x-model="search" data-table-search
                           placeholder="Cari kode, judul dokumen, kategori, deskripsi..." 
                           class="w-full pl-9 pr-9 py-2 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-navy-900 bg-slate-50/70 focus:bg-white transition-all">
                    <!-- Clear search button -->
                    <button type="button" x-show="search" @click="search = ''" 
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 text-xs">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                    <!-- Keyboard shortcut hint -->
                    <kbd x-show="!search" class="hidden sm:inline-block absolute right-3 top-1/2 -translate-y-1/2 px-1.5 py-0.5 text-[9px] font-mono text-slate-400 bg-slate-100 rounded border border-slate-200">/</kbd>
                </div>

                <!-- Category Filter -->
                <?php 
                    $docCategories = array_unique(array_filter(array_column($documents, 'category')));
                    sort($docCategories);
                ?>
                <select x-model="categoryFilter" 
                        class="px-3 py-2 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-navy-900 bg-slate-50/70">
                    <option value="">Semua Kategori</option>
                    <?php foreach ($docCategories as $cat): ?>
                        <option value="<?= esc($cat) ?>"><?= esc($cat) ?></option>
                    <?php endforeach; ?>
                </select>

                <!-- Format Filter -->
                <?php 
                    $docFormats = array_unique(array_filter(array_column($documents, 'file_type')));
                    sort($docFormats);
                ?>
                <select x-model="statusFilter" 
                        class="px-3 py-2 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-navy-900 bg-slate-50/70">
                    <option value="">Semua Format</option>
                    <?php foreach ($docFormats as $fmt): ?>
                        <option value="<?= esc($fmt) ?>"><?= esc($fmt) ?></option>
                    <?php endforeach; ?>
                </select>

                <!-- Reset Filters Button -->
                <button type="button" x-show="hasActiveFilters" @click="resetFilters()" x-cloak
                        class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-semibold transition-colors">
                    <i class="fa-solid fa-rotate-left text-[10px]"></i>
                    <span>Reset</span>
                </button>
            </div>

            <!-- Right: Table Utilities (Density, CSV, Print) -->
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
                            class="px-2.5 py-1.5 rounded-lg transition-all" title="Mode Tampilan Rapat / Padat">
                        <i class="fa-solid fa-table-cells-large text-[11px]"></i>
                    </button>
                </div>

                <!-- Export CSV Button -->
                <button type="button" @click="exportCSV('repositori-unduhan-nnsrc.csv')" 
                        class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-semibold shadow-xs transition-colors"
                        title="Ekspor data dokumen saat ini ke format CSV">
                    <i class="fa-solid fa-file-csv text-emerald-600 text-sm"></i>
                    <span class="hidden sm:inline">Ekspor CSV</span>
                </button>

                <!-- Print Button -->
                <button type="button" @click="printTable()" 
                        class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-semibold shadow-xs transition-colors"
                        title="Cetak tabel dokumen">
                    <i class="fa-solid fa-print text-slate-500 text-sm"></i>
                    <span class="hidden sm:inline">Cetak</span>
                </button>
            </div>

        </div>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-xs overflow-hidden">
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
                                <span>Kode & Judul Dokumen</span>
                                <span class="text-slate-400">
                                    <i x-show="sortCol !== 'title'" class="fa-solid fa-sort text-[10px]"></i>
                                    <i x-show="sortCol === 'title' && sortAsc" class="fa-solid fa-sort-up text-navy-900"></i>
                                    <i x-show="sortCol === 'title' && !sortAsc" class="fa-solid fa-sort-down text-navy-900"></i>
                                </span>
                            </div>
                        </th>

                        <th @click="sortBy('category', 'text')" class="py-3.5 px-4 cursor-pointer hover:bg-slate-100 transition-colors">
                            <div class="flex items-center gap-1.5">
                                <span>Kategori</span>
                                <span class="text-slate-400">
                                    <i x-show="sortCol !== 'category'" class="fa-solid fa-sort text-[10px]"></i>
                                    <i x-show="sortCol === 'category' && sortAsc" class="fa-solid fa-sort-up text-navy-900"></i>
                                    <i x-show="sortCol === 'category' && !sortAsc" class="fa-solid fa-sort-down text-navy-900"></i>
                                </span>
                            </div>
                        </th>

                        <th @click="sortBy('format', 'text')" class="py-3.5 px-4 cursor-pointer hover:bg-slate-100 transition-colors">
                            <div class="flex items-center gap-1.5">
                                <span>Format / Ukuran</span>
                                <span class="text-slate-400">
                                    <i x-show="sortCol !== 'format'" class="fa-solid fa-sort text-[10px]"></i>
                                    <i x-show="sortCol === 'format' && sortAsc" class="fa-solid fa-sort-up text-navy-900"></i>
                                    <i x-show="sortCol === 'format' && !sortAsc" class="fa-solid fa-sort-down text-navy-900"></i>
                                </span>
                            </div>
                        </th>

                        <th @click="sortBy('downloads', 'number')" class="py-3.5 px-4 text-center cursor-pointer hover:bg-slate-100 transition-colors">
                            <div class="flex items-center justify-center gap-1.5">
                                <span>Diunduh</span>
                                <span class="text-slate-400">
                                    <i x-show="sortCol !== 'downloads'" class="fa-solid fa-sort text-[10px]"></i>
                                    <i x-show="sortCol === 'downloads' && sortAsc" class="fa-solid fa-sort-up text-navy-900"></i>
                                    <i x-show="sortCol === 'downloads' && !sortAsc" class="fa-solid fa-sort-down text-navy-900"></i>
                                </span>
                            </div>
                        </th>

                        <th data-no-export class="py-3.5 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody data-table-body class="divide-y divide-slate-100">
                    <?php foreach ($documents as $idx => $doc): 
                        $downloadCount = (int) ($doc['downloads'] ?? 0);
                    ?>
                    <tr data-table-row 
                        data-id="<?= $doc['id'] ?>"
                        data-code="<?= esc($doc['code']) ?>"
                        data-title="<?= esc($doc['title']) ?>"
                        data-category="<?= esc($doc['category']) ?>"
                        data-format="<?= esc($doc['file_type']) ?>"
                        data-downloads="<?= $downloadCount ?>"
                        data-status="<?= esc($doc['file_type']) ?>"
                        data-search="<?= esc($doc['code'] . ' ' . $doc['title'] . ' ' . $doc['category'] . ' ' . $doc['desc'] . ' ' . $doc['file_type'] . ' ' . $doc['year']) ?>"
                        :class="isSelected('<?= $doc['id'] ?>') ? 'bg-gold-50/50 hover:bg-gold-50/70' : 'hover:bg-slate-50/80'"
                        class="transition-colors">
                        
                        <!-- Row Checkbox & Number -->
                        <td data-no-export class="py-3.5 px-4 text-center font-mono text-[11px] text-slate-400">
                            <div class="flex items-center justify-center gap-2">
                                <input type="checkbox" 
                                       :checked="isSelected('<?= $doc['id'] ?>')" 
                                       @change="toggleRow('<?= $doc['id'] ?>')" 
                                       class="rounded border-slate-300 text-navy-900 focus:ring-navy-900 cursor-pointer">
                                <span class="hidden sm:inline"><?= $idx + 1 ?></span>
                            </div>
                        </td>

                        <!-- Code & Title -->
                        <td class="py-3.5 px-4 min-w-[280px]">
                            <div class="flex items-center gap-2">
                                <span class="font-mono text-[10px] font-bold text-slate-500 bg-slate-100 px-2 py-0.5 rounded border border-slate-200">
                                    <?= esc($doc['code']) ?>
                                </span>
                                <span class="text-[10px] text-slate-400 font-bold">&bull; Tahun <?= esc($doc['year']) ?></span>
                                <button type="button" @click="copyToClipboard('<?= esc($doc['code']) ?>', 'Kode Dokumen')" 
                                        class="text-slate-400 hover:text-slate-700 transition-colors" title="Salin kode dokumen">
                                    <i class="fa-regular fa-copy text-[10px]"></i>
                                </button>
                            </div>
                            <div class="font-bold text-navy-950 leading-snug mt-1"><?= esc($doc['title']) ?></div>
                            <div class="text-[11px] text-slate-400 line-clamp-1 mt-0.5"><?= esc($doc['desc']) ?></div>
                        </td>

                        <!-- Category -->
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-maritime-700 bg-maritime-50 px-2.5 py-0.5 rounded-lg border border-maritime-200/50">
                                <?= esc($doc['category']) ?>
                            </span>
                        </td>

                        <!-- Format & Size -->
                        <td class="py-3.5 px-4 whitespace-nowrap text-[11px]">
                            <span class="font-bold text-slate-700 uppercase"><?= esc($doc['file_type']) ?></span>
                            <span class="text-slate-400">(<?= esc($doc['file_size']) ?>)</span>
                        </td>

                        <!-- Downloads -->
                        <td class="py-3.5 px-4 text-center font-mono font-bold text-gold-600 whitespace-nowrap">
                            <?= number_format($downloadCount) ?>x
                        </td>

                        <!-- Actions -->
                        <td data-no-export class="py-3.5 px-4 text-center whitespace-nowrap">
                            <div class="inline-flex items-center gap-1">
                                <a href="<?= base_url('unduhan/unduh/' . $doc['slug']) ?>" 
                                   class="p-1.5 rounded-lg text-slate-500 hover:text-navy-950 hover:bg-slate-100 transition-colors" title="Unduh Berkas">
                                    <i class="fa-solid fa-download text-xs"></i>
                                </a>
                                <a href="<?= base_url('admin/unduhan/edit/' . $doc['id']) ?>" 
                                   class="p-1.5 rounded-lg text-blue-600 hover:text-blue-800 hover:bg-blue-50 transition-colors" title="Sunting">
                                    <i class="fa-solid fa-pen-to-square text-xs"></i>
                                </a>
                                <form action="<?= base_url('admin/unduhan/delete/' . $doc['id']) ?>" method="POST" class="inline"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?')">
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
                        <td colspan="6" class="py-12 px-4 text-center">
                            <div class="flex flex-col items-center justify-center max-w-sm mx-auto">
                                <div class="w-12 h-12 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mb-3 text-xl">
                                    <i class="fa-solid fa-filter-circle-xmark"></i>
                                </div>
                                <h4 class="text-sm font-bold text-navy-950 mb-1">Tidak Ada Dokumen yang Cocok</h4>
                                <p class="text-xs text-slate-500 mb-4">Tidak ditemukan berkas dokumen yang cocok dengan kata kunci atau filter yang Anda terapkan.</p>
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
                Menampilkan <span class="font-bold text-navy-950" x-text="pageStart"></span> - <span class="font-bold text-navy-950" x-text="pageEnd"></span> dari <span class="font-bold text-navy-950" x-text="filteredCount"></span> dokumen
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
            <span class="font-medium text-slate-200">item dipilih</span>
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
