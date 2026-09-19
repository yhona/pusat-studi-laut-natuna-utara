<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<?php $isEn = (service('request')->getLocale() === 'en'); ?>

<!-- Page Header Banner -->
<div class="bg-navy-950 text-white py-14 relative overflow-hidden border-b-2 border-gold-500">
    <div class="absolute inset-0 opacity-10 bg-pattern"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <nav class="flex items-center space-x-2 text-xs text-gold-400 mb-2 font-medium">
            <a href="<?= base_url() ?>" class="hover:underline"><?= lang('App.nav_home') ?></a>
            <span>/</span>
            <span class="text-slate-300"><?= lang('App.nav_publications') ?></span>
        </nav>
        <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight text-white">
            <?= $isEn ? 'Publications, Journals & Policy Briefs' : 'Publikasi, Jurnal & Policy Brief' ?>
        </h1>
        <p class="text-slate-300 text-xs sm:text-sm mt-1 max-w-2xl">
            <?= $isEn 
                ? 'Dissemination of peer-reviewed marine research papers and strategic policy briefs for governmental and academic decision-makers.' 
                : 'Diseminasi naskah ilmiah hasil riset kelautan dan rekomendasi kebijakan strategis bagi pemerintah dan pengambil keputusan.' ?>
        </p>
    </div>
</div>

<?php
// Enrich policy brief metadata with valid download repository slugs & recommendations
$metadataMap = $isEn ? [
    'PB-05/PSK-UMRAH/2026' => [
        'slug'            => 'pb-diplomasi-perbatasan-natuna',
        'file_size'       => '3.8 MB',
        'pages'           => 24,
        'recommendations' => [
            'Strengthening multi-tier diplomatic coordination between Central Ministries (MoFA/BSKLN) and Regional Border Agencies.',
            'Accelerating border maritime infrastructure development to support active presence and sovereign law enforcement.',
            'Harmonizing cross-border security policies with socioeconomic welfare programs for outermost island communities.'
        ]
    ],
    'PB-06/PSK-UMRAH/2026' => [
        'slug'            => 'pb-kpbpb-perbatasan-maritim',
        'file_size'       => '3.6 MB',
        'pages'           => 20,
        'recommendations' => [
            'Formulating dedicated fiscal incentives and streamlined customs regulations to accelerate investment in border Free Trade Zones.',
            'Synergizing port logistics infrastructure with regional supply chains across Asia Pacific and African trade corridors.',
            'Enhancing local workforce absorption and MSME integration within Free Trade Zone and Free Port ecosystems.'
        ]
    ],
] : [
    'PB-05/PSK-UMRAH/2026' => [
        'slug'            => 'pb-diplomasi-perbatasan-natuna',
        'file_size'       => '3.8 MB',
        'pages'           => 24,
        'recommendations' => [
            'Penguatan koordinasi diplomasi terpadu antara Kementerian Luar Negeri (BSKLN), Pemerintah Pusat, dan Pemerintah Daerah kawasan perbatasan.',
            'Pembangunan dan optimalisasi infrastruktur maritim di beranda terluar guna memperkuat penegakan kedaulatan wilayah secara berkelanjutan.',
            'Harmonisasi regulasi keamanan laut dengan program penguatan ekonomi dan kesejahteraan masyarakat di pulau-pulau terluar Laut Natuna Utara.'
        ]
    ],
    'PB-06/PSK-UMRAH/2026' => [
        'slug'            => 'pb-kpbpb-perbatasan-maritim',
        'file_size'       => '3.6 MB',
        'pages'           => 20,
        'recommendations' => [
            'Penyusunan insentif fiskal khusus dan penyederhanaan tata kelola kepabeanan guna mengakselerasi investasi di Kawasan Bebas perbatasan.',
            'Sinergi infrastruktur logistik kepelabuhanan dengan rantai pasok regional koridor perdagangan Asia Pasifik dan Afrika.',
            'Penguatan penyerapan tenaga kerja lokal dan integrasi UMKM pesisir ke dalam rantai nilai ekosistem KPBPB.'
        ]
    ],
];
?>

<!-- Main Content -->
<div class="py-16 bg-slate-50" x-data="policyBriefModal()" @keydown.escape.window="if (isOpen) closeDownloadModal()">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
        
        <!-- Jurnal Kemaritiman Section -->
        <div id="jurnal" class="space-y-6">
            <div class="border-b border-slate-200 pb-4">
                <span class="text-maritime-600 uppercase text-xs font-bold tracking-wider block"><?= $isEn ? 'Scientific Periodicals' : 'Publikasi Berkala Ilmiah' ?></span>
                <h3 class="text-xl sm:text-2xl font-bold text-navy-950 mt-1"><?= $isEn ? 'UMRAH Marine & Maritime Scientific Journals' : 'Jurnal Ilmiah Kelautan & Kemaritiman UMRAH' ?></h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <?php foreach ($journals as $j): ?>
                <div class="bg-white rounded-2xl p-7 border border-slate-200 shadow-sm hover:shadow-md transition-all flex flex-col justify-between space-y-4">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between gap-2">
                            <span class="px-2.5 py-1 rounded bg-maritime-50 text-maritime-700 text-[11px] font-bold border border-maritime-200/50">
                                <?= esc($j['indexing']) ?>
                            </span>
                            <span class="text-[11px] text-slate-400 font-mono">Peer-Reviewed</span>
                        </div>
                        <h4 class="text-lg font-bold text-navy-950 leading-snug"><?= esc($j['name']) ?></h4>
                        <p class="text-xs text-slate-500 font-mono"><?= esc($j['issn']) ?></p>
                        <p class="text-xs text-slate-600 leading-relaxed"><?= esc($j['desc']) ?></p>
                    </div>
                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                        <a href="<?= esc($j['link']) ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 text-xs font-bold text-maritime-600 hover:text-navy-950 transition-colors">
                            <?= $isEn ? 'Visit OJS Portal' : 'Kunjungi Portal OJS' ?> <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                        </a>
                        <span class="text-[11px] text-slate-400"><?= $isEn ? 'Biannual Publication' : 'Terbit 2x Setahun' ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Policy Brief Kemaritiman (Adopsi PSE UGM) -->
        <div id="policy-brief" class="scroll-mt-28 space-y-6">
            <div class="border-b border-slate-200 pb-4">
                <span class="text-gold-600 uppercase text-xs font-bold tracking-wider block"><?= $isEn ? 'Policy Recommendations' : 'Rekomendasi Kebijakan' ?></span>
                <h3 class="text-xl sm:text-2xl font-bold text-navy-950 mt-1"><?= $isEn ? 'Tropical Maritime Policy Briefs' : 'Policy Brief Kemaritiman Tropis' ?></h3>
                <p class="text-slate-600 text-xs sm:text-sm mt-1"><?= $isEn ? 'Evidence-based executive summaries for regional and national regulatory considerations.' : 'Ringkasan eksekutif berbasis bukti ilmiah untuk pertimbangan regulasi daerah dan nasional.' ?></p>
            </div>

            <div class="space-y-4">
                <?php foreach ($policy_briefs as $pb): 
                    $meta = $metadataMap[$pb['number']] ?? [
                        'slug'            => 'pb-logistik-pesisir',
                        'file_size'       => '3.0 MB',
                        'pages'           => 16,
                        'recommendations' => [$isEn ? 'Strategic recommendations for sustainable marine resource governance.' : 'Rekomendasi strategis tata kelola sumberdaya laut berkelanjutan.']
                    ];
                    $enrichedPb = array_merge($pb, $meta);
                ?>
                <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-xs hover:border-maritime-500 hover:shadow-md transition-all flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="space-y-2 max-w-3xl">
                        <div class="flex items-center gap-2 text-xs text-slate-500">
                            <span class="font-mono font-semibold text-navy-900 bg-slate-100 px-2 py-0.5 rounded"><?= esc($pb['number']) ?></span>
                            <span>•</span>
                            <span><?= $isEn ? 'Year ' : 'Tahun ' ?><?= esc($pb['year']) ?></span>
                            <span>•</span>
                            <span class="text-emerald-600 font-medium"><i class="fa-solid fa-file-pdf mr-1"></i><?= esc($enrichedPb['file_size']) ?></span>
                        </div>
                        <h4 class="text-base font-bold text-navy-950 leading-snug"><?= esc($pb['title']) ?></h4>
                        <p class="text-xs text-slate-600 leading-relaxed"><?= esc($pb['desc']) ?></p>
                        <span class="text-[11px] text-slate-500 block"><?= $isEn ? 'Authors:' : 'Penyusun:' ?> <strong class="text-slate-700"><?= esc($pb['author']) ?></strong></span>
                    </div>
                    <div class="flex-shrink-0">
                        <button type="button" @click="openDownloadModal(<?= htmlspecialchars(json_encode($enrichedPb), ENT_QUOTES, 'UTF-8') ?>)"
                                class="inline-flex items-center gap-2 bg-slate-100 hover:bg-navy-900 hover:text-gold-400 text-slate-700 text-xs font-semibold px-4 py-2.5 rounded-lg border border-slate-200 transition-all active:scale-[0.98] shadow-xs group cursor-pointer">
                            <i class="fa-regular fa-file-pdf text-rose-500 text-sm group-hover:scale-110 transition-transform"></i> <?= $isEn ? 'Download PDF' : 'Unduh PDF' ?>
                        </button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>

    <!-- Modal Unduh Policy Brief Interaktif -->
    <div x-show="isOpen" x-cloak
         class="fixed inset-0 z-50 bg-navy-950/80 backdrop-blur-sm flex items-center justify-center p-3 sm:p-6 overflow-y-auto"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
          role="dialog"
          aria-modal="true"
          :aria-label="selectedPb ? selectedPb.title : '<?= $isEn ? 'Download Policy Brief' : 'Unduh Policy Brief' ?>'"
          @click.self="closeDownloadModal()">

        <div class="relative bg-white rounded-2xl shadow-2xl border border-slate-200 max-w-2xl w-full overflow-hidden my-auto"
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95">

            <!-- Modal Header -->
            <div class="bg-navy-950 text-white p-6 border-b-2 border-gold-500 relative">
                <div class="flex items-start justify-between gap-4">
                    <div class="space-y-1.5">
                        <div class="flex items-center gap-2 text-xs">
                            <span class="font-mono font-bold text-gold-400 bg-navy-900 border border-gold-500/30 px-2 py-0.5 rounded" x-text="selectedPb?.number"></span>
                            <span class="text-slate-400">•</span>
                            <span class="text-slate-300" x-text="'<?= $isEn ? 'Year ' : 'Tahun ' ?>' + (selectedPb ? selectedPb.year : '')"></span>
                            <span class="text-slate-400">•</span>
                            <span class="px-2 py-0.5 rounded bg-rose-500/20 text-rose-300 font-semibold text-[11px]" x-text="'PDF ' + (selectedPb ? selectedPb.file_size : '')"></span>
                        </div>
                        <h3 class="text-base sm:text-lg font-bold text-white leading-snug pt-1" x-text="selectedPb?.title"></h3>
                        <p class="text-xs text-slate-300" x-text="'<?= $isEn ? 'Authors: ' : 'Penyusun: ' ?>' + (selectedPb ? selectedPb.author : '')"></p>
                    </div>

                    <button @click="closeDownloadModal()"
                            class="w-8 h-8 rounded-lg bg-navy-900 hover:bg-navy-800 text-slate-400 hover:text-white flex items-center justify-center transition-colors border border-navy-800 flex-shrink-0 active:scale-[0.98]"
                            aria-label="<?= $isEn ? 'Close Dialog' : 'Tutup Dialog' ?>">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                </div>
            </div>

            <!-- Modal Body (Executive Summary & Institutional Form) -->
            <div class="p-6 space-y-6 max-h-[70vh] overflow-y-auto text-slate-700 text-xs sm:text-sm">
                
                <!-- Executive Summary Box -->
                <div class="bg-maritime-50/70 border border-maritime-200/70 rounded-xl p-4 space-y-3">
                    <div class="flex items-center gap-2 text-maritime-800 font-bold text-xs uppercase tracking-wider">
                        <i class="fa-solid fa-file-shield text-maritime-600"></i>
                        <span><?= $isEn ? 'Executive Summary & Policy Recommendations' : 'Ringkasan Eksekutif & Rekomendasi Kebijakan' ?></span>
                    </div>
                    <p class="text-xs text-slate-700 leading-relaxed" x-text="selectedPb?.desc"></p>
                    
                    <!-- Recommendations Bullet List -->
                    <div class="pt-2 border-t border-maritime-200/60 space-y-1.5">
                        <span class="block text-[11px] font-bold text-navy-950 uppercase tracking-wide"><?= $isEn ? 'Key Strategic Recommendations:' : '3 Poin Rekomendasi Kunci:' ?></span>
                        <template x-for="(rec, rIdx) in (selectedPb ? selectedPb.recommendations : [])" :key="rIdx">
                            <div class="flex items-start gap-2 text-xs text-slate-700">
                                <i class="fa-solid fa-circle-check text-emerald-600 text-xs mt-0.5 flex-shrink-0"></i>
                                <span x-text="rec"></span>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Success Confirmation Banner -->
                <div x-show="downloadSuccess" x-cloak class="p-4 rounded-xl bg-emerald-50 border border-emerald-300 text-emerald-900 space-y-1">
                    <div class="flex items-center gap-2 font-bold text-xs">
                        <i class="fa-solid fa-circle-check text-emerald-600 text-sm"></i>
                        <span><?= $isEn ? 'Document Download Processing!' : 'Pengunduhan Dokumen Berhasil Diproses!' ?></span>
                    </div>
                    <p class="text-[11px] text-emerald-700 leading-relaxed">
                        <?= $isEn 
                            ? 'The official PDF manuscript is downloading. If it does not start automatically, <a :href="\''.base_url('unduhan/unduh/').'/\' + selectedPb?.slug" class="underline font-bold hover:text-emerald-950">click here to download manually</a>.' 
                            : 'Naskah resmi PDF sedang diunduh ke perangkat Anda. Jika pengunduhan tidak berjalan otomatis, <a :href="\''.base_url('unduhan/unduh/').'/\' + selectedPb?.slug" class="underline font-bold hover:text-emerald-950">klik di sini untuk mengunduh manual</a>.' ?>
                    </p>
                </div>

                <!-- Institutional Affiliation Form -->
                <form @submit.prevent="submitDownload()" class="space-y-4 pt-1">
                    <?= csrf_field() ?>
                    <div class="border-b border-slate-100 pb-2">
                        <span class="font-bold text-navy-950 text-xs sm:text-sm block"><?= $isEn ? 'Document Access Registration' : 'Formulir Registrasi Pengunduh Dokumen' ?></span>
                        <span class="text-[11px] text-slate-500"><?= $isEn ? 'Institutional affiliation data is collected for maritime research impact monitoring by LPPM UMRAH.' : 'Data institusi digunakan untuk keperluan statistik dampak hilirisasi riset kelautan LPPM UMRAH.' ?></span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[11px] font-semibold text-slate-700 mb-1"><?= $isEn ? 'Full Name & Degree *' : 'Nama Lengkap & Gelar *' ?></label>
                            <input type="text" x-model="form.name" required placeholder="<?= $isEn ? 'e.g., Dr. Ahmad Dahlan' : 'Contoh: Dr. Ahmad Dahlan' ?>"
                                   class="w-full px-3 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-maritime-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-slate-700 mb-1"><?= $isEn ? 'Official / Institutional Email *' : 'Email Resmi / Institusi *' ?></label>
                            <input type="email" x-model="form.email" required placeholder="name@agency.gov / name@univ.edu"
                                   class="w-full px-3 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-maritime-500 focus:border-transparent">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[11px] font-semibold text-slate-700 mb-1"><?= $isEn ? 'Institution / Organization *' : 'Nama Instansi / Lembaga *' ?></label>
                            <input type="text" x-model="form.institution" required placeholder="<?= $isEn ? 'e.g., Ministry of Maritime Affairs & Fisheries' : 'Contoh: Bappeda Kepri / Ditjen PRL KKP' ?>"
                                   class="w-full px-3 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-maritime-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-slate-700 mb-1"><?= $isEn ? 'WhatsApp / Phone Number' : 'Nomor WhatsApp / HP' ?></label>
                            <input type="tel" x-model="form.phone" placeholder="08xxxxxxxxxx"
                                   class="w-full px-3 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-maritime-500 focus:border-transparent">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[11px] font-semibold text-slate-700 mb-1"><?= $isEn ? 'Organization Category' : 'Kategori Lembaga' ?></label>
                            <select x-model="form.category" class="w-full px-3 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-maritime-500 focus:border-transparent bg-white">
                                <option value="Pemerintah"><?= $isEn ? 'Government Ministry / Regional Agency' : 'Pemerintah Daerah / Kementerian (KKP/BRIN/Kemlu)' ?></option>
                                <option value="Universitas"><?= $isEn ? 'University / Academic & Research Institute' : 'Perguruan Tinggi / Lembaga Penelitian' ?></option>
                                <option value="Industri"><?= $isEn ? 'Maritime Industry / Port & Shipping Corporation' : 'BUMN / Sektor Swasta Maritim & Pelayaran' ?></option>
                                <option value="LSM"><?= $isEn ? 'Non-Governmental Organization / Coastal Community' : 'Lembaga Swadaya Masyarakat / Komunitas Bahari' ?></option>
                                <option value="Umum"><?= $isEn ? 'Independent Researcher & Public' : 'Masyarakat Umum & Praktisi' ?></option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-slate-700 mb-1"><?= $isEn ? 'Purpose of Document Use *' : 'Keperluan Penggunaan Dokumen *' ?></label>
                            <input type="text" x-model="form.purpose" required placeholder="<?= $isEn ? 'e.g., Policy formulation, academic paper, thesis' : 'Contoh: Telaah kebijakan, referensi skripsi, riset perbatasan' ?>"
                                   class="w-full px-3 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-maritime-500 focus:border-transparent">
                        </div>
                    </div>

                    <!-- Alert Error -->
                    <div x-show="errorMessage" x-cloak class="p-3 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs flex items-start gap-2">
                        <i class="fa-solid fa-circle-exclamation text-rose-600 mt-0.5"></i>
                        <span x-text="errorMessage"></span>
                    </div>

                    <!-- Modal Actions -->
                    <div class="pt-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3">
                        <button type="button" @click="closeDownloadModal()"
                                class="px-4 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-100 rounded-lg transition-colors cursor-pointer">
                            <?= $isEn ? 'Cancel' : 'Batal' ?>
                        </button>
                        <button type="submit" :disabled="isSubmitting"
                                class="inline-flex items-center gap-2 bg-maritime-600 hover:bg-maritime-700 text-white text-xs font-semibold px-5 py-2.5 rounded-lg shadow-sm hover:shadow transition-all active:scale-[0.98] cursor-pointer disabled:opacity-60">
                            <i class="fa-solid" :class="isSubmitting ? 'fa-spinner fa-spin' : 'fa-paper-plane'"></i>
                            <span x-text="isSubmitting ? '<?= $isEn ? 'Submitting...' : 'Mengirimkan...' ?>' : '<?= $isEn ? 'Send to Author & Download' : 'Kirim ke Penyusun & Unduh' ?>'"></span>
                        </button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>

<script>
function policyBriefModal() {
    return {
        isOpen: false,
        selectedPb: null,
        downloadSuccess: false,
        isSubmitting: false,
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
        openDownloadModal(pb) {
            this.selectedPb = pb;
            this.downloadSuccess = false;
            this.errorMessage = '';
            this.isSubmitting = false;
            this.isOpen = true;
            document.body.classList.add('overflow-hidden');
        },
        closeDownloadModal() {
            this.isOpen = false;
            document.body.classList.remove('overflow-hidden');
        },
        async submitDownload() {
            this.isSubmitting = true;
            this.errorMessage = '';

            try {
                const formData = new FormData();
                formData.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');
                formData.append('document_slug', this.selectedPb.slug);
                formData.append('applicant_name', this.form.name);
                formData.append('applicant_email', this.form.email);
                formData.append('applicant_phone', this.form.phone || '');
                formData.append('applicant_institution', this.form.institution);
                formData.append('institution_category', this.form.category);
                formData.append('purpose', this.form.purpose || 'Riset dan telaah kebijakan maritim');

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
                this.errorMessage = 'Terjadi kendala jaringan saat mengirimkan formulir.';
            } finally {
                this.isSubmitting = false;
            }
        }
    };
}
</script>

<?= $this->endSection() ?>
