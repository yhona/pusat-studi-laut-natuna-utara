<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<!-- Page Header Banner -->
<div class="bg-navy-950 text-white py-14 relative overflow-hidden border-b-2 border-gold-500">
    <div class="absolute inset-0 opacity-10 bg-pattern"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <nav class="flex items-center space-x-2 text-xs text-gold-400 mb-2 font-medium">
            <a href="<?= base_url() ?>" class="hover:underline">Beranda</a>
            <span>/</span>
            <span class="text-slate-300">Layanan & Jasa</span>
        </nav>
        <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight text-white">Layanan & Jasa Konsultasi Kemaritiman</h1>
        <p class="text-slate-300 text-xs sm:text-sm mt-1 max-w-2xl">
            Menyediakan jasa survei hidro-oseanografi, uji laboratorium parameter kelautan, kajian kebijakan ruang laut, serta pelatihan profesional.
        </p>
    </div>
</div>

<!-- Main Services Section -->
<div class="py-16 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        
        <!-- Intro Note (PSE UGM style) -->
        <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
            <div class="space-y-1 max-w-3xl">
                <span class="text-[11px] uppercase font-bold text-maritime-600 tracking-wider">Kemitraan Industri & Pemerintah</span>
                <h3 class="text-lg sm:text-xl font-bold text-navy-950">Didukung Laboratorium Oseanografi & Tenaga Ahli Tersertifikasi</h3>
                <p class="text-xs sm:text-sm text-slate-600">
                    Seluruh kegiatan survei dan pengujian dilaksanakan sesuai standar hidrografi nasional dan internasional guna menjamin akurasi dan validitas data.
                </p>
            </div>
            <a href="<?= base_url('kontak#kerjasama') ?>" class="inline-flex items-center gap-2 bg-maritime-600 hover:bg-maritime-700 text-white text-xs font-semibold px-5 py-3 rounded-lg shadow transition-colors flex-shrink-0">
                <i class="fa-solid fa-file-signature text-gold-400"></i> Formulir Permohonan Jasa
            </a>
        </div>

        <!-- Services Section with Technical Spec Modal -->
        <div x-data="serviceSpecModal()" @keydown.escape.window="if (isOpen) closeSpec()">
            
            <!-- Services Cards List -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
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
                                <i class="fa-solid fa-toolbox text-maritime-600 mr-1"></i> Instrumen & Fasilitas:
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
                                <i class="fa-solid fa-file-circle-check text-gold-600 mr-1"></i> Output / Luaran:
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
                            <i class="fa-solid fa-list-check text-gold-500"></i> Lihat Spesifikasi Teknis
                        </button>
                        <a href="<?= base_url('kontak?layanan=' . $service['id']) ?>" class="inline-flex items-center gap-1.5 text-xs font-bold text-maritime-600 hover:text-navy-950 transition-colors">
                            Hubungi Tim <i class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
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
                 :aria-label="activeService ? activeService.title : 'Spesifikasi Teknis Layanan'"
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
                                    <span class="text-slate-300">Standar Teknis Resmi</span>
                                </div>
                                <h3 class="text-base sm:text-xl font-bold text-white leading-snug" x-text="activeService?.title"></h3>
                                <p class="text-xs text-slate-300 leading-relaxed" x-text="activeService?.spec?.standards"></p>
                            </div>

                            <button @click="closeSpec()"
                                    class="w-8 h-8 rounded-lg bg-navy-900 hover:bg-navy-800 text-slate-400 hover:text-white flex items-center justify-center transition-colors border border-navy-800 flex-shrink-0 active:scale-[0.98]"
                                    aria-label="Tutup Dialog">
                                <i class="fa-solid fa-xmark text-sm"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Modal Content (Parameters & Deliverables) -->
                    <div class="p-6 space-y-6 max-h-[70vh] overflow-y-auto text-slate-700 text-xs sm:text-sm">
                        
                        <!-- Parameter Teknis & Akurasi Instrumen -->
                        <div class="space-y-3">
                            <div class="flex items-center gap-2 text-navy-950 font-bold text-xs uppercase tracking-wider">
                                <i class="fa-solid fa-microchip text-maritime-600"></i>
                                <span>Parameter Teknis & Akurasi Instrumentasi</span>
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

                        <!-- Format Data Deliverables -->
                        <div class="space-y-3 pt-2 border-t border-slate-100">
                            <div class="flex items-center gap-2 text-navy-950 font-bold text-xs uppercase tracking-wider">
                                <i class="fa-solid fa-file-circle-check text-gold-600"></i>
                                <span>Format Berkas & Luaran Deliverables</span>
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

                        <!-- Unduh SOP & Panduan Terkait -->
                        <div class="p-4 rounded-xl bg-gradient-to-r from-navy-950 to-navy-900 text-white flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <div class="space-y-1">
                                <span class="text-[10px] uppercase font-bold text-gold-400 tracking-wider block">Standar Operasional Prosedur</span>
                                <p class="text-xs text-slate-300 leading-relaxed" x-text="activeService?.spec?.sopName"></p>
                            </div>
                            <a :href="'<?= base_url('unduhan/unduh/') ?>/' + activeService?.spec?.sopSlug"
                               class="inline-flex items-center gap-2 bg-maritime-600 hover:bg-maritime-500 text-white text-xs font-semibold px-4 py-2.5 rounded-lg shadow transition-all flex-shrink-0 active:scale-[0.98]">
                                <i class="fa-solid fa-download text-gold-400"></i> Unduh SOP Resmi (PDF)
                            </a>
                        </div>

                    </div>

                    <!-- Modal Footer -->
                    <div class="px-6 py-4 bg-slate-50 border-t border-slate-200 flex items-center justify-between">
                        <span class="text-[11px] text-slate-500">Pusat Studi Laut Natuna Utara (NNSRC UMRAH) • ISO 17025 Compliant</span>
                        <button type="button" @click="closeSpec()" class="px-4 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-200 rounded-lg transition-colors">
                            Tutup
                        </button>
                    </div>

                </div>
            </div>

        </div>

        <!-- Section 2: Hydro-Oceanography Survey Simulator / Calculator (Alpine.js Interactive) -->
        <section id="kalkulator" class="scroll-mt-28 bg-gradient-to-br from-navy-950 via-navy-900 to-maritime-950 text-white rounded-3xl p-6 sm:p-10 shadow-2xl border border-navy-800 relative overflow-hidden" x-data="surveyCalculator()">
            <div class="absolute inset-0 opacity-10 bg-pattern pointer-events-none"></div>

            <div class="relative z-10 space-y-8">
                <!-- Calculator Header -->
                <div class="max-w-3xl space-y-2">
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-gold-500/20 border border-gold-500/40 text-gold-400 text-xs font-semibold uppercase tracking-wider">
                        <i class="fa-solid fa-calculator text-[11px]"></i> Simulasi & Estimasi Kebutuhan Riset
                    </span>
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
                        Kalkulator & Simulator Survei Hidro-Oseanografi
                    </h3>
                    <p class="text-slate-300 text-xs sm:text-sm leading-relaxed">
                        Perkirakan secara instan durasi operasional lapangan, kebutuhan hari pengolahan data batimetri, armada kapal survei, serta konfigurasi sensor saintifik kelautan berbasis karakteristik perairan Kepri.
                    </p>
                </div>

                <!-- Calculator Form & Reactive Results Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    
                    <!-- Left: Input Controls (Col 5) -->
                    <div class="lg:col-span-5 bg-navy-900/90 border border-navy-700/80 rounded-2xl p-6 space-y-6 shadow-inner">
                        
                        <!-- Input 1: Water Body Type -->
                        <div class="space-y-2">
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-300">
                                1. Tipe Karakteristik Perairan:
                            </label>
                            <div class="space-y-2">
                                <label class="flex items-center gap-3 p-3 rounded-xl border cursor-pointer transition-all"
                                       :class="waterType === 'shallow' ? 'bg-navy-800 border-gold-500 text-white shadow-sm' : 'bg-navy-950/60 border-navy-700 text-slate-400 hover:border-slate-500'">
                                    <input type="radio" name="waterType" value="shallow" x-model="waterType" class="text-gold-500 focus:ring-gold-500">
                                    <div class="text-xs">
                                        <span class="font-bold block text-white">Perairan Dangkal / Estuari</span>
                                        <span class="text-[11px] text-slate-400">Kedalaman 0 – 20 m, muara pesisir & alur dangkal</span>
                                    </div>
                                </label>
                                <label class="flex items-center gap-3 p-3 rounded-xl border cursor-pointer transition-all"
                                       :class="waterType === 'strait' ? 'bg-navy-800 border-gold-500 text-white shadow-sm' : 'bg-navy-950/60 border-navy-700 text-slate-400 hover:border-slate-500'">
                                    <input type="radio" name="waterType" value="strait" x-model="waterType" class="text-gold-500 focus:ring-gold-500">
                                    <div class="text-xs">
                                        <span class="font-bold block text-white">Selat & Pesisir Antar-Pulau</span>
                                        <span class="text-[11px] text-slate-400">Kedalaman 20 – 70 m, arus kuat Selat Malaka/Riau</span>
                                    </div>
                                </label>
                                <label class="flex items-center gap-3 p-3 rounded-xl border cursor-pointer transition-all"
                                       :class="waterType === 'offshore' ? 'bg-navy-800 border-gold-500 text-white shadow-sm' : 'bg-navy-950/60 border-navy-700 text-slate-400 hover:border-slate-500'">
                                    <input type="radio" name="waterType" value="offshore" x-model="waterType" class="text-gold-500 focus:ring-gold-500">
                                    <div class="text-xs">
                                        <span class="font-bold block text-white">Lepas Pantai / ZEE Natuna</span>
                                        <span class="text-[11px] text-slate-400">Kedalaman > 70 m, laut terbuka perbatasan</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Input 2: Survey Area (Nm²) -->
                        <div class="space-y-3 pt-4 border-t border-navy-800">
                            <div class="flex items-center justify-between">
                                <label class="text-xs font-bold uppercase tracking-wider text-slate-300">
                                    2. Luas Area Survei:
                                </label>
                                <div class="flex items-baseline gap-1">
                                    <span class="text-xl font-extrabold text-gold-400 font-mono" x-text="surveyArea"></span>
                                    <span class="text-xs text-slate-400 font-semibold">Nm²</span>
                                </div>
                            </div>
                            <input type="range" min="1" max="100" step="1" x-model.number="surveyArea"
                                   class="w-full accent-gold-500 bg-navy-950 h-2 rounded-lg cursor-pointer">
                            <div class="flex justify-between text-[10px] text-slate-400 font-mono">
                                <span>1 Nm²</span>
                                <span>25 Nm²</span>
                                <span>50 Nm²</span>
                                <span>75 Nm²</span>
                                <span>100 Nm²</span>
                            </div>
                        </div>

                        <!-- Input 3: IHO S-44 Survey Order -->
                        <div class="space-y-2 pt-4 border-t border-navy-800">
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-300">
                                3. Standar Akurasi IHO S-44:
                            </label>
                            <div class="grid grid-cols-3 gap-2 text-center text-xs">
                                <button type="button" @click="surveyOrder = 'special'"
                                        class="p-2.5 rounded-xl border transition-all"
                                        :class="surveyOrder === 'special' ? 'bg-gold-500 text-navy-950 font-bold border-gold-400 shadow' : 'bg-navy-950/60 border-navy-700 text-slate-300 hover:border-slate-500'">
                                    <span class="block text-xs font-bold">Special Order</span>
                                    <span class="text-[10px] opacity-80">Alur Pelabuhan</span>
                                </button>
                                <button type="button" @click="surveyOrder = 'order1a'"
                                        class="p-2.5 rounded-xl border transition-all"
                                        :class="surveyOrder === 'order1a' ? 'bg-gold-500 text-navy-950 font-bold border-gold-400 shadow' : 'bg-navy-950/60 border-navy-700 text-slate-300 hover:border-slate-500'">
                                    <span class="block text-xs font-bold">Order 1a</span>
                                    <span class="text-[10px] opacity-80">Kedalaman &lt;100m</span>
                                </button>
                                <button type="button" @click="surveyOrder = 'order1b'"
                                        class="p-2.5 rounded-xl border transition-all"
                                        :class="surveyOrder === 'order1b' ? 'bg-gold-500 text-navy-950 font-bold border-gold-400 shadow' : 'bg-navy-950/60 border-navy-700 text-slate-300 hover:border-slate-500'">
                                    <span class="block text-xs font-bold">Order 1b</span>
                                    <span class="text-[10px] opacity-80">Studi Umum</span>
                                </button>
                            </div>
                        </div>

                        <!-- Input 4: Lab Testing Checkboxes -->
                        <div class="space-y-2 pt-4 border-t border-navy-800">
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-300">
                                4. Paket Pengujian Oseanografi & Lab:
                            </label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs">
                                <label class="flex items-center gap-2 p-2.5 rounded-lg bg-navy-950/50 border border-navy-700 cursor-pointer hover:border-slate-500">
                                    <input type="checkbox" x-model="tests.ctd" class="rounded text-gold-500 focus:ring-gold-500 bg-navy-800">
                                    <span>Salinitas & Suhu (CTD)</span>
                                </label>
                                <label class="flex items-center gap-2 p-2.5 rounded-lg bg-navy-950/50 border border-navy-700 cursor-pointer hover:border-slate-500">
                                    <input type="checkbox" x-model="tests.turbidity" class="rounded text-gold-500 focus:ring-gold-500 bg-navy-800">
                                    <span>Turbiditas & TSS</span>
                                </label>
                                <label class="flex items-center gap-2 p-2.5 rounded-lg bg-navy-950/50 border border-navy-700 cursor-pointer hover:border-slate-500">
                                    <input type="checkbox" x-model="tests.sediment" class="rounded text-gold-500 focus:ring-gold-500 bg-navy-800">
                                    <span>Sedimen Granulometri</span>
                                </label>
                                <label class="flex items-center gap-2 p-2.5 rounded-lg bg-navy-950/50 border border-navy-700 cursor-pointer hover:border-slate-500">
                                    <input type="checkbox" x-model="tests.metals" class="rounded text-gold-500 focus:ring-gold-500 bg-navy-800">
                                    <span>Logam Berat & Nutrien</span>
                                </label>
                            </div>
                        </div>

                    </div>

                    <!-- Right: Reactive Engine Feedback (Col 7) -->
                    <div class="lg:col-span-7 space-y-6">
                        
                        <!-- Reactive Metric Cards -->
                        <div class="grid grid-cols-3 gap-3">
                            <div class="p-4 rounded-2xl bg-navy-900/90 border border-navy-700 text-center space-y-1">
                                <span class="text-[10px] uppercase font-bold text-slate-400 block tracking-wider">Survei Lapangan</span>
                                <div class="text-2xl sm:text-3xl font-extrabold text-gold-400 font-mono" x-text="estimatedFieldDays"></div>
                                <span class="text-[11px] text-slate-300">Hari Kerja Laut</span>
                            </div>
                            <div class="p-4 rounded-2xl bg-navy-900/90 border border-navy-700 text-center space-y-1">
                                <span class="text-[10px] uppercase font-bold text-slate-400 block tracking-wider">Olah Data & Model</span>
                                <div class="text-2xl sm:text-3xl font-extrabold text-maritime-400 font-mono" x-text="estimatedProcessingDays"></div>
                                <span class="text-[11px] text-slate-300">Hari Analisis GIS</span>
                            </div>
                            <div class="p-4 rounded-2xl bg-gradient-to-br from-navy-800 to-maritime-800 border border-maritime-600/50 text-center space-y-1 shadow-lg">
                                <span class="text-[10px] uppercase font-bold text-gold-400 block tracking-wider">Total Durasi</span>
                                <div class="text-2xl sm:text-3xl font-extrabold text-white font-mono" x-text="totalDays"></div>
                                <span class="text-[11px] text-slate-200">Hari Estimasi</span>
                            </div>
                        </div>

                        <!-- Recommended Vessel Card -->
                        <div class="p-5 rounded-2xl bg-navy-900/90 border border-navy-700 space-y-2">
                            <div class="flex items-center gap-2 text-xs font-bold text-gold-400 uppercase tracking-wider">
                                <i class="fa-solid fa-ship text-sm"></i>
                                <span>Rekomendasi Wahana & Armada Kapal Survei:</span>
                            </div>
                            <p class="text-sm font-semibold text-white leading-relaxed" x-text="recommendedVessel"></p>
                            <p class="text-[11px] text-slate-400">Diverifikasi sesuai batas kedalaman laut, stabilitas gelombang Selat Malaka/Natuna, dan durasi sounding harian.</p>
                        </div>

                        <!-- Recommended Multidisciplinary Expert Team -->
                        <div class="p-5 rounded-2xl bg-navy-900/90 border border-navy-700 space-y-3">
                            <div class="flex items-center gap-2 text-xs font-bold text-maritime-400 uppercase tracking-wider">
                                <i class="fa-solid fa-users-gear text-sm"></i>
                                <span>Komposisi Tim Ahli Ditugaskan (Pakar UMRAH):</span>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                <template x-for="(member, mIdx) in recommendedTeam" :key="mIdx">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-navy-950 border border-navy-700 text-slate-200 text-xs font-medium">
                                        <i class="fa-solid fa-user-check text-emerald-400 text-[10px]"></i>
                                        <span x-text="member"></span>
                                    </span>
                                </template>
                            </div>
                        </div>

                        <!-- Tailored Instruments & Equipment List -->
                        <div class="p-5 rounded-2xl bg-navy-900/90 border border-navy-700 space-y-3">
                            <div class="flex items-center gap-2 text-xs font-bold text-emerald-400 uppercase tracking-wider">
                                <i class="fa-solid fa-toolbox text-sm"></i>
                                <span>Rangkaian Instrumen & Sensor Terpilih:</span>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs">
                                <template x-for="(inst, iIdx) in recommendedInstruments" :key="iIdx">
                                    <div class="flex items-start gap-2 p-2 rounded-lg bg-navy-950/70 border border-navy-800 text-slate-300">
                                        <i class="fa-solid fa-check text-gold-400 text-xs mt-0.5 flex-shrink-0"></i>
                                        <span class="text-[11px] leading-snug" x-text="inst"></span>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- Action CTA Button -->
                        <div class="pt-2">
                            <a :href="consultationUrl"
                               class="w-full inline-flex items-center justify-center gap-2.5 bg-gradient-to-r from-gold-500 to-gold-600 hover:from-gold-400 hover:to-gold-500 text-navy-950 font-bold text-xs sm:text-sm px-6 py-4 rounded-xl shadow-xl shadow-gold-500/20 transition-all transform active:scale-[0.98]">
                                <i class="fa-solid fa-file-contract text-base"></i>
                                <span>Unduh Estimasi Spesifikasi / Konsultasi Kerjasama</span>
                                <i class="fa-solid fa-arrow-right text-xs"></i>
                            </a>
                        </div>

                    </div>

                </div>
            </div>
        </section>

        <!-- Alur Prosedur Permohonan Layanan -->
        <div class="bg-white rounded-2xl p-8 border border-slate-200 shadow-sm space-y-6">
            <div class="border-b border-slate-100 pb-4">
                <span class="text-gold-600 text-xs font-bold uppercase tracking-wider block">Standar Operasional Prosedur (SOP)</span>
                <h3 class="text-xl font-bold text-navy-950 mt-1">Alur Permohonan Kerjasama & Layanan Riset</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 text-center">
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/70 space-y-2">
                    <div class="w-9 h-9 mx-auto rounded-full bg-navy-900 text-gold-400 font-bold flex items-center justify-center text-sm">1</div>
                    <h4 class="font-bold text-xs sm:text-sm text-navy-900">Pengajuan Surat</h4>
                    <p class="text-[11px] text-slate-500">Mengirimkan surat permohonan / formulir online kebutuhan survei atau uji lab.</p>
                </div>
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/70 space-y-2">
                    <div class="w-9 h-9 mx-auto rounded-full bg-navy-900 text-gold-400 font-bold flex items-center justify-center text-sm">2</div>
                    <h4 class="font-bold text-xs sm:text-sm text-navy-900">Telaah Teknis & TOR</h4>
                    <p class="text-[11px] text-slate-500">Tim ahli PSK UMRAH menyusun rencana kerja, metodologi, dan estimasi waktu.</p>
                </div>
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/70 space-y-2">
                    <div class="w-9 h-9 mx-auto rounded-full bg-navy-900 text-gold-400 font-bold flex items-center justify-center text-sm">3</div>
                    <h4 class="font-bold text-xs sm:text-sm text-navy-900">Pelaksanaan Kegiatan</h4>
                    <p class="text-[11px] text-slate-500">Survei lapangan perairan atau analisis laboratorium sampel di kampus UMRAH.</p>
                </div>
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/70 space-y-2">
                    <div class="w-9 h-9 mx-auto rounded-full bg-navy-900 text-gold-400 font-bold flex items-center justify-center text-sm">4</div>
                    <h4 class="font-bold text-xs sm:text-sm text-navy-900">Laporan & Sertifikat</h4>
                    <p class="text-[11px] text-slate-500">Penyerahan hasil analisa data, peta geospasial, dan sertifikat resmi pengujian.</p>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
function serviceSpecModal() {
    return {
        isOpen: false,
        activeService: null,
        specs: {
            'batimetri': {
                code: 'SPEC-HIDRO-01',
                standards: 'IHO Standards for Hydrographic Surveys (S-44 Edition 6) Special Order & Order 1a',
                instruments: [
                    { name: 'Multibeam Echosounder (MBES)', param: 'Frekuensi 200 - 400 kHz, 256 beams, swath width up to 140°' },
                    { name: 'Singlebeam Dual-Frequency', param: '24 kHz (penetrasi sub-bottom tipis) & 200 kHz (resolusi kedalaman)' },
                    { name: 'Marine RTK-DGPS GNSS', param: 'Akurasi horizontal < 1 cm + 1 ppm, update rate 20 Hz' },
                    { name: 'Motion Reference Unit (MRU)', param: 'Heave: 5 cm / 5%, Pitch/Roll: 0.02°, Heading: 0.05°' },
                    { name: 'Sound Velocity Profiler (SVP)', param: 'Kecepatan suara rentang 1375 - 1900 m/s, akurasi ±0.05 m/s' },
                    { name: 'Tide Gauge AWLR Telemetri', param: 'Sensor tekanan piezo-resistif & radar, akurasi ±1 mm' }
                ],
                deliverables: [
                    'Peta Batimetri Format Lembar Lukis Teliti (LLT) & Digital CAD/GIS (.dwg / .shp)',
                    'Grid Kedalaman 32-bit Floating Point GeoTIFF & ASCII XYZ Point Cloud',
                    'Model Pola Arus Pasang Surut 2D/3D (Format NetCDF / Delft3D)',
                    'Laporan Teknis Oseanografi Resmi Bersegel LPPM UMRAH'
                ],
                sopName: 'SOP Pelaksanaan Survei Batimetri & Akustik Bawah Laut',
                sopSlug: 'sop-oseanografi'
            },
            'amdal': {
                code: 'SPEC-LAB-02',
                standards: 'PP No. 22 Tahun 2021 Baku Mutu Air Laut & SNI ISO/IEC 17025:2017 Terakreditasi',
                instruments: [
                    { name: 'CTD Oceanographic Profiler', param: 'Conductivity: ±0.0003 S/m, Temp: ±0.001°C, Depth: ±0.1% FS' },
                    { name: 'Spektrofotometer UV-Vis Ganda', param: 'Panjang gelombang 190 - 1100 nm, batas deteksi Cu, Pb, Cd < 0.001 ppm' },
                    { name: 'Turbidimeter Portabel & TSS', param: 'Rentang 0 - 1000 NTU, kalibrasi formazin primer' },
                    { name: 'Van Dorn & Niskin Sampler', param: 'Tabung non-kontaminasi logam berat kapasitas 2.5L & 5L' },
                    { name: 'Multi-parameter DO/pH/ORP', param: 'Akurasi DO: ±0.1 mg/L, pH: ±0.01 unit, salinitas optical' },
                    { name: 'Van Veen Grab Sampler', param: 'Stainless steel 316 kapasitas 5 liter sedimen dasar laut' }
                ],
                deliverables: [
                    'Sertifikat Hasil Pengujian (Certificate of Analysis) Resmi LPPM UMRAH',
                    'Tabel Matriks Perbandingan Baku Mutu Air Laut (PP 22/2021 Lampiran VIII)',
                    'Peta Sebaran Konsentrasi Spasial Parameter Kimia Laut (ArcGIS / QGIS)',
                    'Laporan Kajian Daya Dukung Lingkungan Perairan untuk Dokumen AMDAL'
                ],
                sopName: 'SOP Pengambilan Sampel & Uji Mutu Air Laut Terakreditasi',
                sopSlug: 'sop-mutu-air'
            },
            'zonasi': {
                code: 'SPEC-ZONASI-03',
                standards: 'Permen KP No. 28 Tahun 2021 tentang Penyelenggaraan Penataan Ruang Laut & Standar BIG',
                instruments: [
                    { name: 'Citra Satelit Resolusi Tinggi', param: 'Sentinel-2 (10m) & Landsat-9, koreksi atmosfer sen2cor' },
                    { name: 'UAV Drone Surveillance Pesisir', param: 'Kamera CMOS 20MP, RTK positioning, resolusi ortofoto < 5 cm/pixel' },
                    { name: 'Geodatabase Spasial Kelautan', param: 'Struktur data standar Satu Data Indonesia (BIG / KKP)' },
                    { name: 'Delft3D Flexible Mesh Model', param: 'Simulasi sirkulasi hidrodinamika & transpor sedimen pantai' }
                ],
                deliverables: [
                    'Peta Rencana Alokasi Ruang Laut Skala 1:25.000 s/d 1:50.000 Format SHP/GeoPackage',
                    'Naskah Akademis Kajian Kebijakan RZWP-3-K Berbasis Bukti Empiris',
                    'Atlas Peta Tematik Konservasi Ekosistem Pesisir & Pulau-Pulau Kecil',
                    'Matriks Rekomendasi Mitigasi Tumpang Tindih Izin Pemanfaatan Ruang Laut'
                ],
                sopName: 'SOP Pengoperasian Drone Nirawak Pemetaan Garis Pantai',
                sopSlug: 'sop-drone-pantai'
            },
            'pelatihan': {
                code: 'SPEC-TRAIN-04',
                standards: 'Kurikulum Berstandar Kompetensi Kerja Nasional Indonesia (SKKNI) Bidang Informasi Geospasial',
                instruments: [
                    { name: 'Laboratorium Komputasi GIS', param: '25 Unit Workstation Intel Core i7, GPU RTX 4060, Dual Monitor' },
                    { name: 'Software Analisis Geospasial', param: 'ArcGIS Pro, QGIS 3.x, SNAP Sentinel Toolbox, Delft3D' },
                    { name: 'Dataset Nyata Kepri', param: 'Data batimetri MBES riil, citra satelit, dan model arus pasut Malaka' },
                    { name: 'Modul Pelatihan Resmi', param: 'Buku panduan teori & praktikum terstruktur 40 jam ajar' }
                ],
                deliverables: [
                    'Sertifikat Kelulusan Resmi LPPM Universitas Maritim Raja Ali Haji ber-QR Code',
                    'Paket Modul Lengkap & Data Latihan Praktikum Mandiri',
                    'Portofolio Hasil Pemetaan Batimetri & Analisis Spasial Kelautan Peserta',
                    'Konsultasi Pasca-Pelatihan Bersama Instruktur dan Pakar Kemaritiman UMRAH'
                ],
                sopName: 'Formulir Permohonan Penggunaan Lab Komputasi GIS & Fasilitas Riset',
                sopSlug: 'form-sewa-lab'
            }
        },
        openSpec(service) {
            this.activeService = {
                ...service,
                spec: this.specs[service.id] || null
            };
            this.isOpen = true;
            document.body.classList.add('overflow-hidden');
        },
        closeSpec() {
            this.isOpen = false;
            document.body.classList.remove('overflow-hidden');
        }
    };
}

function surveyCalculator() {
    return {
        waterType: 'shallow',
        surveyArea: 10,
        surveyOrder: 'order1a',
        tests: {
            ctd: true,
            turbidity: false,
            sediment: false,
            metals: false
        },
        
        get waterTypeName() {
            if (this.waterType === 'shallow') return 'Perairan Dangkal / Estuari (0 - 20 m)';
            if (this.waterType === 'strait') return 'Selat & Pesisir Antar-Pulau (20 - 70 m)';
            return 'Lepas Pantai / ZEE Natuna (> 70 m)';
        },

        get estimatedFieldDays() {
            let rate = (this.waterType === 'shallow') ? 1.4 : (this.waterType === 'strait' ? 2.2 : 3.5);
            let multiplier = (this.surveyOrder === 'special') ? 1.6 : (this.surveyOrder === 'order1a' ? 1.1 : 0.8);
            let days = Math.ceil((this.surveyArea * multiplier) / rate);
            
            let extra = 0;
            if (this.tests.sediment) extra += 1;
            if (this.tests.metals) extra += 1;
            
            return Math.max(days + extra, 3);
        },

        get estimatedProcessingDays() {
            let base = Math.ceil(this.estimatedFieldDays * 0.7);
            let extra = 0;
            if (this.tests.ctd) extra += 1;
            if (this.tests.turbidity) extra += 1;
            if (this.tests.sediment) extra += 2;
            if (this.tests.metals) extra += 3;
            return Math.max(base + extra, 4);
        },

        get totalDays() {
            return this.estimatedFieldDays + this.estimatedProcessingDays;
        },

        get recommendedVessel() {
            if (this.waterType === 'shallow') {
                return 'Kapal Survei Katamaran Kelas III (Draft < 1.2 m, Manuver Estuari)';
            }
            if (this.waterType === 'strait') {
                return 'Kapal Survei Hidrografi Kelas II (Panjang 18 m, Dual Engine & Stabilizer)';
            }
            return 'Kapal Riset Laut Lepas Kelas II/III (Kapasitas Awak 20 Org, Endurance > 14 Hari)';
        },

        get recommendedTeam() {
            let team = [
                'Lead Hydrographic Surveyor (IHO Cat-A Certified)',
                'Oseanografer Fisika & Analisis Arus Pasut',
                'Marine GIS & Data Processing Specialist',
                'Teknisi Elektronika & Instrumentasi Sonar'
            ];
            if (this.tests.sediment || this.tests.metals || this.tests.turbidity) {
                team.push('Ahli Geokimia Laut & Analis Mutu Air (ISO 17025)');
            }
            return team;
        },

        get recommendedInstruments() {
            let list = [];
            if (this.surveyOrder === 'special' || this.waterType === 'strait') {
                list.push('Multibeam Echo Sounder (MBES) High-Resolution Sonar');
                list.push('Inertial Motion Reference Unit (MRU) 5-Axis & Gyrocompass');
            } else if (this.surveyOrder === 'order1a') {
                list.push('High-Frequency Multibeam Echo Sounder / Dual-Beam Hydrographic Sounder');
                list.push('Motion Reference Unit (MRU) & Dual-Antenna GNSS Heading');
            } else {
                list.push('Dual Frequency Singlebeam Hydrographic Echosounder (24/200 kHz)');
            }

            list.push('Dual-Frequency RTK-DGPS Marine GNSS Positioning System');
            list.push('Sound Velocity Profiler (SVP) Sonar Calibration Probe');
            list.push('Automatic Tide Gauge (AWLR) Telemetri Real-time Stasiun Pasut');

            if (this.waterType === 'strait' || this.waterType === 'offshore') {
                list.push('Acoustic Doppler Current Profiler (ADCP) 600 kHz / 300 kHz');
            }

            if (this.tests.ctd) {
                list.push('CTD Oceanographic Multiparameter Probe (Conductivity, Temp, Depth)');
            }
            if (this.tests.turbidity) {
                list.push('Turbidimeter Portabel & Water Sampler Niskin 5 Liter');
            }
            if (this.tests.sediment) {
                list.push('Van Veen Grab Sampler Sedimen Dasar & Shaker Granulometri');
            }
            if (this.tests.metals) {
                list.push('Laboratorium Spektrofotometer UV-Vis & AAS Logam Berat Terakreditasi');
            }

            return list;
        },

        get consultationUrl() {
            let params = new URLSearchParams({
                layanan: 'batimetri',
                perairan: this.waterType,
                luas: this.surveyArea + ' Nm2',
                order: this.surveyOrder,
                durasi: this.estimatedFieldDays + ' hari lapangan + ' + this.estimatedProcessingDays + ' hari olah data'
            });
            return '<?= base_url('kontak#kerjasama') ?>?' + params.toString();
        }
    };
}
</script>

<?= $this->endSection() ?>
