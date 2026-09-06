<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<!-- Page Header Banner -->
<div class="bg-navy-950 text-white py-14 relative overflow-hidden border-b-2 border-gold-500">
    <div class="absolute inset-0 opacity-10 bg-pattern"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <nav class="flex items-center space-x-2 text-xs text-gold-400 mb-2 font-medium">
            <a href="<?= base_url() ?>" class="hover:underline flex items-center gap-1">
                <i class="fa-solid fa-house text-[10px]"></i> Beranda
            </a>
            <span>/</span>
            <span class="text-slate-300">Repositori & Unduhan</span>
        </nav>
        <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight text-white">Repositori Dokumen & Pusat Unduhan</h1>
        <p class="text-slate-300 text-xs sm:text-sm mt-1 max-w-2xl leading-relaxed">
            Akses terbuka ke naskah Standar Operasional Prosedur (SOP) laboratorium, policy brief kajian strategis kemaritiman, formulir kerjasama, dan panduan penelitian Universitas Maritim Raja Ali Haji.
        </p>
    </div>
</div>

<!-- Main Repository Content Area -->
<div class="py-14 bg-slate-50" x-data="{
    search: '',
    selectedCategory: 'all',
    filterCategory(cat) {
        this.selectedCategory = cat;
    },
    matches(cat, title, desc, code) {
        const catMatch = (this.selectedCategory === 'all' || this.selectedCategory === cat);
        const term = this.search.toLowerCase().trim();
        if (!term) return catMatch;
        const textMatch = title.toLowerCase().includes(term) ||
                          desc.toLowerCase().includes(term) ||
                          code.toLowerCase().includes(term);
        return catMatch && textMatch;
    }
}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
        
        <!-- Summary Stats Metrics -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-navy-50 text-navy-900 flex items-center justify-center text-xl font-bold flex-shrink-0">
                    <i class="fa-solid fa-folder-open"></i>
                </div>
                <div>
                    <span class="text-xs text-slate-500 font-medium block">Total Dokumen</span>
                    <span class="text-xl sm:text-2xl font-extrabold text-navy-950"><?= esc($stats['total']) ?> Dokumen</span>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center text-xl font-bold flex-shrink-0">
                    <i class="fa-solid fa-flask-vial"></i>
                </div>
                <div>
                    <span class="text-xs text-slate-500 font-medium block">SOP Terakreditasi</span>
                    <span class="text-xl sm:text-2xl font-extrabold text-navy-950"><?= esc($stats['sop']) ?> Prosedur</span>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-gold-50 text-gold-700 flex items-center justify-center text-xl font-bold flex-shrink-0">
                    <i class="fa-solid fa-file-shield"></i>
                </div>
                <div>
                    <span class="text-xs text-slate-500 font-medium block">Policy Brief</span>
                    <span class="text-xl sm:text-2xl font-extrabold text-navy-950"><?= esc($stats['policy']) ?> Naskah</span>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-xl font-bold flex-shrink-0">
                    <i class="fa-solid fa-cloud-arrow-down"></i>
                </div>
                <div>
                    <span class="text-xs text-slate-500 font-medium block">Total Diunduh</span>
                    <span class="text-xl sm:text-2xl font-extrabold text-navy-950"><?= number_format($stats['total_dl']) ?>+</span>
                </div>
            </div>
        </div>

        <!-- Filter Pills & Search Input Toolbar -->
        <div class="bg-white rounded-2xl p-4 sm:p-5 border border-slate-200 shadow-xs flex flex-col md:flex-row items-center justify-between gap-4">
            
            <!-- Category Pills -->
            <div class="flex flex-wrap items-center gap-2 w-full md:w-auto">
                <button type="button" 
                        @click="filterCategory('all')" 
                        :class="selectedCategory === 'all' ? 'bg-navy-900 text-gold-400 font-bold shadow-xs' : 'bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium'"
                        class="px-3.5 py-2 rounded-xl text-xs transition-all duration-200 cursor-pointer">
                    Semua (<?= count($documents) ?>)
                </button>
                <button type="button" 
                        @click="filterCategory('sop')" 
                        :class="selectedCategory === 'sop' ? 'bg-navy-900 text-gold-400 font-bold shadow-xs' : 'bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium'"
                        class="px-3.5 py-2 rounded-xl text-xs transition-all duration-200 cursor-pointer">
                    SOP Lab (<?= $stats['sop'] ?>)
                </button>
                <button type="button" 
                        @click="filterCategory('policy-brief')" 
                        :class="selectedCategory === 'policy-brief' ? 'bg-navy-900 text-gold-400 font-bold shadow-xs' : 'bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium'"
                        class="px-3.5 py-2 rounded-xl text-xs transition-all duration-200 cursor-pointer">
                    Policy Brief (<?= $stats['policy'] ?>)
                </button>
                <button type="button" 
                        @click="filterCategory('template')" 
                        :class="selectedCategory === 'template' ? 'bg-navy-900 text-gold-400 font-bold shadow-xs' : 'bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium'"
                        class="px-3.5 py-2 rounded-xl text-xs transition-all duration-200 cursor-pointer">
                    Template Kerjasama (<?= $stats['template'] ?>)
                </button>
                <button type="button" 
                        @click="filterCategory('panduan')" 
                        :class="selectedCategory === 'panduan' ? 'bg-navy-900 text-gold-400 font-bold shadow-xs' : 'bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium'"
                        class="px-3.5 py-2 rounded-xl text-xs transition-all duration-200 cursor-pointer">
                    Panduan Riset (<?= $stats['panduan'] ?>)
                </button>
            </div>

            <!-- Search Bar -->
            <div class="relative w-full md:w-80">
                <input type="text" 
                       id="search-docs"
                       name="search"
                       aria-label="Cari dokumen, SOP, atau kode"
                       x-model="search" 
                       placeholder="Cari nama dokumen, SOP, atau kode..." 
                       class="w-full pl-9 pr-4 py-2.5 text-xs border border-slate-200 rounded-xl focus:outline-none focus:border-maritime-600 focus:ring-1 focus:ring-maritime-600 bg-slate-50">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-slate-400 text-xs"></i>
                <button x-show="search.length > 0" x-cloak @click="search = ''" class="absolute right-3 top-2.5 text-slate-400 hover:text-slate-600 text-xs" title="Hapus pencarian">
                    <i class="fa-solid fa-circle-xmark"></i>
                </button>
            </div>

        </div>

        <!-- Document Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($documents as $doc): ?>
            <div x-show="matches('<?= $doc['category_id'] ?>', '<?= esc(addslashes($doc['title'])) ?>', '<?= esc(addslashes($doc['desc'])) ?>', '<?= esc(addslashes($doc['code'])) ?>')"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs hover:shadow-md transition-all duration-300 flex flex-col justify-between space-y-4 group">
                
                <div class="space-y-3">
                    <!-- Top Bar: Category & Format Badge -->
                    <div class="flex items-center justify-between gap-2">
                        <span class="inline-flex items-center gap-1.5 text-[11px] font-bold text-maritime-700 bg-maritime-50 px-2.5 py-1 rounded-lg">
                            <i class="fa-solid <?= $doc['category_id'] === 'sop' ? 'fa-flask' : ($doc['category_id'] === 'policy-brief' ? 'fa-file-shield' : ($doc['category_id'] === 'template' ? 'fa-file-lines' : 'fa-book-open')) ?> text-xs"></i>
                            <?= esc($doc['category']) ?>
                        </span>

                        <span class="inline-flex items-center gap-1 text-[10px] font-extrabold uppercase px-2 py-0.5 rounded <?= $doc['file_type'] === 'PDF' ? 'bg-rose-50 text-rose-700 border border-rose-200' : 'bg-blue-50 text-blue-700 border border-blue-200' ?>">
                            <i class="fa-solid <?= $doc['file_type'] === 'PDF' ? 'fa-file-pdf' : 'fa-file-word' ?>"></i> <?= esc($doc['file_type']) ?>
                        </span>
                    </div>

                    <!-- Code & Title -->
                    <div class="space-y-1">
                        <span class="text-[10px] font-mono font-bold text-slate-400 tracking-wider block">
                            <?= esc($doc['code']) ?> • <?= esc($doc['year']) ?>
                        </span>
                        <h3 class="text-sm font-bold text-navy-950 group-hover:text-maritime-600 transition-colors leading-snug">
                            <?= esc($doc['title']) ?>
                        </h3>
                    </div>

                    <!-- Description -->
                    <p class="text-xs text-slate-600 line-clamp-3 leading-relaxed">
                        <?= esc($doc['desc']) ?>
                    </p>
                </div>

                <!-- Footer / Download Action -->
                <div class="pt-4 border-t border-slate-100 flex items-center justify-between gap-3 text-xs">
                    <div class="text-slate-400 text-[11px] space-y-0.5">
                        <span class="block"><i class="fa-regular fa-hard-drive mr-1"></i> <?= esc($doc['file_size']) ?></span>
                        <span class="block text-slate-500 font-medium"><i class="fa-solid fa-download mr-1 text-gold-500"></i> <?= number_format($doc['downloads']) ?> kali</span>
                    </div>

                    <a href="<?= base_url('unduhan/unduh/' . $doc['slug']) ?>" 
                       class="inline-flex items-center gap-2 bg-navy-900 hover:bg-maritime-700 text-gold-400 hover:text-white px-4 py-2 rounded-xl font-bold text-xs shadow-xs transition-all duration-200 flex-shrink-0">
                        <i class="fa-solid fa-arrow-down-to-line"></i>
                        <span>Unduh</span>
                    </a>
                </div>

            </div>
            <?php endforeach; ?>
        </div>

        <!-- Info Note Box for Official Institutional Requests -->
        <div class="bg-gradient-to-r from-navy-950 via-navy-900 to-maritime-900 text-white rounded-2xl p-6 sm:p-8 shadow-md border border-navy-800 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
            <div class="space-y-2 max-w-2xl">
                <div class="flex items-center gap-2 text-gold-400 text-xs font-bold uppercase tracking-wider">
                    <i class="fa-solid fa-stamp"></i>
                    <span>Kebutuhan Dokumen Resmi & Legalitas</span>
                </div>
                <h4 class="text-base sm:text-lg font-bold text-white">Memerlukan Naskah Kerjasama Asli Bertanda Tangan Basah?</h4>
                <p class="text-xs text-slate-300 leading-relaxed">
                    Untuk instansi pemerintah, BUMN, atau perguruan tinggi mitra yang membutuhkan naskah MoU bermaterai, dokumen KAK/TOR tender resmi, atau sertifikat pengujian laboratorium terakreditasi, silakan menghubungi Sekretariat PSK UMRAH.
                </p>
            </div>
            <a href="<?= base_url('kontak#kerjasama') ?>" class="inline-flex items-center gap-2 bg-gold-500 hover:bg-gold-400 text-navy-950 px-5 py-3 rounded-xl font-bold text-xs shadow transition-colors flex-shrink-0">
                <i class="fa-solid fa-paper-plane"></i> Hubungi Sekretariat
            </a>
        </div>

    </div>
</div>

<?= $this->endSection() ?>
