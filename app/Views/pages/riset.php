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
            <span class="text-slate-300"><?= lang('App.nav_research') ?></span>
        </nav>
        <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight text-white"><?= lang('App.nav_research_roadmap') ?></h1>
        <p class="text-slate-300 text-xs sm:text-sm mt-1 max-w-2xl">
            <?= $isEn ? 'Long-term multidisciplinary research roadmap of Raja Ali Haji Maritime University to advance national ocean science autonomy.' : 'Peta jalan penelitian multidisiplin jangka panjang Universitas Maritim Raja Ali Haji untuk mewujudkan kemandirian sains kelautan nasional.' ?>
        </p>
    </div>
</div>

<!-- Content -->
<div class="py-16 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
        
        <!-- 4 Klaster Riset Section -->
        <div class="space-y-8">
            <div>
                <span class="text-maritime-600 uppercase text-xs font-bold tracking-wider block"><?= $isEn ? 'Scientific Architecture' : 'Arsitektur Keilmuan' ?></span>
                <h3 class="text-2xl font-bold text-navy-950 mt-1"><?= $isEn ? 'Strategic Research Clusters' : 'Klaster Bidang Unggulan Riset' ?></h3>
                <p class="text-slate-600 text-xs sm:text-sm mt-1"><?= $isEn ? 'Specifically structured to address Riau Islands archipelagic challenges and Indonesian maritime sovereignty.' : 'Didesain secara khusus untuk menjawab tantangan geografis Kepulauan Riau dan kedaulatan laut Indonesia.' ?></p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <?php foreach ($clustersList as $cl): ?>
                <div id="<?= esc($cl['slug']) ?>" class="bg-white rounded-2xl p-7 border border-slate-200 shadow-sm space-y-4 flex flex-col justify-between group hover:shadow-lg transition-shadow">
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="w-11 h-11 rounded-xl bg-maritime-50 text-maritime-600 flex items-center justify-center text-xl flex-shrink-0 group-hover:bg-navy-900 group-hover:text-gold-400 transition-colors">
                                <i class="fa-solid <?= esc($cl['icon']) ?>"></i>
                            </div>
                            <div>
                                <span class="text-[11px] font-bold text-slate-400 uppercase"><?= esc($cl['badge']) ?></span>
                                <h4 class="text-base font-bold text-navy-950 group-hover:text-maritime-600 transition-colors">
                                    <a href="<?= base_url('riset/' . $cl['slug']) ?>"><?= esc($cl['title']) ?></a>
                                </h4>
                            </div>
                        </div>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            <?= esc($cl['mandate']) ?>
                        </p>
                    </div>
                    <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                        <span class="text-slate-500"><strong class="text-slate-700"><?= lang('App.cluster_coordinator') ?>:</strong> <?= esc($cl['coordinator']['name'] ?? 'Tim Dewan Pakar') ?></span>
                        <a href="<?= base_url('riset/' . $cl['slug']) ?>" class="font-bold text-maritime-600 hover:text-navy-950 flex items-center gap-1">
                            <span><?= lang('App.cluster_explore') ?></span> <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Roadmap Riset 2025-2030 -->
        <?php if (!empty($roadmap)): ?>
        <div class="bg-white rounded-2xl p-8 sm:p-10 border border-slate-200 shadow-sm space-y-8">
            <div>
                <span class="text-gold-600 uppercase text-xs font-bold tracking-wider block"><?= $isEn ? 'Strategic Roadmap' : 'Rencana Jangka Panjang' ?></span>
                <h3 class="text-xl sm:text-2xl font-bold text-navy-950 mt-1"><?= $isEn ? 'Maritime Research Roadmap' : 'Roadmap Riset Kemaritiman' ?></h3>
            </div>

            <div class="space-y-6 relative before:absolute before:inset-0 before:left-3.5 before:w-0.5 before:bg-slate-200">
                <?php foreach ($roadmap as $step): ?>
                <div class="relative flex items-start gap-5 pl-10">
                    <div class="absolute left-1.5 top-1.5 w-4 h-4 rounded-full bg-navy-900 border-4 border-gold-400 shadow"></div>
                    <div class="bg-slate-50 rounded-xl p-5 border border-slate-200/80 w-full space-y-2">
                        <div class="flex flex-wrap items-center justify-between gap-2">
                            <span class="px-2.5 py-1 rounded bg-navy-900 text-gold-400 text-xs font-bold"><?= esc($step['phase']) ?></span>
                            <span class="text-[11px] font-semibold text-maritime-700"><?= esc($step['status']) ?></span>
                        </div>
                        <h4 class="text-sm sm:text-base font-bold text-navy-950"><?= esc($step['title']) ?></h4>
                        <p class="text-xs text-slate-600 leading-relaxed"><?= esc($step['desc']) ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

    </div>
</div>

<?= $this->endSection() ?>
