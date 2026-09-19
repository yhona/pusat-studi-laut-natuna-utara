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
            <span class="text-slate-300"><?= lang('App.nav_services') ?></span>
        </nav>
        <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight text-white"><?= lang('App.service_heading') ?></h1>
        <p class="text-slate-300 text-xs sm:text-sm mt-1 max-w-2xl">
            <?= lang('App.service_desc') ?>
        </p>
    </div>
</div>

<!-- Main Services Section -->
<div class="py-16 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        
        <!-- Intro Note -->
        <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
            <div class="space-y-1 max-w-3xl">
                <span class="text-[11px] uppercase font-bold text-maritime-600 tracking-wider"><?= $isEn ? 'Industry & Government Partnerships' : 'Kemitraan Industri & Pemerintah' ?></span>
                <h3 class="text-lg sm:text-xl font-bold text-navy-950"><?= $isEn ? 'Supported by Accredited Oceanography Laboratories & Certified Experts' : 'Didukung Laboratorium Oseanografi & Tenaga Ahli Tersertifikasi' ?></h3>
                <p class="text-xs sm:text-sm text-slate-600">
                    <?= $isEn ? 'All survey and testing operations adhere strictly to national and international hydrographic standards ensuring data accuracy and legal validity.' : 'Seluruh kegiatan survei dan pengujian dilaksanakan sesuai standar hidrografi nasional dan internasional guna menjamin akurasi dan validitas data.' ?>
                </p>
            </div>
            <a href="<?= base_url('kontak#kerjasama') ?>" class="inline-flex items-center gap-2 bg-maritime-600 hover:bg-maritime-700 text-white text-xs font-semibold px-5 py-3 rounded-lg shadow transition-colors flex-shrink-0">
                <i class="fa-solid fa-file-signature text-gold-400"></i> <?= $isEn ? 'Service Inquiry Form' : 'Formulir Permohonan Jasa' ?>
            </a>
        </div>

        <!-- Services Section with Technical Spec Modal -->
        <div x-data="serviceSpecModal()" @keydown.escape.window="if (isOpen) closeSpec()">
            
            <!-- Services Cards List -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <?php foreach ($services as $service): ?>
                <div id="<?= esc($service['id']) ?>" class="scroll-mt-28 bg-white rounded-2xl p-7 border border-slate-200 shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col justify-between space-y-6">
                    <div class="space-y-4">
                        <div class="flex items-center gap-3.5">
                            <div class="w-12 h-12 rounded-xl bg-navy-900 text-gold-400 flex items-center justify-center text-xl flex-shrink-0 shadow-sm">
                                <i class="fa-solid <?= esc($service['icon']) ?>"></i>
                            </div>
                            <h3 class="text-base sm:text-lg font-bold text-navy-950 leading-snug">
                                <?= esc($service['title']) ?>
                            </h3>
                        </div>

                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                            <?= esc($service['desc']) ?>
                        </p>

                        <!-- Equipment / Instruments -->
                        <div class="bg-slate-50 rounded-xl p-4 border border-slate-100 space-y-2">
                            <span class="text-[11px] font-bold text-navy-900 uppercase tracking-wider block">
                                <i class="fa-solid fa-toolbox text-maritime-600 mr-1"></i> <?= $isEn ? 'Instruments & Facilities:' : 'Instrumen & Fasilitas:' ?>
                            </span>
                            <ul class="grid grid-cols-1 sm:grid-cols-2 gap-1.5 text-xs text-slate-600">
                                <?php foreach ($service['instruments'] as $inst): ?>
                                <li class="flex items-center gap-1.5">
                                    <i class="fa-solid fa-check text-[10px] text-emerald-600"></i> <?= esc($inst) ?>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <!-- Deliverables -->
                        <div class="space-y-1.5">
                            <span class="text-[11px] font-bold text-navy-900 uppercase tracking-wider block">
                                <i class="fa-solid fa-file-circle-check text-gold-600 mr-1"></i> <?= $isEn ? 'Deliverables & Outputs:' : 'Output / Luaran:' ?>
                            </span>
                            <ul class="space-y-1 text-xs text-slate-600">
                                <?php foreach ($service['deliverables'] as $del): ?>
                                <li class="flex items-center gap-1.5">
                                    <i class="fa-solid fa-circle-dot text-[8px] text-maritime-600"></i> <?= esc($del) ?>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>

                    <!-- Bottom Action Row -->
                    <div class="pt-4 border-t border-slate-100 flex flex-wrap items-center justify-between gap-3">
                        <button type="button" @click="openSpec(<?= htmlspecialchars(json_encode($service), ENT_QUOTES, 'UTF-8') ?>)"
                                class="inline-flex items-center gap-1.5 text-xs font-bold text-navy-900 hover:text-maritime-600 transition-colors py-1.5 px-2.5 rounded-lg hover:bg-slate-100 active:scale-[0.98] border border-slate-200">
                            <i class="fa-solid fa-list-check text-gold-500"></i> <?= $isEn ? 'View Technical Specifications' : 'Lihat Spesifikasi Teknis' ?>
                        </button>
                        <a href="<?= base_url('kontak?layanan=' . $service['id']) ?>" class="inline-flex items-center gap-1.5 text-xs font-bold text-maritime-600 hover:text-navy-950 transition-colors">
                            <?= $isEn ? 'Contact Team' : 'Hubungi Tim' ?> <i class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Service Technical Spec Sheet Modal -->
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
                 :aria-label="activeService ? activeService.title : 'Technical Specifications'"
                 @click.self="closeSpec()">

                <div class="relative bg-white rounded-2xl shadow-2xl border border-slate-200 max-w-3xl w-full overflow-hidden my-auto"
                     x-transition:enter="transition ease-out duration-300 transform"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-200 transform"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95">

                    <!-- Modal Header -->
                    <div class="bg-navy-950 text-white p-6 border-b-2 border-gold-500 relative">
                        <div class="flex items-start justify-between gap-4">
                            <div class="space-y-2">
                                <div class="flex items-center gap-2 text-xs">
                                    <span class="font-mono font-bold text-gold-400 bg-navy-900 border border-gold-500/30 px-2 py-0.5 rounded" x-text="activeService?.spec?.code"></span>
                                    <span class="text-slate-400">•</span>
                                    <span class="text-slate-300"><?= $isEn ? 'Official Technical Standards' : 'Standar Teknis Resmi' ?></span>
                                </div>
                                <h3 class="text-base sm:text-xl font-bold text-white leading-snug" x-text="activeService?.title"></h3>
                                <p class="text-xs text-slate-300 leading-relaxed" x-text="activeService?.spec?.standards"></p>
                            </div>

                            <button @click="closeSpec()"
                                    class="w-8 h-8 rounded-lg bg-navy-900 hover:bg-navy-800 text-slate-400 hover:text-white flex items-center justify-center transition-colors border border-navy-800 flex-shrink-0 active:scale-[0.98]"
                                    aria-label="<?= lang('App.btn_close') ?>">
                                <i class="fa-solid fa-xmark text-sm"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Modal Content -->
                    <div class="p-6 space-y-6 max-h-[70vh] overflow-y-auto text-slate-700 text-xs sm:text-sm">
                        
                        <!-- Parameter Teknis -->
                        <div class="space-y-3">
                            <div class="flex items-center gap-2 text-navy-950 font-bold text-xs uppercase tracking-wider">
                                <i class="fa-solid fa-microchip text-maritime-600"></i>
                                <span><?= $isEn ? 'Technical Parameters & Instrument Accuracy' : 'Parameter Teknis & Akurasi Instrumentasi' ?></span>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <template x-for="(item, iIdx) in (activeService?.spec?.instruments || [])" :key="iIdx">
                                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/80 space-y-1">
                                        <span class="font-bold text-navy-900 text-xs block" x-text="item.name"></span>
                                        <span class="text-[11px] text-slate-600 leading-relaxed block" x-text="item.param"></span>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- Deliverables -->
                        <div class="space-y-3 pt-2 border-t border-slate-100">
                            <div class="flex items-center gap-2 text-navy-950 font-bold text-xs uppercase tracking-wider">
                                <i class="fa-solid fa-file-circle-check text-gold-600"></i>
                                <span><?= $isEn ? 'File Formats & Project Deliverables' : 'Format Berkas & Luaran Deliverables' ?></span>
                            </div>
                            <div class="space-y-2">
                                <template x-for="(del, dIdx) in (activeService?.spec?.deliverables || [])" :key="dIdx">
                                    <div class="flex items-start gap-2.5 text-xs text-slate-700 bg-maritime-50/50 p-2.5 rounded-lg border border-maritime-100">
                                        <i class="fa-solid fa-circle-check text-emerald-600 mt-0.5 text-xs flex-shrink-0"></i>
                                        <span x-text="del"></span>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- Unduh SOP & Panduan -->
                        <div class="p-4 rounded-xl bg-gradient-to-r from-navy-950 to-navy-900 text-white flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <div class="space-y-1">
                                <span class="text-[10px] uppercase font-bold text-gold-400 tracking-wider block"><?= $isEn ? 'Standard Operating Procedure' : 'Standar Operasional Prosedur' ?></span>
                                <p class="text-xs text-slate-300 leading-relaxed" x-text="activeService?.spec?.sopName"></p>
                            </div>
                            <a :href="'<?= base_url('unduhan/unduh/') ?>/' + activeService?.spec?.sopSlug"
                               class="inline-flex items-center gap-2 bg-maritime-600 hover:bg-maritime-500 text-white text-xs font-semibold px-4 py-2.5 rounded-lg shadow transition-all flex-shrink-0 active:scale-[0.98]">
                                <i class="fa-solid fa-download text-gold-400"></i> <?= lang('App.btn_download_sop') ?>
                            </a>
                        </div>

                    </div>

                    <!-- Modal Footer -->
                    <div class="px-6 py-4 bg-slate-50 border-t border-slate-200 flex items-center justify-between">
                        <span class="text-[11px] text-slate-500">Pusat Studi Laut Natuna Utara (NNSRC UMRAH) • ISO 17025 Compliant</span>
                        <button type="button" @click="closeSpec()" class="px-4 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-200 rounded-lg transition-colors">
                            <?= lang('App.btn_close') ?>
                        </button>
                    </div>

                </div>
            </div>

        </div>

        <!-- Section 2: Consultation & Strategic Advisory -->
        <section id="konsultasi" class="scroll-mt-28 bg-gradient-to-br from-navy-950 via-navy-900 to-maritime-950 text-white rounded-3xl p-8 sm:p-12 shadow-2xl border border-navy-800 relative overflow-hidden">
            <div class="absolute inset-0 opacity-10 bg-pattern pointer-events-none"></div>

            <div class="relative z-10 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-8">
                <div class="space-y-4 max-w-2xl">
                    <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-gold-500/20 border border-gold-500/40 text-gold-400 text-xs font-semibold uppercase tracking-wider">
                        <i class="fa-solid fa-handshake text-[11px]"></i> <?= $isEn ? 'Government & Industry Partnerships' : 'Kemitraan Pemerintah & Industri Maritim' ?>
                    </span>
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
                        <?= $isEn ? 'Tailored Maritime Solutions for Frontier Regions' : 'Solusi Kemaritiman Terapan untuk Wilayah Perbatasan' ?>
                    </h3>
                    <p class="text-slate-300 text-xs sm:text-sm leading-relaxed">
                        <?= $isEn ? 'From port Detail Engineering Design (DED) and coastal spatial zoning (RZWP-3-K) to socio-economic community empowerment in outermost islands, our multidisciplinary team provides end-to-end technical assistance compliant with ministerial regulations.' : 'Mulai dari Detail Engineering Design (DED) fasilitas kepelabuhanan, penyusunan rencana tata ruang laut (RZWP-3-K), hingga pendampingan pemberdayaan masyarakat nelayan di pulau-pulau kecil terluar, dewan pakar kami siap mendampingi kebutuhan strategis Anda sesuai regulasi nasional.' ?>
                    </p>
                    <div class="flex flex-wrap gap-4 pt-2 text-xs text-slate-300">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-circle-check text-gold-400"></i>
                            <span><?= $isEn ? 'LPPM UMRAH Certified' : 'Terverifikasi LPPM UMRAH' ?></span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-circle-check text-gold-400"></i>
                            <span><?= $isEn ? 'Ministerial Standards (KKP & Kemenhub)' : 'Standar Regulasi KKP & Kemenhub RI' ?></span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-circle-check text-gold-400"></i>
                            <span><?= $isEn ? 'Rapid Field Deployment in Riau Islands' : 'Cakupan Lapangan Seluruh Kepri & Natuna' ?></span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row lg:flex-col gap-3.5 w-full lg:w-auto flex-shrink-0">
                    <a href="<?= base_url('kontak') ?>" class="inline-flex items-center justify-center gap-2.5 px-6 py-4 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-950 font-bold text-xs sm:text-sm shadow-xl transition-all active:scale-[0.98]">
                        <i class="fa-solid fa-file-signature"></i> <?= $isEn ? 'Initiate Partnership / Proposal' : 'Ajukan Permohonan Kerjasama' ?>
                    </a>
                    <a href="<?= base_url('unduhan') ?>" class="inline-flex items-center justify-center gap-2.5 px-6 py-4 rounded-xl bg-navy-800/80 hover:bg-navy-800 text-white font-semibold text-xs sm:text-sm border border-navy-700 shadow transition-all active:scale-[0.98]">
                        <i class="fa-solid fa-book-bookmark text-gold-400"></i> <?= $isEn ? 'Browse Document Repository' : 'Buka Repositori Dokumen & SOP' ?>
                    </a>
                </div>
            </div>
        </section>

    </div>
</div>

<script>
function serviceSpecModal() {
    return {
        isOpen: false,
        activeService: null,

        openSpec(service) {
            this.activeService = service;
            this.isOpen = true;
            document.body.style.overflow = 'hidden';
        },

        closeSpec() {
            this.isOpen = false;
            document.body.style.overflow = '';
        }
    };
}
</script>

<?= $this->endSection() ?>
