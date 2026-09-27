<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<?php if (empty($messages)): ?>
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-navy-950">Pesan Kerjasama & Kontak Masuk</h2>
            <p class="text-xs text-slate-500 mt-0.5">Daftar aspirasi kemitraan riset pentahelix dan pertanyaan dari masyarakat</p>
        </div>
        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-slate-200/70 text-slate-700 text-xs font-semibold">
            <i class="fa-solid fa-inbox text-slate-500"></i>
            <span>Total: 0 Pesan</span>
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-slate-200 shadow-xs p-12 text-center">
        <div class="flex flex-col items-center justify-center max-w-sm mx-auto">
            <div class="w-16 h-16 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mb-4 text-2xl">
                <i class="fa-regular fa-envelope-open"></i>
            </div>
            <h3 class="text-base font-bold text-navy-950 mb-1">Belum Ada Pesan Masuk</h3>
            <p class="text-xs text-slate-500 leading-relaxed">Kotak masuk permohonan kemitraan, konsultasi, dan inisiasi riset saat ini masih kosong.</p>
        </div>
    </div>
</div>
<?php else: ?>

<div x-data="adminTable({ defaultSortCol: 'date', defaultSortAsc: false, defaultPageSize: 10 })" class="space-y-5">
    
    <!-- Header Toolbar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2.5">
                <h2 class="text-xl font-bold text-navy-950">Pesan Kerjasama & Kontak Masuk</h2>
                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-navy-100 text-navy-800 font-mono">
                    <?= count($messages) ?> Pesan
                </span>
            </div>
            <p class="text-xs text-slate-500 mt-0.5">Daftar aspirasi kemitraan riset pentahelix dan pertanyaan dari masyarakat</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="<?= base_url('kontak') ?>" target="_blank"
               class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors">
                <i class="fa-solid fa-arrow-up-right-from-square text-[11px]"></i>
                <span class="hidden sm:inline">Form Publik</span>
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
                           placeholder="Cari pengirim, instansi, email, isi pesan..." 
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
                    $msgCategories = array_unique(array_filter(array_column($messages, 'kategori')));
                    sort($msgCategories);
                ?>
                <select x-model="categoryFilter" 
                        class="px-3 py-2 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-navy-900 bg-slate-50/70">
                    <option value="">Semua Kategori</option>
                    <?php foreach ($msgCategories as $cat): ?>
                        <option value="<?= esc($cat) ?>"><?= esc($cat) ?></option>
                    <?php endforeach; ?>
                </select>

                <!-- Status Filter -->
                <select x-model="statusFilter" 
                        class="px-3 py-2 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-navy-900 bg-slate-50/70">
                    <option value="">Semua Status</option>
                    <option value="baru">Baru</option>
                    <option value="diproses">Diproses</option>
                    <option value="selesai">Selesai</option>
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
                <button type="button" @click="exportCSV('kontak-masuk-nnsrc.csv')" 
                        class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-semibold shadow-xs transition-colors"
                        title="Ekspor seluruh data pesan masuk ke CSV">
                    <i class="fa-solid fa-file-csv text-emerald-600 text-sm"></i>
                    <span class="hidden sm:inline">Ekspor CSV</span>
                </button>

                <!-- Print Button -->
                <button type="button" @click="printTable()" 
                        class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-semibold shadow-xs transition-colors"
                        title="Cetak tabel pesan">
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
                        <th @click="sortBy('name', 'text')" class="py-3.5 px-4 cursor-pointer hover:bg-slate-100 transition-colors">
                            <div class="flex items-center gap-1.5">
                                <span>Pengirim & Instansi</span>
                                <span class="text-slate-400">
                                    <i x-show="sortCol !== 'name'" class="fa-solid fa-sort text-[10px]"></i>
                                    <i x-show="sortCol === 'name' && sortAsc" class="fa-solid fa-sort-up text-navy-900"></i>
                                    <i x-show="sortCol === 'name' && !sortAsc" class="fa-solid fa-sort-down text-navy-900"></i>
                                </span>
                            </div>
                        </th>

                        <th @click="sortBy('category', 'text')" class="py-3.5 px-4 cursor-pointer hover:bg-slate-100 transition-colors">
                            <div class="flex items-center gap-1.5">
                                <span>Kategori Kerjasama</span>
                                <span class="text-slate-400">
                                    <i x-show="sortCol !== 'category'" class="fa-solid fa-sort text-[10px]"></i>
                                    <i x-show="sortCol === 'category' && sortAsc" class="fa-solid fa-sort-up text-navy-900"></i>
                                    <i x-show="sortCol === 'category' && !sortAsc" class="fa-solid fa-sort-down text-navy-900"></i>
                                </span>
                            </div>
                        </th>

                        <th class="py-3.5 px-4 min-w-[240px]">Isi Pesan</th>

                        <th @click="sortBy('date', 'date')" class="py-3.5 px-4 cursor-pointer hover:bg-slate-100 transition-colors">
                            <div class="flex items-center gap-1.5">
                                <span>Waktu Kirim</span>
                                <span class="text-slate-400">
                                    <i x-show="sortCol !== 'date'" class="fa-solid fa-sort text-[10px]"></i>
                                    <i x-show="sortCol === 'date' && sortAsc" class="fa-solid fa-sort-up text-navy-900"></i>
                                    <i x-show="sortCol === 'date' && !sortAsc" class="fa-solid fa-sort-down text-navy-900"></i>
                                </span>
                            </div>
                        </th>

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

                        <th data-no-export class="py-3.5 px-4 text-center">Aksi Status</th>
                    </tr>
                </thead>
                <tbody data-table-body class="divide-y divide-slate-100">
                    <?php foreach ($messages as $idx => $m): 
                        $rawPhone = (string) ($m['telepon'] ?? '');
                        $cleanPhone = preg_replace('/\D+/', '', $rawPhone);
                        if (str_starts_with($cleanPhone, '0')) {
                            $cleanPhone = '62' . substr($cleanPhone, 1);
                        }
                    ?>
                    <tr data-table-row 
                        data-id="<?= $m['id'] ?>"
                        data-name="<?= esc($m['nama']) ?>"
                        data-category="<?= esc($m['kategori']) ?>"
                        data-status="<?= esc($m['status']) ?>"
                        data-date="<?= esc($m['created_at']) ?>"
                        data-search="<?= esc($m['nama'] . ' ' . $m['instansi'] . ' ' . $m['email'] . ' ' . $m['telepon'] . ' ' . $m['kategori'] . ' ' . $m['pesan'] . ' ' . ($m['ip_address'] ?? '')) ?>"
                        :class="isSelected('<?= $m['id'] ?>') ? 'bg-gold-50/50 hover:bg-gold-50/70' : 'hover:bg-slate-50/80'"
                        class="transition-colors">
                        
                        <!-- Row Checkbox & Number -->
                        <td data-no-export class="py-3.5 px-4 text-center font-mono text-[11px] text-slate-400">
                            <div class="flex items-center justify-center gap-2">
                                <input type="checkbox" 
                                       :checked="isSelected('<?= $m['id'] ?>')" 
                                       @change="toggleRow('<?= $m['id'] ?>')" 
                                       class="rounded border-slate-300 text-navy-900 focus:ring-navy-900 cursor-pointer">
                                <span class="hidden sm:inline"><?= $idx + 1 ?></span>
                            </div>
                        </td>

                        <!-- Sender & Institution -->
                        <td class="py-3.5 px-4 min-w-[200px]">
                            <span class="font-bold text-slate-800 block"><?= esc($m['nama']) ?></span>
                            <span class="text-slate-500 block text-[11px]"><?= esc($m['instansi']) ?></span>
                            <div class="flex items-center gap-2 text-[10px] text-slate-400 mt-1">
                                <span class="inline-flex items-center gap-1">
                                    <i class="fa-regular fa-envelope"></i> 
                                    <?= esc($m['email']) ?>
                                    <button type="button" @click="copyToClipboard('<?= esc($m['email']) ?>', 'Email')" 
                                            class="text-slate-400 hover:text-slate-700 transition-colors" title="Salin email">
                                        <i class="fa-regular fa-copy text-[9px]"></i>
                                    </button>
                                </span>
                                <?php if (!empty($cleanPhone)): ?>
                                <span>&bull;</span>
                                <a href="https://wa.me/<?= $cleanPhone ?>" target="_blank" rel="noopener noreferrer" 
                                   class="inline-flex items-center gap-1 text-emerald-600 hover:text-emerald-700 hover:underline font-semibold" title="Hubungi via WhatsApp">
                                    <i class="fa-brands fa-whatsapp text-emerald-600 text-xs"></i>
                                    <span><?= esc($rawPhone) ?></span>
                                </a>
                                <?php endif; ?>
                            </div>
                        </td>

                        <!-- Category -->
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-maritime-700 bg-maritime-50 px-2.5 py-0.5 rounded-lg border border-maritime-200/50">
                                <?= esc($m['kategori']) ?>
                            </span>
                        </td>

                        <!-- Message Content -->
                        <td class="py-3.5 px-4 min-w-[240px]">
                            <p class="text-slate-700 text-xs leading-relaxed italic">"<?= esc($m['pesan']) ?>"</p>
                            <span class="text-[10px] text-slate-400 font-mono block mt-0.5">IP: <?= esc($m['ip_address'] ?? '-') ?></span>
                        </td>

                        <!-- Timestamp -->
                        <td class="py-3.5 px-4 whitespace-nowrap text-[11px]">
                            <?= date('d M Y, H:i', strtotime($m['created_at'])) ?> WIB
                        </td>

                        <!-- Status Badge -->
                        <td class="py-3.5 px-4 text-center whitespace-nowrap">
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase <?= $m['status'] === 'baru' ? 'bg-rose-50 text-rose-700 border border-rose-200' : ($m['status'] === 'diproses' ? 'bg-amber-50 text-amber-700 border border-amber-200' : 'bg-emerald-50 text-emerald-700 border border-emerald-200') ?>">
                                <?= esc($m['status']) ?>
                            </span>
                        </td>

                        <!-- Actions Status -->
                        <td data-no-export class="py-3.5 px-4 text-center whitespace-nowrap">
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

                    <!-- No Match Filter Empty State -->
                    <tr data-table-nomatch style="display: none;">
                        <td colspan="7" class="py-12 px-4 text-center">
                            <div class="flex flex-col items-center justify-center max-w-sm mx-auto">
                                <div class="w-12 h-12 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mb-3 text-xl">
                                    <i class="fa-solid fa-filter-circle-xmark"></i>
                                </div>
                                <h4 class="text-sm font-bold text-navy-950 mb-1">Tidak Ada Pesan yang Cocok</h4>
                                <p class="text-xs text-slate-500 mb-4">Tidak ditemukan pesan masuk yang cocok dengan kata kunci atau filter yang Anda terapkan.</p>
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
                Menampilkan <span class="font-bold text-navy-950" x-text="pageStart"></span> - <span class="font-bold text-navy-950" x-text="pageEnd"></span> dari <span class="font-bold text-navy-950" x-text="filteredCount"></span> pesan
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
