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
<div class="py-16 bg-slate-50">
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
                        <span class="text-[11px] text-slate-400"><?= esc($j['frequency'] ?? ($isEn ? 'Biannual Publication' : 'Terbit 2x Setahun')) ?></span>
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
                        'slug'            => $pb['number'] ?? 'pb-diplomasi-perbatasan-natuna',
                        'file_size'       => '3.5 MB',
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
                        <a href="<?= base_url('unduhan/unduh/' . ($enrichedPb['slug'] ?? 'pb-' . $pb['id'])) ?>"
                           class="inline-flex items-center gap-2 bg-slate-100 hover:bg-navy-900 hover:text-gold-400 text-slate-700 text-xs font-semibold px-4 py-2.5 rounded-lg border border-slate-200 transition-all active:scale-[0.98] shadow-xs group cursor-pointer">
                            <i class="fa-regular fa-file-pdf text-rose-500 text-sm group-hover:scale-110 transition-transform"></i> <?= $isEn ? 'Download PDF' : 'Unduh PDF' ?>
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection() ?>
