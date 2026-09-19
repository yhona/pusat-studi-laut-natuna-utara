<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<?php $isEn = (service('request')->getLocale() === 'en'); ?>

<!-- Hero Slider Section (Alpine.js Interactive Carousel) -->
<section class="relative bg-navy-950 text-white overflow-hidden" x-data="{
    activeSlide: 0,
    slides: <?= htmlspecialchars(json_encode($banners), ENT_QUOTES, 'UTF-8') ?>,
    timer: null,
    startAutoPlay() {
        this.timer = setInterval(() => {
            this.activeSlide = (this.activeSlide + 1) % this.slides.length;
        }, 6000);
    },
    stopAutoPlay() {
        clearInterval(this.timer);
    }
}" x-init="startAutoPlay()" @mouseenter="stopAutoPlay()" @mouseleave="startAutoPlay()">
    
    <!-- Dynamic Background Image & Gradient Overlay -->
    <div class="absolute inset-0 bg-cover bg-center transition-all duration-700 scale-105" :style="'background-image: url(' + slides[activeSlide].image + ')'"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-navy-950/95 via-navy-950/85 to-navy-900/65 z-10 pointer-events-none"></div>
    <div class="absolute inset-0 opacity-10 bg-pattern z-10 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-28 relative z-20 min-h-[480px] flex flex-col justify-center">
        
        <!-- Slide Content Loop Container -->
        <div class="relative min-h-[340px] sm:min-h-[290px] flex items-center">
            <template x-for="(slide, index) in slides" :key="index">
                <div x-show="activeSlide === index" 
                     x-transition:enter="transition ease-out duration-500 transform"
                     x-transition:enter-start="opacity-0 translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-300 transform absolute inset-0"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 -translate-y-2"
                     class="max-w-3xl space-y-5 w-full">
                    
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-gold-500/20 border border-gold-500/40 text-gold-400 text-xs font-semibold uppercase tracking-wider">
                        <i class="fa-solid fa-compass text-[11px]"></i>
                        <span x-text="slide.badge"></span>
                    </div>

                    <h2 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight text-white" x-text="slide.title"></h2>

                    <p class="text-slate-300 text-sm sm:text-base md:text-lg leading-relaxed max-w-2xl" x-text="slide.desc"></p>

                    <div class="pt-4 flex flex-wrap items-center gap-4">
                        <a :href="slide.link" class="inline-flex items-center gap-2.5 px-6 py-3 rounded-lg bg-maritime-600 hover:bg-maritime-500 text-white font-semibold text-sm shadow-lg shadow-maritime-900/50 hover:shadow-maritime-600/30 transition-all">
                            <span><?= lang('App.btn_learn_more') ?></span>
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                        </a>
                        <a href="<?= base_url('profil') ?>" class="inline-flex items-center gap-2 px-5 py-3 rounded-lg bg-navy-800/80 hover:bg-navy-800 text-slate-200 hover:text-white border border-slate-700 font-medium text-sm transition-colors">
                            <span><?= lang('App.nav_about') ?></span>
                        </a>
                    </div>
                </div>
            </template>
        </div>

        <!-- Slider Controls / Indicators -->
        <div class="mt-12 flex items-center justify-between border-t border-slate-800/80 pt-6">
            <div class="flex items-center gap-2">
                <template x-for="(slide, index) in slides" :key="index">
                    <button @click="activeSlide = index" 
                            class="h-2 rounded-full transition-all duration-300 focus:outline-none"
                            :class="activeSlide === index ? 'w-8 bg-gold-400' : 'w-2 bg-slate-700 hover:bg-slate-500'"
                            :aria-label="'Slide ' + (index + 1)">
                    </button>
                </template>
            </div>

            <div class="flex items-center gap-2 text-slate-400">
                <button @click="activeSlide = (activeSlide - 1 + slides.length) % slides.length" class="w-9 h-9 rounded-lg border border-slate-800 hover:border-slate-600 hover:text-white flex items-center justify-center transition-colors" aria-label="<?= lang('App.slide_prev') ?>">
                    <i class="fa-solid fa-chevron-left text-xs"></i>
                </button>
                <button @click="activeSlide = (activeSlide + 1) % slides.length" class="w-9 h-9 rounded-lg border border-slate-800 hover:border-slate-600 hover:text-white flex items-center justify-center transition-colors" aria-label="<?= lang('App.slide_next') ?>">
                    <i class="fa-solid fa-chevron-right text-xs"></i>
                </button>
            </div>
        </div>

    </div>
</section>

<!-- Callout Announcement Ticker -->
<div class="bg-gold-500 text-navy-950 py-2.5 px-4 text-xs sm:text-sm font-semibold shadow-inner">
    <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
        <div class="flex items-center gap-2 overflow-hidden">
            <span class="bg-navy-950 text-gold-400 text-[10px] uppercase font-bold px-2 py-0.5 rounded tracking-wider flex-shrink-0"><?= lang('App.announcement_badge') ?></span>
            <span class="truncate"><?= lang('App.announcement_text') ?></span>
        </div>
        <a href="<?= base_url('publikasi#policy-brief') ?>" class="flex-shrink-0 underline hover:text-navy-800 font-bold whitespace-nowrap"><?= lang('App.announcement_link') ?> <i class="fa-solid fa-arrow-up-right-from-square text-[10px] ml-0.5"></i></a>
    </div>
</div>

<!-- Sambutan Rektor Universitas Maritim Raja Ali Haji (UMRAH) -->
<section id="sambutan-rektor" class="py-16 bg-gradient-to-br from-navy-950 via-navy-900 to-maritime-950 text-white relative overflow-hidden border-b border-navy-800">
    <!-- Subtle Background Nautical / Wave Accents -->
    <div class="absolute inset-0 opacity-10 pointer-events-none bg-[radial-gradient(#d97706_1px,transparent_1px)] [background-size:24px_24px]"></div>
    <div class="absolute -top-24 -right-24 w-96 h-96 bg-maritime-600/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-gold-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            
            <!-- Foto Rektor UMRAH (Executive Portrait Frame) -->
            <div class="lg:col-span-4 flex flex-col items-center text-center">
                <div class="relative group">
                    <div class="w-60 h-72 sm:w-68 sm:h-80 rounded-2xl bg-gradient-to-tr from-gold-500/40 via-maritime-600 to-navy-800 p-1.5 shadow-2xl relative overflow-hidden border border-gold-500/30">
                        <div class="w-full h-full bg-gradient-to-b from-slate-100 via-slate-50 to-slate-200 rounded-[14px] flex flex-col items-center justify-end overflow-hidden relative">
                            <img src="<?= base_url('images/rektor_umrah.png') ?>" 
                                 alt="<?= lang('App.rector_name') ?>" 
                                 class="w-full h-full object-cover object-top hover:scale-105 transition-transform duration-500">
                            <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-navy-950 via-navy-950/85 to-transparent p-3.5 text-white text-center z-10">
                                <h4 class="font-bold text-sm text-gold-400"><?= lang('App.rector_name') ?></h4>
                                <p class="text-[11px] text-slate-300"><?= lang('App.rector_title') ?></p>
                            </div>
                        </div>
                    </div>
                    <!-- Decorative Crest Badge -->
                    <div class="absolute -bottom-3 -right-3 bg-gold-500 text-navy-950 text-xs font-black px-3 py-1.5 rounded-lg shadow-xl border border-white/30 flex items-center gap-1.5">
                        <i class="fa-solid fa-building-columns"></i> <?= $isEn ? 'Rector of UMRAH' : 'Rektor UMRAH' ?>
                    </div>
                </div>
            </div>

            <!-- Pesan Sambutan & Visi Strategis Rektor -->
            <div class="lg:col-span-8 space-y-4">
                <div class="flex items-center gap-2 text-gold-400 text-xs font-bold uppercase tracking-wider">
                    <span class="w-8 h-0.5 bg-gold-400"></span>
                    <span><?= lang('App.rector_speech_badge') ?></span>
                </div>
                
                <h3 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight leading-snug">
                    <?= lang('App.rector_speech_heading') ?>
                </h3>

                <blockquote class="border-l-4 border-gold-500 pl-4 py-2.5 text-slate-200 italic text-sm sm:text-base leading-relaxed bg-white/5 rounded-r-xl">
                    "<?= lang('App.rector_speech_quote') ?>"
                </blockquote>

                <p class="text-slate-300 text-xs sm:text-sm leading-relaxed">
                    <?= lang('App.rector_speech_p') ?>
                </p>

                <div class="pt-2 flex flex-wrap items-center gap-4">
                    <a href="<?= base_url('profil#visi-misi') ?>" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-950 font-bold text-xs sm:text-sm transition-all shadow-md active:scale-[0.98]">
                        <i class="fa-solid fa-compass"></i>
                        <span><?= lang('App.rector_btn_strategic') ?></span>
                        <i class="fa-solid fa-chevron-right text-xs ml-1"></i>
                    </a>
                    <a href="<?= base_url('riset') ?>" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white font-semibold text-xs sm:text-sm border border-white/20 transition-all active:scale-[0.98]">
                        <i class="fa-solid fa-microscope"></i>
                        <span><?= $isEn ? 'Explore Research Clusters' : 'Jelajahi Klaster Riset' ?></span>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Sambutan Koordinator Pusat Studi Laut Natuna Utara UMRAH -->
<section id="sambutan" class="py-16 bg-white border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            
            <!-- Foto Pimpinan / Badge Profil -->
            <div class="lg:col-span-4 flex flex-col items-center text-center">
                <div class="relative group">
                    <div class="w-56 h-64 sm:w-64 sm:h-72 rounded-2xl bg-gradient-to-tr from-navy-900 to-maritime-700 p-1.5 shadow-xl relative overflow-hidden">
                        <div class="w-full h-full bg-slate-100 rounded-[14px] flex flex-col items-center justify-end overflow-hidden relative">
                            <img src="<?= base_url('images/kepala_pusat.jpg') ?>" alt="Dr. Atika Thahira, S.H., M.H." class="w-full h-full object-cover object-top hover:scale-105 transition-transform duration-500">
                            <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-navy-950 via-navy-900/80 to-transparent p-4 text-white text-center z-10">
                                <h4 class="font-bold text-sm text-gold-400">Dr. Atika Thahira, S.H., M.H.</h4>
                                <p class="text-[11px] text-slate-300"><?= $isEn ? 'Center Coordinator of North Natuna Sea Research Center UMRAH' : 'Koordinator Pusat Studi Laut Natuna Utara UMRAH' ?></p>
                            </div>
                        </div>
                    </div>
                    <!-- Decorative Maritime Stamp -->
                    <div class="absolute -bottom-3 -right-3 bg-navy-900 text-gold-400 text-xs font-bold px-3 py-1.5 rounded-lg shadow-lg border border-gold-500/30 flex items-center gap-1.5">
                        <i class="fa-solid fa-shield-halved"></i> <?= lang('App.profile_stamp') ?>
                    </div>
                </div>
            </div>

            <!-- Sambutan & Visi -->
            <div class="lg:col-span-8 space-y-4">
                <div class="flex items-center gap-2 text-maritime-600 text-xs font-bold uppercase tracking-wider">
                    <span class="w-6 h-0.5 bg-maritime-600"></span>
                    <span><?= lang('App.profile_lead_intro') ?></span>
                </div>
                <h3 class="text-2xl sm:text-3xl font-bold text-navy-950 tracking-tight leading-snug">
                    <?= lang('App.profile_lead_heading') ?>
                </h3>
                <blockquote class="border-l-4 border-gold-500 pl-4 py-1 text-slate-600 italic text-sm sm:text-base leading-relaxed">
                    <?= lang('App.profile_lead_quote') ?>
                </blockquote>
                <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                    <?= lang('App.profile_lead_p') ?>
                </p>
                <div class="pt-3 flex flex-wrap items-center gap-4">
                    <a href="<?= base_url('profil') ?>" class="inline-flex items-center gap-2 text-maritime-700 hover:text-maritime-900 font-semibold text-xs sm:text-sm">
                        <span><?= lang('App.profile_read_more') ?></span>
                        <i class="fa-solid fa-chevron-right text-xs"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- 4 Klaster Riset Utama (The Core Research Hub) -->
<section class="py-16 bg-slate-50 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto mb-12 space-y-2">
            <span class="text-xs uppercase font-bold tracking-wider text-maritime-600"><?= lang('App.cluster_heading_tag') ?></span>
            <h3 class="text-2xl sm:text-3xl font-extrabold text-navy-950"><?= lang('App.cluster_heading_title') ?></h3>
            <p class="text-slate-600 text-xs sm:text-sm"><?= lang('App.cluster_heading_desc') ?></p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php foreach ($clusters as $cluster): ?>
            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-xl border border-slate-200/80 transition-all duration-300 flex flex-col justify-between group hover:-translate-y-1.5">
                <div class="space-y-4">
                    <!-- Icon Box -->
                    <div class="w-12 h-12 rounded-xl bg-maritime-50 group-hover:bg-navy-900 text-maritime-600 group-hover:text-gold-400 flex items-center justify-center transition-colors duration-300 text-xl">
                        <i class="fa-solid <?= esc($cluster['icon']) ?>"></i>
                    </div>

                    <h4 class="text-base font-bold text-navy-900 group-hover:text-maritime-600 transition-colors leading-snug">
                        <a href="<?= base_url('riset/' . $cluster['id']) ?>">
                            <?= esc($cluster['title']) ?>
                        </a>
                    </h4>

                    <p class="text-xs text-slate-600 leading-relaxed">
                        <?= esc($cluster['desc']) ?>
                    </p>
                </div>

                <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between text-xs">
                    <div class="text-slate-500">
                        <span class="block text-[10px] uppercase text-slate-400 font-semibold"><?= lang('App.cluster_coordinator') ?>:</span>
                        <span class="font-medium text-slate-700"><?= esc($cluster['lead']) ?></span>
                    </div>
                    <a href="<?= base_url('riset/' . $cluster['id']) ?>" class="font-semibold text-maritime-600 hover:text-maritime-800 flex items-center gap-1" aria-label="<?= lang('App.btn_learn_more') ?>">
                        <span class="text-[11px] font-medium"><?= lang('App.cluster_learn') ?></span> <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<!-- Layanan & Jasa Konsultasi Maritim -->
<section class="py-16 bg-white border-y border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4">
            <div>
                <span class="text-xs uppercase font-bold tracking-wider text-gold-600 flex items-center gap-1.5">
                    <i class="fa-solid fa-microchip"></i> <?= lang('App.service_tag') ?>
                </span>
                <h3 class="text-2xl sm:text-3xl font-extrabold text-navy-950 mt-1">
                    <?= lang('App.service_heading') ?>
                </h3>
                <p class="text-xs sm:text-sm text-slate-600 mt-1 max-w-2xl">
                    <?= lang('App.service_desc') ?>
                </p>
            </div>
            <a href="<?= base_url('layanan') ?>" class="inline-flex items-center gap-2 text-xs font-bold text-maritime-600 hover:text-maritime-800 flex-shrink-0">
                <?= lang('App.btn_view_all_services') ?> <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Jasa 1 -->
            <div class="border border-slate-200 rounded-xl p-6 hover:border-maritime-500 hover:shadow-lg transition-all bg-gradient-to-b from-white to-slate-50/50">
                <div class="w-10 h-10 rounded-lg bg-navy-800 text-gold-400 flex items-center justify-center text-lg mb-4">
                    <i class="fa-solid fa-water"></i>
                </div>
                <h4 class="text-base font-bold text-navy-900 mb-2"><?= lang('App.service_card_1_title') ?></h4>
                <p class="text-xs text-slate-600 leading-relaxed mb-4">
                    <?= lang('App.service_card_1_desc') ?>
                </p>
                <a href="<?= base_url('layanan#batimetri') ?>" class="text-xs font-semibold text-maritime-600 hover:underline"><?= $isEn ? 'Specifications & Instruments →' : 'Spesifikasi & Instrumen →' ?></a>
            </div>

            <!-- Jasa 2 -->
            <div class="border border-slate-200 rounded-xl p-6 hover:border-maritime-500 hover:shadow-lg transition-all bg-gradient-to-b from-white to-slate-50/50">
                <div class="w-10 h-10 rounded-lg bg-navy-800 text-gold-400 flex items-center justify-center text-lg mb-4">
                    <i class="fa-solid fa-flask"></i>
                </div>
                <h4 class="text-base font-bold text-navy-900 mb-2"><?= lang('App.service_card_2_title') ?></h4>
                <p class="text-xs text-slate-600 leading-relaxed mb-4">
                    <?= lang('App.service_card_2_desc') ?>
                </p>
                <a href="<?= base_url('layanan#amdal') ?>" class="text-xs font-semibold text-maritime-600 hover:underline"><?= $isEn ? 'Parameters & Protocols →' : 'Parameter & Prosedur →' ?></a>
            </div>

            <!-- Jasa 3 -->
            <div class="border border-slate-200 rounded-xl p-6 hover:border-maritime-500 hover:shadow-lg transition-all bg-gradient-to-b from-white to-slate-50/50">
                <div class="w-10 h-10 rounded-lg bg-navy-800 text-gold-400 flex items-center justify-center text-lg mb-4">
                    <i class="fa-solid fa-map-location-dot"></i>
                </div>
                <h4 class="text-base font-bold text-navy-900 mb-2"><?= lang('App.service_card_3_title') ?></h4>
                <p class="text-xs text-slate-600 leading-relaxed mb-4">
                    <?= lang('App.service_card_3_desc') ?>
                </p>
                <a href="<?= base_url('layanan#zonasi') ?>" class="text-xs font-semibold text-maritime-600 hover:underline"><?= $isEn ? 'Regulatory Advisory →' : 'Konsultasi Regulasi →' ?></a>
            </div>
        </div>
    </div>
</section>

<!-- Capaian & Statistik Angka -->
<section class="py-14 bg-navy-900 text-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-pattern"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center">
            <?php foreach ($stats as $item): ?>
            <div class="space-y-2">
                <div class="w-12 h-12 mx-auto rounded-full bg-navy-800 border border-navy-700 flex items-center justify-center text-gold-400 text-xl mb-3 shadow-inner">
                    <i class="fa-solid <?= esc($item['icon']) ?>"></i>
                </div>
                <span class="block text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
                    <?= esc($item['number']) ?>
                </span>
                <span class="block text-xs sm:text-sm text-slate-300 font-medium">
                    <?= esc($item['label']) ?>
                </span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Galeri Dokumentasi Ekspedisi Maritim & Fasilitas Lab -->
<section id="galeri" class="py-16 bg-white border-b border-slate-200" x-data="galleryLightbox()" @keydown.escape.window="if (isOpen) close()" @keydown.arrow-right.window="if (isOpen) next()" @keydown.arrow-left.window="if (isOpen) prev()">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header & Category Filter Pills -->
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-6">
            <div>
                <span class="text-xs uppercase font-bold tracking-wider text-gold-600 flex items-center gap-1.5">
                    <i class="fa-solid fa-camera text-gold-500"></i> <?= lang('App.gallery_tag') ?>
                </span>
                <h3 class="text-2xl sm:text-3xl font-extrabold text-navy-950 mt-1">
                    <?= lang('App.gallery_heading') ?>
                </h3>
                <p class="text-xs sm:text-sm text-slate-600 mt-1 max-w-2xl">
                    <?= lang('App.gallery_desc') ?>
                </p>
            </div>

            <!-- Filter Pills -->
            <div class="flex flex-wrap items-center gap-2 text-xs font-semibold">
                <button @click="setFilter('all')"
                        class="px-3.5 py-2 rounded-lg transition-all flex items-center gap-1.5 active:scale-[0.98]"
                        :class="activeFilter === 'all' ? 'bg-navy-900 text-gold-400 shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200 border border-slate-200'">
                    <i class="fa-solid fa-border-all text-[11px]"></i> <?= lang('App.gallery_filter_all') ?> (6)
                </button>
                <button @click="setFilter('ekspedisi')"
                        class="px-3.5 py-2 rounded-lg transition-all flex items-center gap-1.5 active:scale-[0.98]"
                        :class="activeFilter === 'ekspedisi' ? 'bg-navy-900 text-gold-400 shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200 border border-slate-200'">
                    <i class="fa-solid fa-ship text-[11px]"></i> <?= lang('App.gallery_filter_expedition') ?>
                </button>
                <button @click="setFilter('laboratorium')"
                        class="px-3.5 py-2 rounded-lg transition-all flex items-center gap-1.5 active:scale-[0.98]"
                        :class="activeFilter === 'laboratorium' ? 'bg-navy-900 text-gold-400 shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200 border border-slate-200'">
                    <i class="fa-solid fa-flask text-[11px]"></i> <?= lang('App.gallery_filter_lab') ?>
                </button>
                <button @click="setFilter('blue-carbon')"
                        class="px-3.5 py-2 rounded-lg transition-all flex items-center gap-1.5 active:scale-[0.98]"
                        :class="activeFilter === 'blue-carbon' ? 'bg-navy-900 text-gold-400 shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200 border border-slate-200'">
                    <i class="fa-solid fa-seedling text-[11px]"></i> <?= lang('App.gallery_filter_blue_carbon') ?>
                </button>
            </div>
        </div>

        <!-- Gallery Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <template x-for="(item, idx) in filteredItems" :key="item.id">
                <div class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between group hover:-translate-y-1 cursor-pointer"
                     @click="open(idx)">
                    
                    <!-- Image Card Container -->
                    <div class="h-52 relative overflow-hidden bg-navy-950">
                        <img :src="item.image" :alt="item.title" class="w-full h-full object-cover group-hover:scale-110 duration-500 ease-out transition-transform">
                        <div class="absolute inset-0 bg-gradient-to-t from-navy-950/80 via-transparent to-black/20 pointer-events-none"></div>
                        
                        <!-- Category Badge -->
                        <span class="absolute top-3 left-3 px-2.5 py-1 rounded-md text-[10px] uppercase font-bold tracking-wider border shadow-sm backdrop-blur-sm"
                              :class="item.badgeClass">
                            <span x-text="item.categoryLabel"></span>
                        </span>

                        <!-- Location Pill on Image Bottom -->
                        <div class="absolute bottom-3 left-3 right-3 text-white/95 text-[11px] flex items-center gap-1.5 truncate">
                            <i class="fa-solid fa-location-dot text-gold-400 flex-shrink-0 text-xs"></i>
                            <span class="truncate font-medium" x-text="item.location"></span>
                        </div>

                        <!-- Hover Icon Overlay -->
                        <div class="absolute inset-0 bg-navy-950/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center pointer-events-none">
                            <div class="w-12 h-12 rounded-full bg-gold-500/90 text-navy-950 flex items-center justify-center text-lg shadow-lg transform group-hover:scale-105 transition-transform">
                                <i class="fa-solid fa-magnifying-glass-plus"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-5 flex-grow flex flex-col justify-between space-y-3">
                        <div>
                            <div class="flex items-center gap-2 text-[11px] text-slate-500 mb-1.5">
                                <i class="fa-regular fa-calendar-check text-maritime-600"></i>
                                <span x-text="item.date"></span>
                            </div>
                            <h4 class="text-sm sm:text-base font-bold text-navy-950 group-hover:text-maritime-600 transition-colors leading-snug" x-text="item.title"></h4>
                            <p class="text-xs text-slate-600 line-clamp-2 mt-2 leading-relaxed" x-text="item.desc"></p>
                        </div>

                        <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                            <span class="text-slate-500 text-[11px] truncate max-w-[170px]" x-text="item.vessel"></span>
                            <span class="inline-flex items-center gap-1 font-semibold text-maritime-600 group-hover:text-navy-900 transition-colors">
                                <?= lang('App.gallery_preview') ?> <i class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                            </span>
                        </div>
                    </div>

                </div>
            </template>
        </div>

        <!-- Lightbox Modal Dialog -->
        <div x-show="isOpen" x-cloak
             class="fixed inset-0 z-50 bg-navy-950/90 backdrop-blur-md flex items-center justify-center p-3 sm:p-6 overflow-y-auto"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             role="dialog"
             aria-modal="true"
             :aria-label="currentItem.title"
             @click.self="close()">

            <div class="relative bg-navy-900 border border-navy-700/80 rounded-2xl shadow-2xl max-w-5xl w-full overflow-hidden my-auto"
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-200 transform"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95">

                <!-- Modal Top Header Bar -->
                <div class="px-6 py-4 bg-navy-950 border-b border-navy-800 flex items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <span class="px-2.5 py-1 rounded-md text-[10px] uppercase font-bold tracking-wider border"
                              :class="currentItem.badgeClass"
                              x-text="currentItem.categoryLabel"></span>
                        <span class="text-xs text-slate-400 font-mono"
                              x-text="'<?= lang('App.gallery_photo') ?> ' + (currentIndex + 1) + ' <?= lang('App.gallery_of') ?> ' + filteredItems.length"></span>
                    </div>

                    <!-- Controls: Prev, Next, Close -->
                    <div class="flex items-center gap-2">
                        <button @click="prev()"
                                class="w-8 h-8 rounded-lg bg-navy-800 hover:bg-navy-700 text-slate-300 hover:text-white flex items-center justify-center transition-colors border border-navy-700 active:scale-[0.98]"
                                aria-label="Previous">
                            <i class="fa-solid fa-chevron-left text-xs"></i>
                        </button>
                        <button @click="next()"
                                class="w-8 h-8 rounded-lg bg-navy-800 hover:bg-navy-700 text-slate-300 hover:text-white flex items-center justify-center transition-colors border border-navy-700 active:scale-[0.98]"
                                aria-label="Next">
                            <i class="fa-solid fa-chevron-right text-xs"></i>
                        </button>
                        <button @click="close()"
                                class="w-8 h-8 rounded-lg bg-rose-900/40 hover:bg-rose-800 text-rose-300 hover:text-white flex items-center justify-center transition-colors border border-rose-700/50 ml-2 active:scale-[0.98]"
                                aria-label="Close">
                            <i class="fa-solid fa-xmark text-sm"></i>
                        </button>
                    </div>
                </div>

                <!-- Modal Main Content -->
                <div class="grid grid-cols-1 lg:grid-cols-12">
                    
                    <!-- Left: High-Res Image Container -->
                    <div class="lg:col-span-7 bg-navy-950 flex items-center justify-center p-4 sm:p-6 relative min-h-[320px] max-h-[58vh]">
                        <img :src="currentItem.image" :alt="currentItem.title" class="max-h-[52vh] w-auto max-w-full object-contain rounded-xl shadow-2xl">
                        
                        <button @click="prev()" class="absolute left-6 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-navy-950/70 hover:bg-navy-900 text-white flex items-center justify-center backdrop-blur-sm border border-navy-700 transition-all shadow-lg active:scale-95" aria-label="Previous photo">
                            <i class="fa-solid fa-chevron-left"></i>
                        </button>
                        <button @click="next()" class="absolute right-6 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-navy-950/70 hover:bg-navy-900 text-white flex items-center justify-center backdrop-blur-sm border border-navy-700 transition-all shadow-lg active:scale-95" aria-label="Next photo">
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>
                    </div>

                    <!-- Right: Expedition Metadata Drawer -->
                    <div class="lg:col-span-5 p-6 sm:p-8 flex flex-col justify-between space-y-6 text-white bg-navy-900 border-t lg:border-t-0 lg:border-l border-navy-800">
                        <div class="space-y-4">
                            <h3 class="text-lg sm:text-xl font-bold leading-snug text-white" x-text="currentItem.title"></h3>

                            <!-- Metadata List -->
                            <div class="space-y-2.5 text-xs text-slate-300">
                                <div class="flex items-start gap-2.5 p-2.5 rounded-lg bg-navy-950/60 border border-navy-800">
                                    <i class="fa-solid fa-location-dot text-gold-400 mt-0.5 flex-shrink-0"></i>
                                    <div>
                                        <span class="block text-[10px] uppercase text-slate-400 font-semibold"><?= lang('App.gallery_location') ?></span>
                                        <span class="font-medium text-slate-200" x-text="currentItem.location"></span>
                                    </div>
                                </div>
                                <div class="flex items-start gap-2.5 p-2.5 rounded-lg bg-navy-950/60 border border-navy-800">
                                    <i class="fa-solid fa-ship text-maritime-400 mt-0.5 flex-shrink-0"></i>
                                    <div>
                                        <span class="block text-[10px] uppercase text-slate-400 font-semibold"><?= lang('App.gallery_vessel') ?></span>
                                        <span class="font-medium text-slate-200" x-text="currentItem.vessel"></span>
                                    </div>
                                </div>
                                <div class="flex items-start gap-2.5 p-2.5 rounded-lg bg-navy-950/60 border border-navy-800">
                                    <i class="fa-solid fa-compass text-emerald-400 mt-0.5 flex-shrink-0"></i>
                                    <div>
                                        <span class="block text-[10px] uppercase text-slate-400 font-semibold"><?= lang('App.gallery_focal') ?></span>
                                        <span class="font-medium text-slate-200" x-text="currentItem.focal"></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Narrative Description -->
                            <div class="space-y-1.5 pt-1">
                                <span class="block text-[11px] uppercase tracking-wider text-slate-400 font-bold"><?= lang('App.gallery_technical_desc') ?></span>
                                <p class="text-xs text-slate-300 leading-relaxed" x-text="currentItem.desc"></p>
                            </div>
                        </div>

                        <!-- Footer Actions -->
                        <div class="pt-4 border-t border-navy-800 flex items-center justify-between gap-3">
                            <a :href="currentItem.image" target="_blank" rel="noopener noreferrer"
                               class="inline-flex items-center gap-2 text-xs font-semibold text-gold-400 hover:text-gold-300 transition-colors">
                                <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i> <?= lang('App.gallery_open_original') ?>
                            </a>
                            <button @click="close()" class="px-4 py-2 rounded-lg bg-navy-800 hover:bg-navy-700 text-xs font-semibold text-slate-200 transition-colors active:scale-[0.98]">
                                <?= lang('App.btn_close') ?>
                            </button>
                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>
</section>

<script>
function galleryLightbox() {
    const isEn = <?= $isEn ? 'true' : 'false' ?>;
    return {
        activeFilter: 'all',
        isOpen: false,
        currentIndex: 0,
        items: isEn ? [
            {
                id: 1,
                title: 'North Natuna Oceanographic Expedition',
                category: 'ekspedisi',
                categoryLabel: 'Sea Expedition',
                badgeClass: 'bg-gold-500/20 text-gold-400 border-gold-500/30',
                image: '<?= base_url('images/hero_ship.jpg') ?>',
                date: '12 - 25 November 2025',
                location: 'North Natuna Sea (Indonesian EEZ Zone)',
                vessel: 'UMRAH - BRIN Collaborative Research Vessel',
                focal: 'Thermocline Characteristics & Layer Current Dynamics',
                desc: 'Deep-sea research cruise measuring temperature profiles, salinity, and underwater acoustic transmission layer by layer using ADCP sensors and CTD rosette down to 150 meters depth.'
            },
            {
                id: 2,
                title: 'Bathymetric & Underwater Acoustic Survey',
                category: 'ekspedisi',
                categoryLabel: 'Sea Expedition',
                badgeClass: 'bg-gold-500/20 text-gold-400 border-gold-500/30',
                image: '<?= base_url('images/batimetri_survey.jpg') ?>',
                date: '14 - 22 January 2026',
                location: 'Helen Mars Reef Navigation Route, Malacca Strait',
                vessel: 'KM. Baruna Jaya IV & UMRAH Hydrography Team',
                focal: 'IHO S-44 Standard Underwater Hazard Mapping',
                desc: 'High-resolution seafloor depth sounding using Multibeam Echosounder (MBES) and marine RTK-DGPS to validate safe draft navigation depth limits for commercial tankers.'
            },
            {
                id: 3,
                title: 'Mangrove Ecology & Blue Carbon Bintan',
                category: 'blue-carbon',
                categoryLabel: 'Blue Carbon',
                badgeClass: 'bg-emerald-500/20 text-emerald-300 border-emerald-500/30',
                image: '<?= base_url('images/mangrove_research.jpg') ?>',
                date: '03 - 10 February 2026',
                location: 'Sebong Pereh Mangrove Forest Area, Bintan',
                vessel: 'Mini Catamaran Coastal Ecology Division',
                focal: 'Sediment Coring & Blue Carbon Stock Valuation',
                desc: 'Mangrove sediment coring down to 1-meter depth and greenhouse gas flux measurement to calculate coastal blue carbon reserves for local community conservation incentives.'
            },
            {
                id: 4,
                title: 'Oceanography & Marine Instrumentation Laboratory',
                category: 'laboratorium',
                categoryLabel: 'Laboratory',
                badgeClass: 'bg-maritime-500/20 text-maritime-300 border-maritime-500/30',
                image: '<?= base_url('images/lab_oseanografi.jpg') ?>',
                date: 'Routine Operations 2026',
                location: 'Marine Laboratory Building, Dompak Campus',
                vessel: 'LPPM Oceanographic Instrument Calibration Facility',
                focal: 'Sensor Calibration for CTD, SVP & Sonar Acoustics',
                desc: 'Calibration and testing center for physical oceanographic instruments prior to offshore deployment, equipped with hydro-acoustic sensor testing tanks and ISO 17025 compliant service stations.'
            },
            {
                id: 5,
                title: 'Coastal Water Quality & Sediment Analysis',
                category: 'laboratorium',
                categoryLabel: 'Laboratory',
                badgeClass: 'bg-maritime-500/20 text-maritime-300 border-maritime-500/30',
                image: '<?= base_url('images/kualitas_air_sedimen.jpg') ?>',
                date: 'Routine Operations 2026',
                location: 'UMRAH Integrated Chemistry Laboratory, Tanjungpinang',
                vessel: 'Spectrophotometry & Granulometry Division',
                focal: 'Marine Water Quality & Heavy Metal Parameters',
                desc: 'Accredited testing for marine physical, chemical, and biological parameters: turbidity, TSS, chlorophyll-a, nutrients, and coastal sediment grain size fractionation.'
            },
            {
                id: 6,
                title: 'Tidal Observation & Marine Weather Station',
                category: 'laboratorium',
                categoryLabel: 'Laboratory',
                badgeClass: 'bg-maritime-500/20 text-maritime-300 border-maritime-500/30',
                image: '<?= base_url('images/stasiun_pasut_cuaca.jpg') ?>',
                date: 'Real-time 24/7 Monitoring',
                location: 'Dompak Pier Tide Station, Riau Strait',
                vessel: 'AWLR Radar Telemetry & Automatic Weather Station (AWS)',
                focal: '18.6-Year Tidal Harmonics & Coastal Meteorology',
                desc: 'Automated observation station recording real-time sea level fluctuations, surface wind speed/direction, barometric pressure, and marine solar radiation for national datum hydrography.'
            }
        ] : [
            {
                id: 1,
                title: 'Ekspedisi Oseanografi Natuna Utara',
                category: 'ekspedisi',
                categoryLabel: 'Ekspedisi Laut',
                badgeClass: 'bg-gold-500/20 text-gold-400 border-gold-500/30',
                image: '<?= base_url('images/hero_ship.jpg') ?>',
                date: '12 - 25 November 2025',
                location: 'Laut Natuna Utara (Wilayah ZEE Indonesia)',
                vessel: 'Kapal Riset Kolaboratif UMRAH - BRIN',
                focal: 'Karakteristik Termoklin & Dinamika Arus Lapisan',
                desc: 'Pelayaran riset laut dalam untuk mengukur profil suhu, salinitas, dan transmisi akustik bawah air lapis demi lapis menggunakan sensor Acoustic Doppler Current Profiler (ADCP) dan CTD rosette hingga kedalaman 150 meter.'
            },
            {
                id: 2,
                title: 'Survei Batimetri & Akustik Bawah Air',
                category: 'ekspedisi',
                categoryLabel: 'Ekspedisi Laut',
                badgeClass: 'bg-gold-500/20 text-gold-400 border-gold-500/30',
                image: '<?= base_url('images/batimetri_survey.jpg') ?>',
                date: '14 - 22 Januari 2026',
                location: 'Alur Pelayaran Karang Helen Mars, Selat Malaka',
                vessel: 'KM. Baruna Jaya IV & Tim Hidrografi UMRAH',
                focal: 'Pemetaan Hazard Bawah Air Standar IHO S-44',
                desc: 'Pemeruman kedalaman laut resolusi tinggi menggunakan Multibeam Echosounder (MBES) dan RTK-DGPS maritim untuk memvalidasi batas aman kedalaman draft kapal tanker komersial internasional yang melintasi Selat Malaka.'
            },
            {
                id: 3,
                title: 'Ekologi Mangrove & Blue Carbon Bintan',
                category: 'blue-carbon',
                categoryLabel: 'Blue Carbon',
                badgeClass: 'bg-emerald-500/20 text-emerald-300 border-emerald-500/30',
                image: '<?= base_url('images/mangrove_research.jpg') ?>',
                date: '03 - 10 Februari 2026',
                location: 'Kawasan Hutan Mangrove Sebong Pereh, Bintan',
                vessel: 'Wahana Katamaran Mini Divisi Ekologi Pesisir',
                focal: 'Sediment Coring & Valuasi Stok Karbon Biru',
                desc: 'Pengambilan sampel inti sedimen (sediment coring) tanah mangrove hingga kedalaman 1 meter dan pengukuran fluks gas rumah kaca guna menghitung cadangan karbon biru untuk skema insentif konservasi masyarakat adat.'
            },
            {
                id: 4,
                title: 'Laboratorium Oseanografi & Instrumentasi Kelautan',
                category: 'laboratorium',
                categoryLabel: 'Laboratorium',
                badgeClass: 'bg-maritime-500/20 text-maritime-300 border-maritime-500/30',
                image: '<?= base_url('images/lab_oseanografi.jpg') ?>',
                date: 'Operasional Rutin 2026',
                location: 'Gedung Laboratorium Kelautan Kampus Dompak',
                vessel: 'Fasilitas Kalibrasi Instrumen Oseanografi LPPM',
                focal: 'Kalibrasi Sensor CTD, SVP & Sonar Akustik',
                desc: 'Pusat kalibrasi dan pengujian perangkat oseanografi fisik sebelum diterjunkan ke laut lepas. Dilengkapi bak uji sensor hidro-akustik, meja kalibrasi geodetik, serta stasiun servis elektronik perkapalan berstandar ISO 17025.'
            },
            {
                id: 5,
                title: 'Analisis Kualitas Air & Sedimen Pantai',
                category: 'laboratorium',
                categoryLabel: 'Laboratorium',
                badgeClass: 'bg-maritime-500/20 text-maritime-300 border-maritime-500/30',
                image: '<?= base_url('images/kualitas_air_sedimen.jpg') ?>',
                date: 'Operasional Rutin 2026',
                location: 'Laboratorium Kimia Terpadu UMRAH, Tanjungpinang',
                vessel: 'Divisi Instrumentasi Spektrofotometri & Granulometri',
                focal: 'Baku Mutu Air Laut & Logam Berat PP 22/2021',
                desc: 'Pengujian terakreditasi untuk parameter fisika, kimia, dan biologi laut: turbiditas, TSS, klorofil-a, nutrien (nitrat/fosfat), serta fraksionasi ukuran butir sedimen pantai guna keperluan AMDAL proyek pelabuhan dan kawasan industri.'
            },
            {
                id: 6,
                title: 'Stasiun Pengamatan Pasang Surut & Cuaca Maritim',
                category: 'laboratorium',
                categoryLabel: 'Laboratorium',
                badgeClass: 'bg-maritime-500/20 text-maritime-300 border-maritime-500/30',
                image: '<?= base_url('images/stasiun_pasut_cuaca.jpg') ?>',
                date: 'Pemantauan Real-time 24/7',
                location: 'Stasiun Pengamat Pasut Dermaga Dompak, Selat Riau',
                vessel: 'Stasiun Telemetri AWLR Radar & Automatic Weather Station (AWS)',
                focal: 'Harmonik Pasut 18.6 Tahun & Meteorologi Pesisir',
                desc: 'Stasiun observasi otomatis terintegrasi telemetri seluler/satelit yang merekam fluktuasi pasang surut air laut real-time, kecepatan/arah angin permukaan, tekanan udara, serta radiasi surya maritim untuk referensi datum hidrografi nasional.'
            }
        ],
        get filteredItems() {
            if (this.activeFilter === 'all') return this.items;
            return this.items.filter(item => item.category === this.activeFilter);
        },
        setFilter(filter) {
            this.activeFilter = filter;
            this.currentIndex = 0;
        },
        open(index) {
            this.currentIndex = index;
            this.isOpen = true;
            document.body.classList.add('overflow-hidden');
        },
        close() {
            this.isOpen = false;
            document.body.classList.remove('overflow-hidden');
        },
        next() {
            this.currentIndex = (this.currentIndex + 1) % this.filteredItems.length;
        },
        prev() {
            this.currentIndex = (this.currentIndex - 1 + this.filteredItems.length) % this.filteredItems.length;
        },
        get currentItem() {
            return this.filteredItems[this.currentIndex] || this.items[0];
        }
    };
}
</script>

<!-- Berita & Agenda Terkini -->
<section class="py-16 bg-sand">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-10 gap-4">
            <div>
                <span class="text-xs uppercase font-bold tracking-wider text-maritime-600"><?= lang('App.news_tag') ?></span>
                <h3 class="text-2xl sm:text-3xl font-extrabold text-navy-950 mt-1"><?= lang('App.news_heading') ?></h3>
                <p class="text-xs sm:text-sm text-slate-600 mt-1"><?= lang('App.news_desc') ?></p>
            </div>
            <a href="<?= base_url('berita') ?>" class="inline-flex items-center gap-2 text-xs font-bold text-maritime-600 hover:text-maritime-800">
                <?= lang('App.news_archive') ?> <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php foreach ($latest_news as $news): ?>
            <article class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg border border-slate-200 transition-all duration-300 flex flex-col justify-between group">
                <!-- Thumbnail Image with Category Badge -->
                <div class="h-48 relative overflow-hidden">
                    <img src="<?= esc($news['image']) ?>" alt="<?= esc($news['title']) ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-navy-950/80 via-transparent to-black/20 pointer-events-none"></div>
                    <span class="absolute top-3 left-3 px-2.5 py-1 rounded bg-navy-950/85 backdrop-blur-sm text-gold-400 font-bold text-[10px] uppercase tracking-wider border border-gold-400/20">
                        <?= esc($news['category']) ?>
                    </span>
                    <div class="absolute bottom-3 left-3 text-white/90 text-[11px] flex items-center gap-2">
                        <i class="fa-regular fa-calendar"></i>
                        <span><?= esc($news['date']) ?></span>
                    </div>
                </div>

                <div class="p-5 flex-grow flex flex-col justify-between space-y-3">
                    <h4 class="text-sm sm:text-base font-bold text-navy-900 group-hover:text-maritime-600 transition-colors leading-snug line-clamp-2">
                        <a href="<?= base_url('berita/' . $news['slug']) ?>">
                            <?= esc($news['title']) ?>
                        </a>
                    </h4>
                    <p class="text-xs text-slate-600 line-clamp-3 leading-relaxed">
                        <?= esc($news['excerpt']) ?>
                    </p>
                    <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                        <span><i class="fa-solid fa-user-pen mr-1 text-slate-400"></i> <?= esc($news['author']) ?></span>
                        <a href="<?= base_url('berita/' . $news['slug']) ?>" class="font-semibold text-maritime-600 hover:text-navy-900"><?= lang('App.btn_read_more') ?> →</a>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Mitra Kerjasama Strategis -->
<section class="py-14 bg-white border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="max-w-2xl mx-auto mb-8 space-y-1">
            <span class="text-[11px] uppercase font-bold tracking-widest text-gold-600 block"><?= lang('App.partner_tag') ?></span>
            <h3 class="text-xl sm:text-2xl font-extrabold text-navy-950"><?= lang('App.partner_heading') ?></h3>
            <p class="text-slate-500 text-xs sm:text-sm"><?= lang('App.partner_desc') ?></p>
        </div>

        <!-- Partner Logos Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 sm:gap-6 items-center">
            <?php foreach ($partners as $partner): ?>
            <div class="group p-4 sm:p-5 rounded-2xl border border-slate-200/80 bg-slate-50/60 hover:bg-white hover:border-maritime-300 hover:shadow-md transition-all duration-300 flex flex-col items-center justify-center h-28 relative">
                <img src="<?= esc($partner['logo']) ?>" 
                     alt="<?= esc($partner['name']) ?>" 
                     title="<?= esc($partner['name']) ?>"
                     class="h-10 sm:h-12 w-auto max-w-[170px] object-contain filter grayscale opacity-75 group-hover:grayscale-0 group-hover:opacity-100 group-hover:scale-105 transition-all duration-300">
                <span class="sr-only"><?= esc($partner['name']) ?></span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
