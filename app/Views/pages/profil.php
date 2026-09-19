<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<?php $isEn = (service('request')->getLocale() === 'en'); ?>

<!-- Page Header Banner -->
<div class="bg-navy-950 text-white py-14 relative overflow-hidden border-b-2 border-gold-500">
    <div class="absolute inset-0 opacity-10 bg-pattern"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <nav class="flex items-center space-x-2 text-xs text-gold-400 mb-2 font-medium">
                    <a href="<?= base_url() ?>" class="hover:underline"><?= lang('App.nav_home') ?></a>
                    <span>/</span>
                    <span class="text-slate-300"><?= lang('App.nav_about') ?></span>
                </nav>
                <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight text-white"><?= lang('App.profile_title') ?></h1>
                <p class="text-slate-300 text-xs sm:text-sm mt-1 max-w-2xl">
                    <?= lang('App.profile_subtitle') ?>
                </p>
            </div>
            <div class="hidden md:flex items-center gap-3 bg-navy-900/90 border border-slate-700 px-4 py-3 rounded-xl">
                <i class="fa-solid fa-anchor text-gold-400 text-2xl"></i>
                <div class="text-xs text-slate-300">
                    <span class="font-bold text-white block"><?= lang('App.profile_motto') ?></span>
                    <span>Tanjungpinang, Kepulauan Riau</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Profil Main Content Tabs / Sections -->
<div class="py-16 bg-slate-50" x-data="{
    activeTab: 'visi-misi',
    init() {
        this.syncHash();
        window.addEventListener('hashchange', () => this.syncHash());
    },
    syncHash() {
        const hash = window.location.hash.replace('#', '');
        if (hash === 'visi-misi' || hash === 'sejarah') {
            this.activeTab = hash;
            this.$nextTick(() => {
                const el = document.getElementById(hash);
                if (el) el.scrollIntoView({ behavior: 'smooth' });
            });
        } else if (hash === 'struktur' || hash === 'personalia') {
            this.activeTab = 'struktur';
            this.$nextTick(() => {
                const el = document.getElementById('struktur');
                if (el) el.scrollIntoView({ behavior: 'smooth' });
            });
        }
    },
    setTab(tab) {
        this.activeTab = tab;
        if (window.location.hash !== '#' + tab) {
            history.pushState(null, '', '#' + tab);
        }
    }
}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Tab Navigation Buttons -->
        <div class="flex flex-wrap items-center gap-2 border-b border-slate-200 pb-4 mb-10 text-xs sm:text-sm font-semibold">
            <button @click="setTab('visi-misi')" 
                    class="px-4 py-2.5 rounded-lg transition-all flex items-center gap-2 active:scale-[0.98]"
                    :class="activeTab === 'visi-misi' ? 'bg-navy-900 text-gold-400 shadow-sm' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200'">
                <i class="fa-solid fa-bullseye"></i> <?= lang('App.profile_tab_vision') ?>
            </button>
            <button @click="setTab('sejarah')" 
                    class="px-4 py-2.5 rounded-lg transition-all flex items-center gap-2 active:scale-[0.98]"
                    :class="activeTab === 'sejarah' ? 'bg-navy-900 text-gold-400 shadow-sm' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200'">
                <i class="fa-solid fa-clock-rotate-left"></i> <?= lang('App.profile_tab_history') ?>
            </button>
            <button @click="setTab('struktur')" 
                    class="px-4 py-2.5 rounded-lg transition-all flex items-center gap-2 active:scale-[0.98]"
                    :class="activeTab === 'struktur' ? 'bg-navy-900 text-gold-400 shadow-sm' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200'">
                <i class="fa-solid fa-sitemap"></i> <?= lang('App.profile_tab_structure') ?>
            </button>
        </div>

        <!-- TAB 1: VISI & MISI -->
        <div id="visi-misi" x-show="activeTab === 'visi-misi'" x-cloak class="space-y-10 scroll-mt-28">
            
            <!-- Visi Banner -->
            <div class="bg-gradient-to-br from-navy-900 via-navy-800 to-maritime-800 text-white rounded-2xl p-8 sm:p-10 shadow-lg relative overflow-hidden">
                <div class="max-w-3xl relative z-10 space-y-4">
                    <span class="text-gold-400 uppercase text-xs font-bold tracking-widest"><?= lang('App.vision_title') ?></span>
                    <h2 class="text-xl sm:text-3xl font-bold leading-relaxed">
                        <?= lang('App.vision_text') ?>
                    </h2>
                </div>
                <div class="absolute right-4 -bottom-8 text-white/5 text-9xl pointer-events-none">
                    <i class="fa-solid fa-compass"></i>
                </div>
            </div>

            <!-- Campus Waterfront Architectural Showcase -->
            <div class="relative rounded-2xl overflow-hidden shadow-xl border border-slate-200 group">
                <div class="aspect-[21/9] w-full overflow-hidden bg-navy-950">
                    <img src="<?= base_url('images/kampus_umrah_dompak.jpg') ?>" 
                         alt="Gedung Rektorat & Laboratorium Riset Maritim UMRAH Dompak" 
                         class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700">
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-navy-950 via-navy-950/40 to-transparent flex items-end p-6 sm:p-8">
                    <div class="text-white space-y-1">
                        <span class="text-gold-400 text-xs font-bold uppercase tracking-wider block"><?= $isEn ? 'Primary Maritime Campus Facility' : 'Fasilitas Kampus Utama Maritim' ?></span>
                        <h3 class="text-lg sm:text-2xl font-extrabold"><?= $isEn ? 'UMRAH Dompak Coastal & Oceanographic Research Complex' : 'Kompleks Riset Pesisir & Oseanografi UMRAH Dompak' ?></h3>
                        <p class="text-xs sm:text-sm text-slate-300 max-w-2xl"><?= $isEn ? 'Directly facing Dompak Island waters, the coordination center for Malacca Strait and North Natuna Sea border research.' : 'Menghadap langsung ke perairan Pulau Dompak, pusat koordinasi penelitian perbatasan Selat Malaka & Laut Natuna Utara.' ?></p>
                    </div>
                </div>
            </div>

            <!-- Misi Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-xs hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-maritime-50 text-maritime-600 flex items-center justify-center text-xl mb-4">
                        <i class="fa-solid fa-water"></i>
                    </div>
                    <h3 class="text-base sm:text-lg font-bold text-navy-950 mb-2"><?= $isEn ? '1. Oceanic Science Exploration' : '1. Eksplorasi Sains Bahari' ?></h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        <?= $isEn ? 'Conducting applied oceanographic surveys, tropical marine hydrodynamic modeling, and blue carbon ecosystem mapping (mangroves and seagrass beds) across the Riau Islands.' : 'Melakukan survei oseanografi terapan, pemodelan hidrodinamika laut tropis, dan pemetaan ekosistem blue carbon (mangrove dan padang lamun) di Kepulauan Riau.' ?>
                    </p>
                </div>
                <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-xs hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-gold-50 text-gold-600 flex items-center justify-center text-xl mb-4">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <h3 class="text-base sm:text-lg font-bold text-navy-950 mb-2"><?= $isEn ? '2. Outermost Regions Advocacy' : '2. Advokasi Wilayah Terluar' ?></h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        <?= $isEn ? 'Producing strategic policy briefs and international law of the sea studies (UNCLOS 1982) to reinforce Indonesian sovereignty in the North Natuna Sea Exclusive Economic Zone (EEZ).' : 'Menghasilkan policy brief dan kajian hukum laut internasional (UNCLOS 1982) untuk memperkuat kedaulatan NKRI di kawasan Zona Ekonomi Eksklusif (ZEE) Natuna Utara.' ?>
                    </p>
                </div>
                <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-xs hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl mb-4">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <h3 class="text-base sm:text-lg font-bold text-navy-950 mb-2"><?= $isEn ? '3. Coastal Empowerment' : '3. Pemberdayaan Pesisir' ?></h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        <?= $isEn ? 'Empowering traditional fishermen communities through appropriate marine technology innovations, seafood product diversification, and socio-economic resilience in border islands.' : 'Mendukung masyarakat nelayan tradisional melalui inovasi teknologi tepat guna, diversifikasi produk olahan laut, dan ketahanan sosial-ekonomi pulau kecil terluar.' ?>
                    </p>
                </div>
            </div>

            <!-- Nilai-Nilai Budaya Bahari -->
            <div class="bg-white rounded-2xl p-8 sm:p-10 border border-slate-200 shadow-xs space-y-6">
                <div>
                    <span class="text-maritime-600 uppercase text-xs font-bold tracking-wider block"><?= $isEn ? 'Working Principles' : 'Prinsip Kerja' ?></span>
                    <h3 class="text-xl sm:text-2xl font-bold text-navy-950 mt-1"><?= $isEn ? 'Pillars of Researcher Integrity' : 'Pilar Integritas Peneliti Pusat Studi' ?></h3>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="flex items-start gap-4 p-4 rounded-xl bg-slate-50 border border-slate-100">
                        <div class="w-8 h-8 rounded-lg bg-navy-900 text-gold-400 flex items-center justify-center font-bold text-sm shrink-0">1</div>
                        <div>
                            <h4 class="font-bold text-sm text-navy-900 mb-1"><?= $isEn ? 'Empirical Field Data-Driven Research' : 'Riset Berbasis Data Empiris Lapangan' ?></h4>
                            <p class="text-xs text-slate-600 leading-relaxed"><?= $isEn ? 'All scientific publications are supported by in-situ measurements using research vessels and real-time ocean meteorological stations.' : 'Seluruh publikasi ditunjang pengukuran in-situ menggunakan armada riset maritim dan stasiun sensor cuaca laut real-time.' ?></p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 p-4 rounded-xl bg-slate-50 border border-slate-100">
                        <div class="w-8 h-8 rounded-lg bg-navy-900 text-gold-400 flex items-center justify-center font-bold text-sm shrink-0">2</div>
                        <div>
                            <h4 class="font-bold text-sm text-navy-900 mb-1"><?= $isEn ? 'Interdisciplinary & Solution-Oriented' : 'Interdisipliner & Solutif' ?></h4>
                            <p class="text-xs text-slate-600 leading-relaxed"><?= $isEn ? 'Integrating border jurisprudence, hydrodynamics, and marine engineering for comprehensive national maritime policies.' : 'Memadukan hukum perbatasan, dinamika perairan, dan teknologi kelautan demi kebijakan maritim yang komprehensif.' ?></p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 p-4 rounded-xl bg-slate-50 border border-slate-100">
                        <div class="w-8 h-8 rounded-lg bg-navy-900 text-gold-400 flex items-center justify-center font-bold text-sm shrink-0">3</div>
                        <div>
                            <h4 class="font-bold text-sm text-navy-900 mb-1"><?= $isEn ? 'Malay Maritime Wisdom' : 'Kearifan Maritim Melayu' ?></h4>
                            <p class="text-xs text-slate-600 leading-relaxed"><?= $isEn ? 'Honoring indigenous coastal fishermen wisdom as a sustainable, environmentally friendly ancestral seafaring heritage.' : 'Menghargai kearifan lokal nelayan pesisir sebagai warisan budaya bahari leluhur yang berkelanjutan dan ramah lingkungan.' ?></p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 p-4 rounded-xl bg-slate-50 border border-slate-100">
                        <div class="w-8 h-8 rounded-lg bg-navy-900 text-gold-400 flex items-center justify-center font-bold text-sm shrink-0">4</div>
                        <div>
                            <h4 class="font-bold text-sm text-navy-900 mb-1"><?= $isEn ? 'Global Collaborative Alliances' : 'Jejaring Kolaborasi Internasional' ?></h4>
                            <p class="text-xs text-slate-600 leading-relaxed"><?= $isEn ? 'Establishing strategic alliances with international maritime institutions, BRIN, and global agencies in the Malacca Strait & Natuna Sea.' : 'Membangun aliansi riset strategis dengan universitas maritim dunia, BRIN, dan badan-badan kelautan internasional di Selat Malaka dan Laut Natuna.' ?></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- TAB 2: SEJARAH & MANDAT -->
        <div id="sejarah" x-show="activeTab === 'sejarah'" x-cloak class="bg-white rounded-2xl p-8 sm:p-10 border border-slate-200 shadow-sm space-y-6 text-slate-700 leading-relaxed text-xs sm:text-sm scroll-mt-28">
            <div class="border-b border-slate-100 pb-4">
                <span class="text-gold-600 uppercase text-xs font-bold tracking-wider block"><?= $isEn ? 'Historical Background' : 'Latar Belakang Historis' ?></span>
                <h3 class="text-xl sm:text-2xl font-bold text-navy-950 mt-1"><?= $isEn ? 'Maritime Mandate in the Heart of Malacca Strait Civilization' : 'Mandat Kemaritiman di Jantung Peradaban Selat Malaka' ?></h3>
            </div>
            <p>
                <?= $isEn ? 'Universitas Maritim Raja Ali Haji (UMRAH) was established under a special mandate from the Government of Indonesia to become an epicenter of higher education and research defined by its maritime identity. The Riau Islands province, consisting of 96% open sea and over 2,408 islands, serves as an invaluable living laboratory for national marine sciences.' : 'Universitas Maritim Raja Ali Haji (UMRAH) didirikan dengan mandat khusus dari Pemerintah Republik Indonesia untuk menjadi episentrum pendidikan tinggi dan riset berkarakter kemaritiman. Kepulauan Riau yang terdiri atas 96% lautan dan memiliki lebih dari 2.408 pulau menjadi laboratorium hidup yang tidak ternilai bagi sains kebaharian nasional.' ?>
            </p>
            <p>
                <?= $isEn ? 'Geostrategically, Riau Islands places UMRAH at the front lines of Indonesian maritime sovereignty: directly bordering the waters of the <strong>Malacca Strait</strong> as the world busiest logistical chokepoint, and extending outward to the <strong>North Natuna Sea</strong> which intersects the geopolitical epicenter of the <strong>South China Sea</strong>.' : 'Secara geostrategis, posisi Kepulauan Riau menempatkan UMRAH di garis terdepan kedaulatan maritim Indonesia: berbatasan langsung dengan perairan <strong>Selat Malaka</strong> sebagai urat nadi logistik tersibuk di dunia, serta membentang hingga ke <strong>Laut Natuna Utara</strong> yang bersinggungan langsung dengan episentrum dinamika geopolitik <strong>Laut Cina Selatan</strong>.' ?>
            </p>
            <p>
                <?= $isEn ? 'To integrate multidisciplinary fields (physical oceanography, border bathymetry, marine biotechnology, remote island logistics, and international law of the sea UNCLOS 1982), the <strong>North Natuna Sea Research Center (NNSRC)</strong> was formally established under the LPPM UMRAH as a scientific think-tank and policy hub for outermost border waters.' : 'Guna mengintegrasikan seluruh keilmuan multidisiplin (oseanografi fisik, batimetri perbatasan, bioteknologi perairan, logistik pulau terpencil, hingga hukum laut internasional UNCLOS 1982), dibentuklah <strong>Pusat Studi Laut Natuna Utara (North Natuna Sea Research Center - NNSRC)</strong> di bawah naungan LPPM UMRAH sebagai *think-tank* sains dan kebijakan perbatasan terluar Indonesia.' ?>
            </p>
            <div class="p-4 rounded-xl bg-slate-50 border-l-4 border-maritime-600 space-y-2">
                <h5 class="font-bold text-navy-950 text-xs sm:text-sm"><?= $isEn ? 'Inspiration from Raja Ali Haji (National Hero):' : 'Inspirasi Raja Ali Haji (Pahlawan Nasional):' ?></h5>
                <p class="italic text-xs text-slate-600">
                    <?= $isEn ? '"If you wish to know knowledgeable people, inquire and read at all times." The spirit of literacy and marine wisdom of Riau Islands guides every researcher in exploring our oceans.' : '"Jika hendak mengenal orang berilmu, bertanyalah dan membaca sepanjang waktu." Semangat literasi dan kearifan bahari Kepulauan Riau menjadi ruh bagi setiap peneliti kami dalam mengeksplorasi samudera.' ?>
                </p>
            </div>
        </div>

        <!-- TAB 3: STRUKTUR ORGANISASI & PERSONALIA -->
        <div id="struktur" x-show="activeTab === 'struktur'" x-cloak class="space-y-8 scroll-mt-28">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <span class="text-maritime-600 uppercase text-xs font-bold tracking-wider block"><?= lang('App.nav_structure') ?></span>
                    <h3 class="text-xl sm:text-2xl font-bold text-navy-950 mt-1"><?= lang('App.structure_title') ?></h3>
                    <p class="text-slate-600 text-xs sm:text-sm mt-1"><?= $isEn ? 'Executive leadership and research fellow directory of North Natuna Sea Research Center (NNSRC) UMRAH.' : 'Susunan pimpinan dan dewan pengurus Pusat Studi Laut Natuna Utara (North Natuna Sea Research Center) UMRAH.' ?></p>
                </div>
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-maritime-50 border border-maritime-200 text-maritime-800 text-xs font-semibold">
                    <i class="fa-solid fa-check-double text-maritime-600"></i> <?= lang('App.structure_verified') ?>
                </div>
            </div>

            <!-- Bagan Organisasi Hierarki (Organogram) -->
            <div class="bg-gradient-to-br from-navy-950 via-navy-900 to-slate-900 rounded-2xl p-6 sm:p-8 text-white border border-slate-800 shadow-lg relative overflow-hidden">
                <div class="text-center mb-6">
                    <span class="text-gold-400 uppercase text-[11px] font-bold tracking-widest"><?= lang('App.structure_organogram') ?></span>
                    <h4 class="text-base sm:text-lg font-bold text-white mt-1"><?= lang('App.dept_name') ?> UMRAH</h4>
                </div>

                <!-- Hierarchy Level 1: Koordinator & Sekretaris Pusat Studi -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 max-w-2xl mx-auto">
                    <div class="bg-navy-800/90 border-2 border-gold-500 rounded-xl px-5 py-3.5 text-center shadow-lg">
                        <span class="text-gold-400 text-[10px] font-bold uppercase tracking-wider block"><?= lang('App.structure_pimpinan_utama') ?></span>
                        <h5 class="font-bold text-white text-sm sm:text-base mt-0.5">Dr. Atika Thahira, S.H., M.H.</h5>
                        <p class="text-xs text-gold-300 font-semibold mt-0.5"><?= $isEn ? 'Center Coordinator' : 'Koordinator Pusat Studi / Center Coordinator' ?></p>
                    </div>
                    <div class="bg-navy-800/90 border-2 border-cyan-400/80 rounded-xl px-5 py-3.5 text-center shadow-lg">
                        <span class="text-cyan-400 text-[10px] font-bold uppercase tracking-wider block"><?= lang('App.structure_sekretaris') ?></span>
                        <h5 class="font-bold text-white text-sm sm:text-base mt-0.5">Euis Ammelia, S.IP., M.I.P.</h5>
                        <p class="text-xs text-cyan-300 font-semibold mt-0.5">Secretary of Research Center</p>
                    </div>
                </div>

                <!-- Connector Line Vertical -->
                <div class="flex justify-center my-3">
                    <div class="w-0.5 h-6 bg-gold-500/60"></div>
                </div>

                <!-- Connector Line Horizontal & Branches -->
                <div class="relative max-w-3xl mx-auto">
                    <div class="hidden md:block absolute top-0 left-1/4 right-1/4 h-0.5 bg-slate-700"></div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6 pt-2">
                        <!-- Branch 1: Research Department -->
                        <div class="bg-navy-800/80 border border-slate-700/80 rounded-xl p-4 shadow text-center relative">
                            <span class="text-cyan-400 text-[10px] font-bold uppercase tracking-wider block"><?= lang('App.structure_dept_riset') ?></span>
                            <div class="mt-2 space-y-2">
                                <div class="bg-navy-900/90 rounded-lg p-2.5 border border-cyan-500/30">
                                    <div class="text-xs font-bold text-white">Dr. Ady Muzwardi, S.IP., M.A., M.H.I.</div>
                                    <div class="text-[11px] text-cyan-300 font-semibold">Head of Research Department</div>
                                </div>
                                <div class="bg-navy-900/90 rounded-lg p-2.5 border border-slate-700">
                                    <div class="text-xs font-bold text-white">Rachma Indriyani, S.H., LL.M., Ph.D.</div>
                                    <div class="text-[11px] text-slate-300 font-semibold">Vice of Research Department</div>
                                </div>
                            </div>
                        </div>

                        <!-- Branch 2: Community Service Department -->
                        <div class="bg-navy-800/80 border border-slate-700/80 rounded-xl p-4 shadow text-center">
                            <span class="text-emerald-400 text-[10px] font-bold uppercase tracking-wider block"><?= lang('App.structure_dept_pengabdian') ?></span>
                            <div class="mt-2 space-y-2">
                                <div class="bg-navy-900/90 rounded-lg p-2.5 border border-emerald-500/30">
                                    <div class="text-xs font-bold text-white">Dedy Afrizal, S.Sos., M.Si., Ph.D.</div>
                                    <div class="text-[11px] text-emerald-300 font-semibold">Head of Community Service Department</div>
                                </div>
                                <div class="bg-navy-900/50 rounded-lg p-2.5 border border-dashed border-slate-700/50 flex items-center justify-center">
                                    <span class="text-[11px] text-slate-400 italic"><?= $isEn ? 'Coastal Community Empowerment & Outermost Island Outreach' : 'Pemberdayaan & Pengabdian Wilayah Pesisir Natuna' ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Organogram Extension: 10 Anggota Dewan Peneliti -->
                    <div class="mt-4 bg-navy-800/60 border border-slate-700/60 rounded-xl p-3.5 text-center">
                        <div class="flex items-center justify-center gap-2 text-gold-400 text-[11px] font-bold uppercase tracking-wider">
                            <i class="fa-solid fa-graduation-cap"></i>
                            <span><?= lang('App.structure_dewan_pakar') ?></span>
                        </div>
                        <p class="text-[11px] text-slate-300 mt-1 max-w-xl mx-auto">
                            <?= $isEn ? 'Inter-faculty faculty fellows from FIKP, FISIP, FTTK, and Faculty of Law at Raja Ali Haji Maritime University (UMRAH).' : 'Afiliasi pakar dari FIKP, FISIP, FTTK, dan Fakultas Hukum Universitas Maritim Raja Ali Haji (UMRAH).' ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Pimpinan & Pengurus Inti Section Header -->
            <div class="flex items-center justify-between pt-2">
                <h4 class="text-base sm:text-lg font-bold text-navy-950 flex items-center gap-2">
                    <i class="fa-solid fa-user-tie text-gold-500"></i> <?= lang('App.structure_executives') ?>
                </h4>
                <span class="text-xs text-slate-500 font-medium"><?= $isEn ? '5 Department Heads' : '5 Pimpinan Departemen' ?></span>
            </div>

            <!-- Personalia Detail Cards Grid (5 Pimpinan) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-5" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(210px, 1fr)); gap: 1.25rem;">
                <?php foreach ($researchers as $p): ?>
                <div class="bg-white rounded-2xl p-4 sm:p-5 border border-slate-200 shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col justify-between space-y-4 group relative overflow-hidden">
                    <div class="space-y-3.5">
                        <div class="relative w-full rounded-xl overflow-hidden ring-1 ring-slate-200 group-hover:ring-maritime-500/40 transition-all duration-300 shadow-sm bg-slate-100" style="aspect-ratio: 1 / 1; width: 100%;">
                            <img src="<?= esc($p['image']) ?>" alt="<?= esc($p['name']) ?>" class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500" style="width: 100%; height: 100%; object-fit: cover; object-position: top; aspect-ratio: 1 / 1; display: block;">
                            <div class="absolute bottom-2 right-2 px-2 py-0.5 rounded-md bg-navy-900/85 backdrop-blur-xs text-gold-400 flex items-center gap-1 text-[10px] font-bold shadow-md border border-navy-700/60">
                                <i class="fa-solid fa-certificate text-[9px]"></i> <?= $isEn ? 'Key Officer' : 'Dewan Pakar' ?>
                            </div>
                        </div>

                        <div class="text-center space-y-1">
                            <h4 class="font-bold text-sm text-navy-950 group-hover:text-maritime-600 transition-colors leading-snug">
                                <?= esc($p['name']) ?>
                            </h4>
                            <span class="inline-block px-2 py-0.5 rounded-full bg-maritime-50 text-maritime-700 text-[10px] font-bold border border-maritime-100 leading-tight">
                                <?= esc($p['role']) ?>
                            </span>
                        </div>

                        <div class="text-[11px] text-slate-600 pt-2.5 border-t border-slate-100 space-y-1.5">
                            <p class="leading-relaxed"><strong class="text-slate-800"><?= $isEn ? 'Focus:' : 'Fokus:' ?></strong> <?= esc($p['focus']) ?></p>
                            <div class="pt-1">
                                <div class="text-maritime-700 font-mono font-semibold bg-slate-50 px-1.5 py-0.5 rounded border border-slate-200 inline-block text-[10px]"><?= esc($p['scopus']) ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-2.5 border-t border-slate-100 text-center">
                        <a href="mailto:<?= esc($p['email']) ?>" class="inline-flex items-center justify-center gap-1.5 text-[11px] font-semibold text-slate-600 hover:text-maritime-600 transition-colors w-full py-1.5 rounded-lg hover:bg-slate-50 truncate">
                            <i class="fa-solid fa-envelope text-gold-500"></i> <?= esc($p['email']) ?>
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Section: 10 Anggota Dewan Peneliti (Research Fellows) -->
            <div class="pt-10 border-t border-slate-200 space-y-6">
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-3">
                    <div>
                        <span class="text-maritime-600 uppercase text-xs font-bold tracking-wider block"><?= $isEn ? 'Multidisciplinary Expert Board' : 'Dewan Pakar Multidisiplin' ?></span>
                        <h4 class="text-xl sm:text-2xl font-bold text-navy-950 mt-0.5"><?= lang('App.structure_researchers') ?></h4>
                        <p class="text-slate-600 text-xs sm:text-sm mt-0.5"><?= lang('App.structure_researchers_desc') ?></p>
                    </div>
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-navy-900 text-gold-400 text-xs font-bold border border-navy-800 shadow-xs self-start md:self-auto">
                        <i class="fa-solid fa-users-viewfinder"></i> <?= $isEn ? '10 Inter-Faculty Researchers' : '10 Peneliti Lintas Fakultas' ?>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4">
                    <?php if (!empty($research_members)): ?>
                    <?php foreach ($research_members as $m): ?>
                    <div class="bg-white rounded-2xl p-4 border border-slate-200 shadow-xs hover:shadow-lg transition-all duration-300 flex flex-col justify-between space-y-3 group hover:-translate-y-1">
                        <div class="space-y-3">
                            <!-- Avatar / Badge Header -->
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white font-extrabold text-sm shadow-sm flex-shrink-0 group-hover:scale-105 transition-transform" style="background: <?= esc($m['bg_gradient']) ?>;">
                                    <?= esc($m['initials']) ?>
                                </div>
                                <div class="overflow-hidden space-y-0.5">
                                    <span class="inline-block px-1.5 py-0.5 rounded text-[9px] font-bold bg-slate-100 text-slate-700 border border-slate-200 truncate max-w-full">
                                        <?= esc($m['faculty']) ?>
                                    </span>
                                    <span class="block text-[10px] text-maritime-600 font-semibold truncate">
                                        <?= esc($m['cluster']) ?>
                                    </span>
                                </div>
                            </div>

                            <!-- Name & Role -->
                            <div>
                                <h5 class="font-bold text-xs text-navy-950 group-hover:text-maritime-600 transition-colors leading-snug">
                                    <?= esc($m['name']) ?>
                                </h5>
                                <p class="text-[10px] text-slate-500 font-medium mt-0.5">
                                    <?= esc($m['role']) ?>
                                </p>
                            </div>

                            <!-- Focus -->
                            <div class="pt-2 border-t border-slate-100">
                                <p class="text-[11px] text-slate-600 leading-relaxed line-clamp-3">
                                    <strong class="text-slate-800 font-semibold"><?= $isEn ? 'Focus:' : 'Fokus:' ?></strong> <?= esc($m['focus']) ?>
                                </p>
                            </div>
                        </div>

                        <!-- Email Contact -->
                        <div class="pt-2.5 border-t border-slate-100">
                            <a href="mailto:<?= esc($m['email']) ?>" class="inline-flex items-center justify-center gap-1.5 text-[10px] font-semibold text-slate-600 hover:text-maritime-600 transition-colors w-full py-1 rounded-md hover:bg-slate-50 truncate">
                                <i class="fa-solid fa-envelope text-gold-500 text-[10px]"></i> <?= esc($m['email']) ?>
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Section: Peneliti Eksternal & Mitra Riset (External Research Fellows) -->
            <div class="pt-10 border-t border-slate-200 space-y-6">
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-3">
                    <div>
                        <span class="text-maritime-600 uppercase text-xs font-bold tracking-wider block"><?= $isEn ? 'National & International Research Partners' : 'Mitra Riset Nasional & Internasional' ?></span>
                        <h4 class="text-xl sm:text-2xl font-bold text-navy-950 mt-0.5"><?= lang('App.structure_external_researchers') ?></h4>
                        <p class="text-slate-600 text-xs sm:text-sm mt-0.5"><?= lang('App.structure_external_researchers_desc') ?></p>
                    </div>
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-slate-100 text-navy-900 text-xs font-bold border border-slate-200 shadow-xs self-start md:self-auto">
                        <i class="fa-solid fa-earth-asia text-maritime-600"></i> <?= $isEn ? 'External Research Fellows' : 'Peneliti Mitra Eksternal' ?>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                    <?php if (!empty($external_researchers)): ?>
                    <?php foreach ($external_researchers as $em): ?>
                    <div class="bg-white rounded-2xl p-4 border border-slate-200 shadow-xs hover:shadow-lg transition-all duration-300 flex flex-col justify-between space-y-3 group hover:-translate-y-1">
                        <div class="space-y-3">
                            <!-- Avatar / Badge Header -->
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white font-extrabold text-sm shadow-sm flex-shrink-0 group-hover:scale-105 transition-transform" style="background: <?= esc($em['bg_gradient']) ?>;">
                                    <?= esc($em['initials']) ?>
                                </div>
                                <div class="overflow-hidden space-y-0.5">
                                    <span class="inline-block px-1.5 py-0.5 rounded text-[9px] font-bold bg-amber-50 text-amber-800 border border-amber-200 truncate max-w-full">
                                        <?= esc($em['faculty']) ?>
                                    </span>
                                    <span class="block text-[10px] text-maritime-600 font-semibold truncate">
                                        <?= esc($em['cluster']) ?>
                                    </span>
                                </div>
                            </div>

                            <!-- Name & Role -->
                            <div>
                                <h5 class="font-bold text-xs text-navy-950 group-hover:text-maritime-600 transition-colors leading-snug">
                                    <?= esc($em['name']) ?>
                                </h5>
                                <p class="text-[10px] text-slate-500 font-medium mt-0.5">
                                    <?= esc($em['role']) ?>
                                </p>
                            </div>

                            <!-- Focus -->
                            <div class="pt-2 border-t border-slate-100">
                                <p class="text-[11px] text-slate-600 leading-relaxed line-clamp-3">
                                    <strong class="text-slate-800 font-semibold"><?= $isEn ? 'Focus:' : 'Fokus:' ?></strong> <?= esc($em['focus']) ?>
                                </p>
                            </div>
                        </div>

                        <!-- Email Contact -->
                        <div class="pt-2.5 border-t border-slate-100">
                            <a href="mailto:<?= esc($em['email']) ?>" class="inline-flex items-center justify-center gap-1.5 text-[10px] font-semibold text-slate-600 hover:text-maritime-600 transition-colors w-full py-1 rounded-md hover:bg-slate-50 truncate">
                                <i class="fa-solid fa-envelope text-gold-500 text-[10px]"></i> <?= esc($em['email']) ?>
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection() ?>
