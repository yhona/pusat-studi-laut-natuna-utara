<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<?php $isEn = (service('request')->getLocale() === 'en'); ?>

<!-- Page Header Banner -->
<div class="bg-navy-950 text-white py-14 relative overflow-hidden border-b-2 border-gold-500">
    <div class="absolute inset-0 opacity-10 bg-pattern"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <nav class="flex items-center space-x-2 text-xs text-gold-400 mb-2 font-medium">
            <a href="<?= base_url() ?>" class="hover:underline flex items-center gap-1">
                <i class="fa-solid fa-house text-[10px]"></i> <?= lang('App.nav_home') ?>
            </a>
            <span>/</span>
            <span class="text-slate-300"><?= lang('App.nav_downloads') ?></span>
        </nav>
        <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight text-white">
            <?= $isEn ? 'Document Repository & Download Center' : 'Repositori Dokumen & Pusat Unduhan' ?>
        </h1>
        <p class="text-slate-300 text-xs sm:text-sm mt-1 max-w-2xl leading-relaxed">
            <?= $isEn 
                ? 'Open access to certified laboratory Standard Operating Procedures (SOP), strategic maritime policy briefs, partnership templates, and research safety guidelines of Universitas Maritim Raja Ali Haji.' 
                : 'Akses terbuka ke naskah Standar Operasional Prosedur (SOP) laboratorium, policy brief kajian strategis kemaritiman, formulir kerjasama, dan panduan penelitian Universitas Maritim Raja Ali Haji.' ?>
        </p>
    </div>
</div>

<!-- Main Repository Content Area -->
<div class="py-14 bg-slate-50" x-data="unduhanPageData()">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
        
        <!-- Summary Stats Metrics -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-navy-50 text-navy-900 flex items-center justify-center text-xl font-bold flex-shrink-0">
                    <i class="fa-solid fa-folder-open"></i>
                </div>
                <div>
                    <span class="text-xs text-slate-500 font-medium block"><?= $isEn ? 'Total Documents' : 'Total Dokumen' ?></span>
                    <span class="text-xl sm:text-2xl font-extrabold text-navy-950"><?= esc($stats['total']) ?> <?= $isEn ? 'Files' : 'Dokumen' ?></span>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center text-xl font-bold flex-shrink-0">
                    <i class="fa-solid fa-flask-vial"></i>
                </div>
                <div>
                    <span class="text-xs text-slate-500 font-medium block"><?= $isEn ? 'Accredited SOPs' : 'SOP Terakreditasi' ?></span>
                    <span class="text-xl sm:text-2xl font-extrabold text-navy-950"><?= esc($stats['sop']) ?> <?= $isEn ? 'Procedures' : 'Prosedur' ?></span>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-gold-50 text-gold-700 flex items-center justify-center text-xl font-bold flex-shrink-0">
                    <i class="fa-solid fa-file-shield"></i>
                </div>
                <div>
                    <span class="text-xs text-slate-500 font-medium block">Policy Brief</span>
                    <span class="text-xl sm:text-2xl font-extrabold text-navy-950"><?= esc($stats['policy']) ?> <?= $isEn ? 'Papers' : 'Naskah' ?></span>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-xl font-bold flex-shrink-0">
                    <i class="fa-solid fa-cloud-arrow-down"></i>
                </div>
                <div>
                    <span class="text-xs text-slate-500 font-medium block"><?= $isEn ? 'Total Downloads' : 'Total Diunduh' ?></span>
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
                    <?= $isEn ? 'All' : 'Semua' ?> (<?= count($documents) ?>)
                </button>
                <button type="button" 
                        @click="filterCategory('sop')" 
                        :class="selectedCategory === 'sop' ? 'bg-navy-900 text-gold-400 font-bold shadow-xs' : 'bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium'"
                        class="px-3.5 py-2 rounded-xl text-xs transition-all duration-200 cursor-pointer">
                    <?= $isEn ? 'Lab SOPs' : 'SOP Lab' ?> (<?= $stats['sop'] ?>)
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
                    <?= $isEn ? 'Partnership Templates' : 'Template Kerjasama' ?> (<?= $stats['template'] ?>)
                </button>
                <button type="button" 
                        @click="filterCategory('panduan')" 
                        :class="selectedCategory === 'panduan' ? 'bg-navy-900 text-gold-400 font-bold shadow-xs' : 'bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium'"
                        class="px-3.5 py-2 rounded-xl text-xs transition-all duration-200 cursor-pointer">
                    <?= $isEn ? 'Research Guidelines' : 'Panduan Riset' ?> (<?= $stats['panduan'] ?>)
                </button>
            </div>

            <!-- Search Bar -->
            <div class="relative w-full md:w-80">
                <input type="text" 
                       id="search-docs"
                       name="search"
                       aria-label="<?= $isEn ? 'Search document name, SOP, or code' : 'Cari dokumen, SOP, atau kode' ?>"
                       x-model="search" 
                       placeholder="<?= $isEn ? 'Search document name, SOP, or code...' : 'Cari nama dokumen, SOP, atau kode...' ?>" 
                       class="w-full pl-9 pr-4 py-2.5 text-xs border border-slate-200 rounded-xl focus:outline-none focus:border-maritime-600 focus:ring-1 focus:ring-maritime-600 bg-slate-50">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-slate-400 text-xs"></i>
                <button x-show="search.length > 0" x-cloak @click="search = ''" class="absolute right-3 top-2.5 text-slate-400 hover:text-slate-600 text-xs" title="<?= $isEn ? 'Clear search' : 'Hapus pencarian' ?>">
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
                        <span class="block text-slate-500 font-medium"><i class="fa-solid fa-download mr-1 text-gold-500"></i> <?= number_format($doc['downloads']) ?> <?= $isEn ? 'times' : 'kali' ?></span>
                    </div>

                    <button type="button" 
                            @click="openModal(<?= htmlspecialchars(json_encode($doc), ENT_QUOTES, 'UTF-8') ?>)" 
                            class="inline-flex items-center gap-2 bg-navy-900 hover:bg-maritime-700 text-gold-400 hover:text-white px-4 py-2 rounded-xl font-bold text-xs shadow-xs transition-all duration-200 flex-shrink-0 cursor-pointer active:scale-[0.98]">
                        <i class="fa-solid fa-arrow-down-to-line"></i>
                        <span><?= $isEn ? 'Download' : 'Unduh' ?></span>
                    </button>
                </div>

            </div>
            <?php endforeach; ?>
        </div>

        <!-- Info Note Box for Official Institutional Requests -->
        <div class="bg-gradient-to-r from-navy-950 via-navy-900 to-maritime-900 text-white rounded-2xl p-6 sm:p-8 shadow-md border border-navy-800 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
            <div class="space-y-2 max-w-2xl">
                <div class="flex items-center gap-2 text-gold-400 text-xs font-bold uppercase tracking-wider">
                    <i class="fa-solid fa-stamp"></i>
                    <span><?= $isEn ? 'Official Documents & Legal Requests' : 'Kebutuhan Dokumen Resmi & Legalitas' ?></span>
                </div>
                <h4 class="text-base sm:text-lg font-bold text-white"><?= $isEn ? 'Require Physical Certified Copies or Stamped MoU Agreements?' : 'Memerlukan Naskah Kerjasama Asli Bertanda Tangan Basah?' ?></h4>
                <p class="text-xs text-slate-300 leading-relaxed">
                    <?= $isEn 
                        ? 'For government ministries, state-owned enterprises, or partner universities requiring stamped MoUs, formal tender ToRs, or accredited laboratory test certificates, please contact the NNSRC UMRAH Secretariat directly.' 
                        : 'Untuk instansi pemerintah, BUMN, atau perguruan tinggi mitra yang membutuhkan naskah MoU bermaterai, dokumen KAK/TOR tender resmi, atau sertifikat pengujian laboratorium terakreditasi, silakan menghubungi Sekretariat PSK UMRAH.' ?>
                </p>
            </div>
            <a href="<?= base_url('kontak#kerjasama') ?>" class="inline-flex items-center gap-2 bg-gold-500 hover:bg-gold-400 text-navy-950 px-5 py-3 rounded-xl font-bold text-xs shadow transition-colors flex-shrink-0">
                <i class="fa-solid fa-paper-plane"></i> <?= $isEn ? 'Contact Secretariat' : 'Hubungi Sekretariat' ?>
            </a>
        </div>

    </div>

    <!-- Modal Formulir Permohonan Unduh & Notifikasi Pemilik/Penyusun PDF -->
    <div x-show="isModalOpen" x-cloak
         class="fixed inset-0 z-50 bg-navy-950/80 backdrop-blur-sm flex items-center justify-center p-3 sm:p-6 overflow-y-auto"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         role="dialog"
         aria-modal="true"
         :aria-label="selectedDoc ? selectedDoc.title : '<?= $isEn ? 'Download Form' : 'Formulir Unduh Dokumen' ?>'"
         @click.self="closeModal()">

        <div class="relative bg-white rounded-2xl shadow-2xl border border-slate-200 max-w-xl w-full overflow-hidden my-auto"
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95">

            <!-- Modal Header -->
            <div class="bg-navy-950 text-white p-5 sm:p-6 border-b-2 border-gold-500 relative">
                <div class="flex items-start justify-between gap-4">
                    <div class="space-y-1">
                        <div class="flex items-center gap-2 text-[11px]">
                            <span class="font-mono font-bold text-gold-400 bg-navy-900 border border-gold-500/30 px-2 py-0.5 rounded" x-text="selectedDoc?.code"></span>
                            <span class="text-slate-400">•</span>
                            <span class="text-slate-300" x-text="selectedDoc?.category"></span>
                        </div>
                        <h3 class="text-base sm:text-lg font-bold text-white leading-snug pt-1" x-text="selectedDoc?.title"></h3>
                        <p class="text-[11px] text-slate-300 flex items-center gap-1.5 pt-0.5">
                            <i class="fa-solid fa-envelope-circle-check text-gold-400"></i>
                            <span><?= $isEn ? 'Notifies document author / secretariat' : 'Data permohonan diteruskan ke email pemilik/penyusun naskah' ?></span>
                        </p>
                    </div>

                    <button @click="closeModal()"
                            class="w-8 h-8 rounded-lg bg-navy-900 hover:bg-navy-800 text-slate-400 hover:text-white flex items-center justify-center transition-colors border border-navy-800 flex-shrink-0 cursor-pointer"
                            aria-label="<?= $isEn ? 'Close Dialog' : 'Tutup Dialog' ?>">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                </div>
            </div>

            <!-- Modal Body -->
            <div class="p-6 space-y-4 max-h-[75vh] overflow-y-auto text-slate-700 text-xs sm:text-sm">

                <!-- Alert Error -->
                <div x-show="errorMessage" x-cloak class="p-3.5 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs flex items-start gap-2">
                    <i class="fa-solid fa-circle-exclamation text-rose-600 mt-0.5"></i>
                    <span x-text="errorMessage"></span>
                </div>

                <!-- Alert Success & Auto-download -->
                <div x-show="downloadSuccess" x-cloak class="p-4 rounded-xl bg-emerald-50 border border-emerald-300 text-emerald-900 space-y-2">
                    <div class="flex items-center gap-2 font-bold text-xs">
                        <i class="fa-solid fa-circle-check text-emerald-600 text-base"></i>
                        <span><?= $isEn ? 'Application Submitted Successfully!' : 'Permohonan Berhasil & Data Terkirim ke Pemilik Naskah!' ?></span>
                    </div>
                    <p class="text-xs text-emerald-700 leading-relaxed" x-text="successMessage"></p>
                    <div class="pt-2 border-t border-emerald-200 flex items-center justify-between text-xs">
                        <a :href="downloadUrl" class="inline-flex items-center gap-1.5 font-bold text-navy-950 underline hover:text-navy-800">
                            <i class="fa-solid fa-download"></i> <?= $isEn ? 'Click here if file did not start' : 'Klik di sini jika file belum terunduh otomatis' ?>
                        </a>
                        <button type="button" @click="closeModal()" class="text-slate-600 hover:text-navy-950 font-semibold cursor-pointer">
                            <?= $isEn ? 'Close' : 'Tutup' ?>
                        </button>
                    </div>
                </div>

                <!-- Registration Form -->
                <form x-show="!downloadSuccess" @submit.prevent="submitRequest()" class="space-y-4">
                    <div class="bg-slate-50 p-3.5 rounded-xl border border-slate-200 text-xs text-slate-600 space-y-1">
                        <span class="font-bold text-navy-950 block"><i class="fa-solid fa-circle-info text-maritime-600 mr-1"></i> <?= $isEn ? 'Notice to Applicants' : 'Keterangan Pemohon Unduhan' ?></span>
                        <p class="leading-relaxed text-[11px]">
                            <?= $isEn 
                                ? 'Please complete this verification form. The information will be automatically dispatched to the author/secretariat for scholarly tracking, and your PDF download will start immediately.' 
                                : 'Silakan lengkapi formulir di bawah ini. Informasi pemohon akan diteruskan ke email penyusun/pengelola naskah, dan file PDF akan otomatis terunduh.' ?>
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 mb-1"><?= $isEn ? 'Full Name & Academic Title *' : 'Nama Lengkap & Gelar *' ?></label>
                            <input type="text" x-model="form.name" required placeholder="<?= $isEn ? 'e.g., Dr. Ahmad Dahlan' : 'Contoh: Dr. Ahmad Dahlan' ?>"
                                   class="w-full px-3 py-2 text-xs rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-maritime-500 focus:border-transparent bg-white">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 mb-1"><?= $isEn ? 'Official / Active Email *' : 'Alamat Email Aktif *' ?></label>
                            <input type="email" x-model="form.email" required placeholder="name@agency.gov / name@univ.edu"
                                   class="w-full px-3 py-2 text-xs rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-maritime-500 focus:border-transparent bg-white">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 mb-1"><?= $isEn ? 'Institution / Agency *' : 'Nama Instansi / Perguruan Tinggi *' ?></label>
                            <input type="text" x-model="form.institution" required placeholder="<?= $isEn ? 'e.g., BRIN / Bappeda / University' : 'Contoh: Bappeda Kepri / BRIN / Ditjen PRL' ?>"
                                   class="w-full px-3 py-2 text-xs rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-maritime-500 focus:border-transparent bg-white">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 mb-1"><?= $isEn ? 'WhatsApp / Phone Number' : 'Nomor WhatsApp / HP' ?></label>
                            <input type="tel" x-model="form.phone" placeholder="08xxxxxxxxxx"
                                   class="w-full px-3 py-2 text-xs rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-maritime-500 focus:border-transparent bg-white">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1"><?= $isEn ? 'Organization Category' : 'Kategori Lembaga Pemohon' ?></label>
                        <select x-model="form.category" class="w-full px-3 py-2 text-xs rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-maritime-500 focus:border-transparent bg-white">
                            <option value="Pemerintah"><?= $isEn ? 'Government Ministry / Regional Agency (Pemda/KKP/Kemlu)' : 'Pemerintah Pusat / Daerah (Kemlu / KKP / Pemda)' ?></option>
                            <option value="Universitas"><?= $isEn ? 'University / Academic Researcher / Student' : 'Perguruan Tinggi / Dosen Peneliti / Mahasiswa' ?></option>
                            <option value="Industri"><?= $isEn ? 'Maritime Industry / Port & Shipping Corporation' : 'BUMN / Swasta Industri Maritim & Pelabuhan' ?></option>
                            <option value="LSM"><?= $isEn ? 'NGO / Maritime Community Association' : 'Lembaga Swadaya Masyarakat / Asosiasi Maritim' ?></option>
                            <option value="Umum"><?= $isEn ? 'General Public / Independent Think-tank' : 'Umum / Peneliti Independen' ?></option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1"><?= $isEn ? 'Purpose of Document Use *' : 'Tujuan & Keperluan Penggunaan Dokumen *' ?></label>
                        <textarea x-model="form.purpose" required rows="2" placeholder="<?= $isEn ? 'e.g., Background research for thesis on border fisheries policy...' : 'Contoh: Referensi penyusunan kajian kebijakan perbatasan maritim dan penelitian skripsi...' ?>"
                                  class="w-full px-3 py-2 text-xs rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-maritime-500 focus:border-transparent bg-white"></textarea>
                    </div>

                    <!-- Modal Actions -->
                    <div class="pt-3 border-t border-slate-100 flex items-center justify-between gap-3">
                        <button type="button" @click="closeModal()"
                                class="px-4 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-100 rounded-lg transition-colors cursor-pointer">
                            <?= $isEn ? 'Cancel' : 'Batal' ?>
                        </button>
                        <button type="submit" :disabled="isSubmitting"
                                class="inline-flex items-center gap-2 bg-navy-900 hover:bg-maritime-700 text-gold-400 hover:text-white text-xs font-bold px-5 py-2.5 rounded-xl shadow-xs transition-all active:scale-[0.98] cursor-pointer disabled:opacity-60">
                            <i class="fa-solid" :class="isSubmitting ? 'fa-spinner fa-spin' : 'fa-paper-plane'"></i>
                            <span x-text="isSubmitting ? '<?= $isEn ? 'Processing...' : 'Memproses...' ?>' : '<?= $isEn ? 'Submit & Download PDF' : 'Kirim ke Pemilik & Unduh' ?>'"></span>
                        </button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>

<script>
function unduhanPageData() {
    return {
        search: '',
        selectedCategory: 'all',
        isModalOpen: false,
        selectedDoc: null,
        isSubmitting: false,
        downloadSuccess: false,
        errorMessage: '',
        successMessage: '',
        downloadUrl: '',
        form: {
            name: '',
            email: '',
            phone: '',
            institution: '',
            category: 'Pemerintah',
            purpose: ''
        },
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
        },
        openModal(doc) {
            this.selectedDoc = doc;
            this.downloadSuccess = false;
            this.errorMessage = '';
            this.isSubmitting = false;
            this.isModalOpen = true;
            document.body.classList.add('overflow-hidden');
        },
        closeModal() {
            this.isModalOpen = false;
            document.body.classList.remove('overflow-hidden');
        },
        async submitRequest() {
            this.isSubmitting = true;
            this.errorMessage = '';

            try {
                const formData = new FormData();
                formData.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');
                formData.append('document_slug', this.selectedDoc.slug);
                formData.append('applicant_name', this.form.name);
                formData.append('applicant_email', this.form.email);
                formData.append('applicant_phone', this.form.phone);
                formData.append('applicant_institution', this.form.institution);
                formData.append('institution_category', this.form.category);
                formData.append('purpose', this.form.purpose);

                const response = await fetch('<?= base_url('unduhan/mohon-unduh') ?>', {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    this.downloadSuccess = true;
                    this.successMessage = data.message;
                    this.downloadUrl = data.download_url;

                    // Trigger automatic browser download
                    const a = document.createElement('a');
                    a.href = data.download_url;
                    a.download = '';
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                } else {
                    this.errorMessage = data.message || 'Gagal memproses permohonan unduhan.';
                }
            } catch (err) {
                this.errorMessage = 'Terjadi kesalahan jaringan saat mengirimkan formulir.';
            } finally {
                this.isSubmitting = false;
            }
        }
    };
}
</script>

<?= $this->endSection() ?>
