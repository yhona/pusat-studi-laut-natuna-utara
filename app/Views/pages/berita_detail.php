<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<?php $isEn = (service('request')->getLocale() === 'en'); ?>

<!-- Page Header Banner / Breadcrumbs -->
<div class="bg-navy-950 text-white py-12 relative overflow-hidden border-b-2 border-gold-500">
    <div class="absolute inset-0 opacity-10 bg-pattern"></div>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-4">
        <nav class="flex flex-wrap items-center gap-2 text-xs text-gold-400 font-medium">
            <a href="<?= base_url() ?>" class="hover:underline flex items-center gap-1">
                <i class="fa-solid fa-house text-[10px]"></i> <?= lang('App.nav_home') ?>
            </a>
            <span>/</span>
            <a href="<?= base_url('berita') ?>" class="hover:underline"><?= lang('App.nav_news') ?></a>
            <span>/</span>
            <span class="text-slate-300 truncate max-w-xs sm:max-w-md"><?= esc($article['title']) ?></span>
        </nav>

        <div class="flex flex-wrap items-center gap-2">
            <span class="px-3 py-1 rounded-full bg-gold-500/20 text-gold-400 border border-gold-500/30 text-xs font-bold uppercase tracking-wider">
                <?= esc($article['category']) ?>
            </span>
            <span class="text-slate-400 text-xs flex items-center gap-1">
                <i class="fa-regular fa-clock text-gold-400"></i> <?= esc($article['read_time']) ?>
            </span>
        </div>

        <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold tracking-tight text-white leading-tight">
            <?= esc($article['title']) ?>
        </h1>

        <!-- Metadata Bar -->
        <div class="flex flex-wrap items-center justify-between gap-4 pt-4 border-t border-navy-800 text-xs text-slate-300">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-maritime-800 border border-gold-500/40 flex items-center justify-center text-gold-400 font-bold text-sm">
                    <i class="fa-solid fa-user-pen"></i>
                </div>
                <div>
                    <span class="font-semibold text-white block text-sm"><?= esc($article['author']) ?></span>
                    <span class="text-slate-400 text-[11px]"><?= esc($article['author_role']) ?></span>
                </div>
            </div>
            <div class="flex items-center gap-4 text-xs">
                <span class="flex items-center gap-1.5 text-slate-300">
                    <i class="fa-regular fa-calendar text-gold-400"></i> <?= esc($article['date']) ?>
                </span>
            </div>
        </div>
    </div>
</div>

<!-- Main Article Section -->
<div class="py-14 bg-slate-50" x-data="{ copied: false, copyShareUrl() { navigator.clipboard.writeText(window.location.href); this.copied = true; setTimeout(() => this.copied = false, 2500); } }">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
            
            <!-- Left / Main Article Body (8 cols) -->
            <article class="lg:col-span-8 bg-white rounded-2xl p-6 sm:p-10 border border-slate-200 shadow-sm space-y-8">
                
                <!-- Featured Image -->
                <?php if (!empty($article['image'])): ?>
                <div class="space-y-2">
                    <div class="rounded-xl overflow-hidden shadow-md border border-slate-200 aspect-video bg-navy-900">
                        <img src="<?= base_url($article['image']) ?>" alt="<?= esc($article['title']) ?>" class="w-full h-full object-cover">
                    </div>
                    <?php if (!empty($article['image_caption'])): ?>
                    <p class="text-xs text-slate-500 italic text-center px-2">
                        <i class="fa-solid fa-camera mr-1 text-slate-400"></i> <?= esc($article['image_caption']) ?>
                    </p>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <!-- Excerpt / Lead Paragraph -->
                <div class="text-base sm:text-lg font-medium text-slate-800 leading-relaxed border-l-4 border-maritime-600 pl-4 py-1 bg-maritime-50/50 rounded-r-lg">
                    <?= esc($article['excerpt']) ?>
                </div>

                <?php 
                $showPulitzerVideo = ($article['slug'] === 'didukung-pendanaan-dari-pulitzer-center-umrah-dan-uns-kolaborasi-riset-internasional' 
                    || str_contains($article['slug'], 'pulitzer') 
                    || str_contains($article['slug'], 'ekspedisi-maritim-natuna-utara-2026'));
                ?>
                <?php if ($showPulitzerVideo): ?>
                <!-- Investigative Research Documentary Video Player -->
                <div class="my-6 rounded-2xl overflow-hidden border border-slate-700/80 bg-gradient-to-b from-navy-950 to-slate-950 text-white shadow-xl not-prose">
                    <!-- Player Header Bar -->
                    <div class="px-4 sm:px-6 py-3.5 bg-slate-900/90 border-b border-slate-800 flex flex-wrap items-center justify-between gap-3">
                        <div class="flex items-center gap-2.5">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-red-600 text-white uppercase tracking-wider shadow-sm">
                                <i class="fa-solid fa-circle-play text-xs animate-pulse"></i>
                                <?= $isEn ? 'Official Documentary' : 'Dokumenter Resmi' ?>
                            </span>
                            <span class="text-xs sm:text-sm font-bold text-slate-200">
                                Regulatory Blind Spots (2026)
                            </span>
                        </div>
                        <div class="flex items-center gap-2 text-xs text-slate-400">
                            <span class="px-2 py-0.5 rounded bg-slate-800 border border-slate-700 font-mono text-[11px] text-gold-400 font-medium">1080p FHD</span>
                            <span class="flex items-center gap-1"><i class="fa-regular fa-clock text-gold-400"></i> 2:16</span>
                        </div>
                    </div>
                    
                    <!-- Video Embed -->
                    <div class="relative aspect-video bg-black flex items-center justify-center">
                        <video 
                            id="pulitzerDocVideo"
                            controls 
                            preload="metadata" 
                            poster="<?= base_url('videos/regulatory_blind_spots_poster.jpg') ?>" 
                            class="w-full h-full object-contain focus:outline-none"
                            playsinline
                        >
                            <source src="<?= base_url('videos/regulatory_blind_spots.mp4') ?>" type="video/mp4">
                            <?= $isEn 
                                ? 'Your browser does not support the video tag. Please download the video using the link below.' 
                                : 'Peramban Anda tidak mendukung pemutar video HTML5. Silakan unduh video melalui tombol di bawah.' ?>
                        </video>
                    </div>

                    <!-- Player Footer & Metadata -->
                    <div class="p-4 sm:p-5 bg-slate-900/95 border-t border-slate-800 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 text-xs">
                        <div class="space-y-1.5 text-slate-300 max-w-xl">
                            <p class="font-semibold text-white flex items-center gap-2">
                                <i class="fa-solid fa-film text-gold-400"></i>
                                <?= $isEn 
                                    ? 'Research Documentary: Beneficial Ownership & Illegal Fishing in Natuna Waters' 
                                    : 'Dokumenter Riset: Beneficial Ownership & Celah Hukum Illegal Fishing di Laut Natuna' ?>
                            </p>
                            <p class="text-slate-400 leading-relaxed text-[11px] sm:text-xs">
                                <?= $isEn 
                                    ? 'Investigative documentary produced under the Pulitzer Center Washington DC international grant, examining law enforcement gaps and beneficial ownership tracking of foreign fishing vessels in Natuna.' 
                                    : 'Video dokumenter hasil riset kolaborasi internasional UMRAH dan UNS yang didanai Pulitzer Center Washington DC, merekam langsung investigasi empiris pengawasan celah hukum dan pemilik manfaat (beneficial ownership) kapal perikanan di Natuna.' ?>
                            </p>
                        </div>
                        <div class="flex items-center gap-2 flex-shrink-0 w-full sm:w-auto justify-end">
                            <a 
                                href="<?= base_url('videos/regulatory_blind_spots.mp4') ?>" 
                                download="Regulatory_Blind_Spots_UMRAH_UNS_Pulitzer.mp4" 
                                class="inline-flex items-center gap-2 px-3.5 py-2 rounded-lg bg-slate-800 hover:bg-maritime-700 text-white text-xs font-semibold border border-slate-700 hover:border-maritime-500 transition shadow-sm"
                                title="<?= $isEn ? 'Download Full HD Video' : 'Unduh Video Kualitas Penuh HD' ?>"
                            >
                                <i class="fa-solid fa-download text-gold-400"></i>
                                <span><?= $isEn ? 'Download Video (64 MB)' : 'Unduh Video (64 MB)' ?></span>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Main Narrative Content -->
                <div class="space-y-5 text-slate-700 text-sm sm:text-base leading-relaxed text-justify">
                    <?php foreach ($article['content'] as $idx => $para): ?>
                        <p><?= esc($para) ?></p>

                        <?php if ($idx === 1 && !empty($article['key_takeaways'])): ?>
                        <!-- Key Takeaways Highlight Box -->
                        <div class="my-6 p-5 sm:p-6 bg-gradient-to-br from-navy-950 to-navy-900 text-white rounded-xl shadow-md border border-gold-500/30 space-y-3 not-prose">
                            <div class="flex items-center gap-2 text-gold-400 font-bold text-xs uppercase tracking-wider">
                                <i class="fa-solid fa-lightbulb text-gold-400"></i>
                                <span><?= $isEn ? 'Key Research Findings & Highlights' : 'Poin Kunci & Temuan Riset' ?></span>
                            </div>
                            <ul class="space-y-2 text-xs sm:text-sm text-slate-200">
                                <?php foreach ($article['key_takeaways'] as $point): ?>
                                <li class="flex items-start gap-2">
                                    <i class="fa-solid fa-circle-check text-gold-400 text-xs mt-1 flex-shrink-0"></i>
                                    <span><?= esc($point) ?></span>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

                <!-- Tags -->
                <?php if (!empty($article['tags'])): ?>
                <div class="pt-6 border-t border-slate-100 flex flex-wrap items-center gap-2">
                    <span class="text-xs font-semibold text-slate-500 mr-1"><i class="fa-solid fa-tags"></i> <?= $isEn ? 'Topics:' : 'Topik:' ?></span>
                    <?php foreach ($article['tags'] as $tag): ?>
                    <span class="px-3 py-1 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-medium transition-colors">
                        #<?= esc($tag) ?>
                    </span>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <!-- Social Share Bar -->
                <div class="pt-6 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <span class="text-xs font-bold text-slate-700 uppercase tracking-wider flex items-center gap-1.5">
                        <i class="fa-solid fa-share-nodes text-maritime-600"></i> <?= $isEn ? 'Share This Article:' : 'Bagikan Artikel Ini:' ?>
                    </span>
                    <div class="flex items-center gap-2">
                        <!-- WhatsApp -->
                        <a href="https://api.whatsapp.com/send?text=<?= urlencode($article['title'] . ' ' . current_url()) ?>" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white flex items-center justify-center text-sm shadow transition-colors" title="<?= $isEn ? 'Share via WhatsApp' : 'Bagikan via WhatsApp' ?>">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                        <!-- Twitter/X -->
                        <a href="https://twitter.com/intent/tweet?text=<?= urlencode($article['title']) ?>&url=<?= urlencode(current_url()) ?>" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-lg bg-black hover:bg-slate-800 text-white flex items-center justify-center text-sm shadow transition-colors" title="<?= $isEn ? 'Share to X' : 'Bagikan ke X' ?>">
                            <i class="fa-brands fa-x-twitter"></i>
                        </a>
                        <!-- LinkedIn -->
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= urlencode(current_url()) ?>" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-lg bg-sky-700 hover:bg-sky-800 text-white flex items-center justify-center text-sm shadow transition-colors" title="<?= $isEn ? 'Share to LinkedIn' : 'Bagikan ke LinkedIn' ?>">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </a>
                        <!-- Copy Link Button -->
                        <div class="relative">
                            <button @click="copyShareUrl()" type="button" class="px-3 h-9 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold flex items-center gap-1.5 border border-slate-200 shadow-sm transition-colors">
                                <i class="fa-solid fa-link text-slate-500"></i>
                                <span x-text="copied ? '<?= $isEn ? 'Copied!' : 'Tersalin!' ?>' : '<?= $isEn ? 'Copy Link' : 'Salin Tautan' ?>'"><?= $isEn ? 'Copy Link' : 'Salin Tautan' ?></span>
                            </button>
                            <span x-show="copied" x-cloak class="absolute -top-8 left-1/2 -translate-x-1/2 px-2 py-1 bg-navy-900 text-gold-400 text-[10px] rounded shadow-md whitespace-nowrap">
                                <?= $isEn ? 'URL copied to clipboard!' : 'URL disalin ke clipboard!' ?>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Author Bio Box -->
                <div class="p-6 rounded-xl bg-slate-50 border border-slate-200 flex flex-col sm:flex-row items-center sm:items-start gap-4 text-center sm:text-left">
                    <div class="w-14 h-14 rounded-full bg-navy-900 text-gold-400 flex items-center justify-center text-2xl flex-shrink-0 shadow">
                        <i class="fa-solid fa-user-graduate"></i>
                    </div>
                    <div class="space-y-1">
                        <h4 class="text-sm font-bold text-navy-950"><?= esc($article['author']) ?></h4>
                        <p class="text-xs text-maritime-700 font-medium"><?= esc($article['author_role']) ?></p>
                        <p class="text-xs text-slate-500 leading-relaxed pt-1">
                            <?= $isEn 
                                ? 'Active research fellow at the North Natuna Sea Research Center (NNSRC), Universitas Maritim Raja Ali Haji (UMRAH). Committed to advancing marine scientific dissemination and archipelagic maritime sovereignty.' 
                                : 'Periset aktif di lingkungan Pusat Studi Laut Natuna Utara (North Natuna Sea Research Center) Universitas Maritim Raja Ali Haji (UMRAH). Berkomitmen dalam diseminasi iptek kelautan dan kedaulatan bahari nusantara.' ?>
                        </p>
                    </div>
                </div>

                <!-- Back to Archive Button -->
                <div class="pt-4">
                    <a href="<?= base_url('berita') ?>" class="inline-flex items-center gap-2 text-maritime-700 hover:text-navy-950 font-semibold text-xs sm:text-sm group">
                        <i class="fa-solid fa-arrow-left transition-transform group-hover:-translate-x-1"></i>
                        <span><?= $isEn ? 'Back to News & Agenda Archive' : 'Kembali ke Arsip Berita & Agenda' ?></span>
                    </a>
                </div>

            </article>

            <!-- Right Sidebar: Quick Navigation & Info (4 cols) -->
            <aside class="lg:col-span-4 space-y-6">
                
                <!-- Callout Card: Research Cooperation -->
                <div class="bg-gradient-to-br from-navy-900 to-maritime-900 text-white rounded-2xl p-6 shadow-md border border-navy-800 space-y-4">
                    <div class="w-10 h-10 rounded-xl bg-gold-500/20 text-gold-400 flex items-center justify-center text-lg">
                        <i class="fa-solid fa-handshake"></i>
                    </div>
                    <h4 class="text-base font-bold text-white"><?= $isEn ? 'Research Collaboration & Publishing' : 'Kolaborasi Riset & Publikasi' ?></h4>
                    <p class="text-xs text-slate-300 leading-relaxed">
                        <?= $isEn 
                            ? 'The North Natuna Sea Research Center (NNSRC) welcomes institutional partnerships with government agencies, SOEs, private sectors, and global university partners in marine science.' 
                            : 'Pusat Studi Laut Natuna Utara (North Natuna Sea Research Center) membuka peluang kemitraan dengan instansi pemerintah, BUMN, swasta, dan universitas mitra dalam studi kelautan.' ?>
                    </p>
                    <a href="<?= base_url('kontak#kerjasama') ?>" class="inline-block w-full text-center py-2.5 px-4 rounded-lg bg-gold-500 hover:bg-gold-400 text-navy-950 font-bold text-xs shadow transition-colors">
                        <?= $isEn ? 'Propose Research Partnership' : 'Ajukan Kemitraan Riset' ?>
                    </a>
                </div>

                <!-- Repositori Unduhan CTA -->
                <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-maritime-50 text-maritime-600 flex items-center justify-center text-lg flex-shrink-0">
                            <i class="fa-solid fa-download"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-navy-950"><?= $isEn ? 'Download Center & Documents' : 'Pusat Unduhan & Dokumen' ?></h4>
                            <p class="text-[11px] text-slate-500"><?= $isEn ? 'Lab SOPs, Policy Briefs, and Templates' : 'SOP Lab, Policy Brief, dan Template' ?></p>
                        </div>
                    </div>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        <?= $isEn 
                            ? 'Access official bathymetry guidelines, partnership forms, and strategic maritime policy briefs.' 
                            : 'Dapatkan naskah resmi pedoman survei batimetri, formulir kerjasama, dan publikasi kajian strategis kemaritiman.' ?>
                    </p>
                    <a href="<?= base_url('unduhan') ?>" class="inline-flex items-center gap-1.5 text-xs font-semibold text-maritime-600 hover:text-navy-950 pt-1">
                        <span><?= $isEn ? 'Open Document Repository' : 'Buka Repositori Dokumen' ?></span>
                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>

            </aside>

        </div>

        <!-- Related Articles Section (3 Cards Grid) -->
        <?php if (!empty($related)): ?>
        <section class="mt-16 pt-12 border-t border-slate-200 space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-2">
                <div>
                    <span class="text-maritime-600 uppercase text-xs font-bold tracking-wider block"><?= $isEn ? 'Related Dissemination' : 'Diseminasi Terkait' ?></span>
                    <h3 class="text-xl sm:text-2xl font-bold text-navy-950 mt-0.5"><?= $isEn ? 'Related Articles & Agenda' : 'Artikel & Agenda Terkait' ?></h3>
                </div>
                <a href="<?= base_url('berita') ?>" class="text-xs font-semibold text-maritime-700 hover:text-navy-950 flex items-center gap-1">
                    <span><?= $isEn ? 'View All News' : 'Lihat Semua Berita' ?></span>
                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php foreach ($related as $rel): ?>
                <article class="bg-white rounded-xl overflow-hidden shadow-xs hover:shadow-lg border border-slate-200 transition-all duration-300 flex flex-col justify-between group">
                    <div class="h-40 bg-navy-900 relative overflow-hidden">
                        <?php if (!empty($rel['image'])): ?>
                        <img src="<?= base_url($rel['image']) ?>" alt="<?= esc($rel['title']) ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <?php endif; ?>
                        <div class="absolute inset-0 bg-gradient-to-t from-navy-950 via-transparent to-transparent opacity-80"></div>
                        <span class="absolute top-3 left-3 px-2 py-0.5 rounded bg-navy-950/90 text-gold-400 font-bold text-[10px] uppercase tracking-wider border border-gold-400/20">
                            <?= esc($rel['category']) ?>
                        </span>
                        <span class="absolute bottom-3 left-3 text-white/80 text-[11px] flex items-center gap-1.5">
                            <i class="fa-regular fa-calendar"></i> <?= esc($rel['date']) ?>
                        </span>
                    </div>

                    <div class="p-5 flex-grow flex flex-col justify-between space-y-3">
                        <h4 class="text-sm font-bold text-navy-950 group-hover:text-maritime-600 transition-colors leading-snug line-clamp-2">
                            <a href="<?= base_url('berita/' . $rel['slug']) ?>">
                                <?= esc($rel['title']) ?>
                            </a>
                        </h4>
                        <p class="text-xs text-slate-600 line-clamp-2 leading-relaxed">
                            <?= esc($rel['excerpt']) ?>
                        </p>
                        <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                            <span class="text-slate-400 text-[11px] truncate max-w-[120px]"><i class="fa-solid fa-user text-slate-300 mr-1"></i> <?= esc($rel['author']) ?></span>
                            <a href="<?= base_url('berita/' . $rel['slug']) ?>" class="font-semibold text-maritime-600 hover:text-navy-950 flex items-center gap-1">
                                <span><?= $isEn ? 'Read' : 'Baca' ?></span> <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>
                </article>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endif; ?>

    </div>
</div>

<?= $this->endSection() ?>
