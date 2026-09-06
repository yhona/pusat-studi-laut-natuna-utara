<header class="w-full shadow-md z-30 sticky top-0 bg-white" x-data="{ openMobile: false, openProfil: false, openPublikasi: false }">
    <?php $currentLocale = service('request')->getLocale(); ?>
    <!-- Top Utility Bar (Identitas Sivitas Akademika UMRAH) -->
    <div class="bg-navy-950 text-slate-300 text-xs py-2 px-4 border-b border-navy-800">
        <div class="max-w-7xl mx-auto flex flex-wrap justify-between items-center gap-2">
            <div class="flex items-center space-x-4 divide-x divide-slate-700">
                <a href="https://umrah.ac.id" target="_blank" class="hover:text-gold-400 transition-colors flex items-center gap-1.5">
                    <i class="fa-solid fa-graduation-cap text-gold-500"></i> <?= lang('App.topbar_portal') ?>
                </a>
                <a href="https://lppm.umrah.ac.id" target="_blank" rel="noopener noreferrer" class="pl-4 hover:text-gold-400 transition-colors hidden sm:inline-block">
                    <i class="fa-solid fa-flask-vial text-maritime-500"></i> <?= lang('App.topbar_lppm') ?>
                </a>
                <a href="<?= base_url('unduhan') ?>" class="pl-4 hover:text-gold-400 transition-colors hidden md:inline-block">
                    <i class="fa-solid fa-book-bookmark text-maritime-500"></i> <?= lang('App.topbar_repository') ?>
                </a>
                <a href="https://mail.umrah.ac.id" target="_blank" rel="noopener noreferrer" class="pl-4 hover:text-gold-400 transition-colors hidden lg:inline-block">
                    <i class="fa-solid fa-envelope text-maritime-500"></i> <?= lang('App.topbar_webmail') ?>
                </a>
            </div>
            <div class="flex items-center space-x-3 text-xs">
                <span class="text-slate-400 hidden sm:inline"><i class="fa-regular fa-calendar-check mr-1 text-gold-400"></i> <?= lang('App.topbar_call_for_papers') ?></span>
                <span class="text-slate-600">|</span>
                <div class="flex items-center space-x-1 font-semibold text-xs">
                    <a href="<?= base_url('lang/id') ?>" 
                       class="px-1.5 py-0.5 rounded transition-colors <?= $currentLocale === 'id' ? 'text-gold-400 font-bold bg-navy-900/60' : 'text-slate-400 hover:text-white' ?>" 
                       title="Bahasa Indonesia">ID</a>
                    <span class="text-slate-600">/</span>
                    <a href="<?= base_url('lang/en') ?>" 
                       class="px-1.5 py-0.5 rounded transition-colors <?= $currentLocale === 'en' ? 'text-gold-400 font-bold bg-navy-900/60' : 'text-slate-400 hover:text-white' ?>" 
                       title="English">EN</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Branding Header -->
    <div class="bg-white border-b border-slate-100 py-3.5 px-4">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <!-- Logo & Campus Name -->
            <a href="<?= base_url() ?>" class="flex items-center gap-3.5 group">
                <!-- Official UMRAH Campus Logo -->
                <div class="w-12 h-12 flex-shrink-0 flex items-center justify-center group-hover:scale-105 transition-transform duration-300">
                    <img src="<?= base_url('images/logo_umrah.png') ?>" alt="Logo Resmi Universitas Maritim Raja Ali Haji" class="w-12 h-12 object-contain drop-shadow-sm">
                </div>
                <div>
                    <span class="block text-[11px] font-semibold tracking-wider uppercase text-slate-500"><?= lang('App.inst_name') ?></span>
                    <h1 class="text-lg md:text-xl font-bold tracking-tight text-navy-900 group-hover:text-maritime-600 transition-colors">
                        <?= lang('App.dept_name') ?>
                    </h1>
                    <span class="block text-[11px] text-maritime-600 font-medium"><?= lang('App.dept_sub') ?></span>
                </div>
            </a>

            <!-- Quick Contact / Consultation Badge for Desktop -->
            <div class="hidden lg:flex items-center gap-6 text-slate-600">
                <div class="flex items-center gap-3 border-r border-slate-200 pr-6">
                    <div class="w-10 h-10 rounded-full bg-maritime-50 flex items-center justify-center text-maritime-600">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div class="text-xs">
                        <span class="block font-semibold text-slate-800"><?= lang('App.campus_dompak') ?></span>
                        <span class="text-slate-500"><?= lang('App.campus_loc') ?></span>
                    </div>
                </div>
                <a href="<?= base_url('kontak#kerjasama') ?>" class="inline-flex items-center gap-2 bg-navy-800 hover:bg-navy-900 text-white text-xs font-semibold px-4 py-2.5 rounded-lg shadow-sm hover:shadow transition-all active:scale-[0.98]">
                    <i class="fa-solid fa-handshake text-gold-400"></i> <?= lang('App.btn_partner') ?>
                </a>
            </div>

            <!-- Mobile Hamburger Toggle -->
            <div class="lg:hidden flex items-center">
                <button @click="openMobile = !openMobile" type="button" class="text-slate-700 hover:text-maritime-600 focus:outline-none p-2" aria-label="<?= lang('App.open_menu') ?>">
                    <i class="fa-solid" :class="openMobile ? 'fa-xmark text-2xl' : 'fa-bars text-xl'"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    <nav class="bg-navy-900 text-white hidden lg:block border-t border-navy-800 shadow-inner">
        <div class="max-w-7xl mx-auto px-4">
            <ul class="flex items-center text-[13.5px] font-medium tracking-wide">
                <!-- Home -->
                <li>
                    <a href="<?= base_url() ?>" class="block py-3 px-3.5 hover:bg-navy-800 hover:text-gold-400 transition-colors border-b-2 <?= uri_string() === '' ? 'border-gold-500 text-gold-400 bg-navy-800/80 font-semibold' : 'border-transparent' ?>">
                        <i class="fa-solid fa-house mr-1.5"></i> <?= lang('App.nav_home') ?>
                    </a>
                </li>

                <!-- Profil Dropdown -->
                <li class="relative" @mouseenter="openProfil = true" @mouseleave="openProfil = false">
                    <a href="<?= base_url('profil') ?>" class="flex items-center gap-1 py-3 px-3.5 hover:bg-navy-800 hover:text-gold-400 transition-colors border-b-2 <?= str_starts_with(uri_string(), 'profil') ? 'border-gold-500 text-gold-400 bg-navy-800/80 font-semibold' : 'border-transparent' ?>">
                        <?= lang('App.nav_about') ?> <i class="fa-solid fa-chevron-down text-[10px] opacity-70 transition-transform duration-200" :class="openProfil ? 'rotate-180' : ''"></i>
                    </a>
                    <div x-show="openProfil" x-cloak x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="absolute left-0 mt-0 w-64 bg-white text-slate-800 rounded-b-xl shadow-xl border border-slate-100 py-2 z-50 text-sm">
                        <a href="<?= base_url('#sambutan') ?>" class="group flex items-center px-4 py-2.5 hover:bg-maritime-50 hover:text-maritime-600 transition-colors">
                            <i class="fa-solid fa-user-tie w-5 text-slate-400 mr-1 transition-transform duration-200 group-hover:translate-x-1 group-hover:text-maritime-600"></i> <?= lang('App.nav_welcome') ?>
                        </a>
                        <a href="<?= base_url('profil#visi-misi') ?>" class="group flex items-center px-4 py-2.5 hover:bg-maritime-50 hover:text-maritime-600 transition-colors">
                            <i class="fa-solid fa-bullseye w-5 text-slate-400 mr-1 transition-transform duration-200 group-hover:translate-x-1 group-hover:text-maritime-600"></i> <?= lang('App.nav_vision_mission') ?>
                        </a>
                        <a href="<?= base_url('profil#sejarah') ?>" class="group flex items-center px-4 py-2.5 hover:bg-maritime-50 hover:text-maritime-600 transition-colors">
                            <i class="fa-solid fa-clock-rotate-left w-5 text-slate-400 mr-1 transition-transform duration-200 group-hover:translate-x-1 group-hover:text-maritime-600"></i> <?= lang('App.nav_history') ?>
                        </a>
                        <a href="<?= base_url('profil#struktur') ?>" class="group flex items-center px-4 py-2.5 hover:bg-maritime-50 hover:text-maritime-600 transition-colors border-t border-slate-100">
                            <i class="fa-solid fa-users-gear w-5 text-slate-400 mr-1 transition-transform duration-200 group-hover:translate-x-1 group-hover:text-maritime-600"></i> <?= lang('App.nav_structure') ?>
                        </a>
                    </div>
                </li>

                <!-- Klaster Riset -->
                <li>
                    <a href="<?= base_url('riset') ?>" class="block py-3 px-3.5 hover:bg-navy-800 hover:text-gold-400 transition-colors border-b-2 <?= str_starts_with(uri_string(), 'riset') ? 'border-gold-500 text-gold-400 bg-navy-800/80 font-semibold' : 'border-transparent' ?>">
                        <?= lang('App.nav_research') ?>
                    </a>
                </li>

                <!-- Publikasi Dropdown -->
                <li class="relative" @mouseenter="openPublikasi = true" @mouseleave="openPublikasi = false">
                    <a href="<?= base_url('publikasi') ?>" class="flex items-center gap-1 py-3 px-3.5 hover:bg-navy-800 hover:text-gold-400 transition-colors border-b-2 <?= str_starts_with(uri_string(), 'publikasi') ? 'border-gold-500 text-gold-400 bg-navy-800/80 font-semibold' : 'border-transparent' ?>">
                        <?= lang('App.nav_publication') ?> <i class="fa-solid fa-chevron-down text-[10px] opacity-70 transition-transform duration-200" :class="openPublikasi ? 'rotate-180' : ''"></i>
                    </a>
                    <div x-show="openPublikasi" x-cloak x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="absolute left-0 mt-0 w-60 bg-white text-slate-800 rounded-b-xl shadow-xl border border-slate-100 py-2 z-50 text-sm">
                        <a href="<?= base_url('publikasi#jurnal') ?>" class="group flex items-center px-4 py-2.5 hover:bg-maritime-50 hover:text-maritime-600 transition-colors">
                            <i class="fa-solid fa-book-journal-whills w-5 text-slate-400 mr-1 transition-transform duration-200 group-hover:translate-x-1 group-hover:text-maritime-600"></i> <?= lang('App.nav_journal') ?>
                        </a>
                        <a href="<?= base_url('publikasi#policy-brief') ?>" class="group flex items-center px-4 py-2.5 hover:bg-maritime-50 hover:text-maritime-600 transition-colors">
                            <i class="fa-solid fa-file-shield w-5 text-slate-400 mr-1 transition-transform duration-200 group-hover:translate-x-1 group-hover:text-maritime-600"></i> <?= lang('App.nav_policy_brief') ?>
                        </a>
                        <a href="<?= base_url('publikasi') ?>" class="group flex items-center px-4 py-2.5 hover:bg-maritime-50 hover:text-maritime-600 transition-colors border-t border-slate-100">
                            <i class="fa-solid fa-book w-5 text-slate-400 mr-1 transition-transform duration-200 group-hover:translate-x-1 group-hover:text-maritime-600"></i> <?= lang('App.nav_books') ?>
                        </a>
                    </div>
                </li>

                <!-- Layanan / Laboratorium -->
                <li>
                    <a href="<?= base_url('layanan') ?>" class="block py-3 px-3.5 hover:bg-navy-800 hover:text-gold-400 transition-colors border-b-2 <?= str_starts_with(uri_string(), 'layanan') ? 'border-gold-500 text-gold-400 bg-navy-800/80 font-semibold' : 'border-transparent' ?>">
                        <?= lang('App.nav_services') ?>
                    </a>
                </li>

                <!-- Berita & Agenda -->
                <li>
                    <a href="<?= base_url('berita') ?>" class="block py-3 px-3.5 hover:bg-navy-800 hover:text-gold-400 transition-colors border-b-2 <?= str_starts_with(uri_string(), 'berita') ? 'border-gold-500 text-gold-400 bg-navy-800/80 font-semibold' : 'border-transparent' ?>">
                        <?= lang('App.nav_news') ?>
                    </a>
                </li>

                <!-- Unduhan & Repository -->
                <li>
                    <a href="<?= base_url('unduhan') ?>" class="block py-3 px-3.5 hover:bg-navy-800 hover:text-gold-400 transition-colors border-b-2 <?= str_starts_with(uri_string(), 'unduhan') ? 'border-gold-500 text-gold-400 bg-navy-800/80 font-semibold' : 'border-transparent' ?>">
                        <?= lang('App.nav_downloads') ?>
                    </a>
                </li>

                <!-- Kontak -->
                <li>
                    <a href="<?= base_url('kontak') ?>" class="block py-3 px-3.5 hover:bg-navy-800 hover:text-gold-400 transition-colors border-b-2 <?= str_starts_with(uri_string(), 'kontak') ? 'border-gold-500 text-gold-400 bg-navy-800/80 font-semibold' : 'border-transparent' ?>">
                        <?= lang('App.nav_contact') ?>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Mobile Drawer Menu -->
    <div x-show="openMobile" x-cloak class="lg:hidden bg-white border-b border-slate-200 shadow-xl px-4 py-3">
        <!-- Mobile Language Switcher -->
        <div class="mb-3 pb-2 border-b border-slate-100 flex items-center justify-between">
            <span class="text-xs font-semibold text-slate-500 flex items-center gap-1.5">
                <i class="fa-solid fa-globe text-maritime-600"></i> <?= lang('App.language') ?>
            </span>
            <div class="flex items-center space-x-1.5 text-xs font-semibold">
                <a href="<?= base_url('lang/id') ?>" class="px-2.5 py-1 rounded transition-colors <?= $currentLocale === 'id' ? 'bg-navy-900 text-gold-400 font-bold' : 'text-slate-600 hover:text-navy-900 bg-slate-100' ?>">ID</a>
                <span class="text-slate-300">/</span>
                <a href="<?= base_url('lang/en') ?>" class="px-2.5 py-1 rounded transition-colors <?= $currentLocale === 'en' ? 'bg-navy-900 text-gold-400 font-bold' : 'text-slate-600 hover:text-navy-900 bg-slate-100' ?>">EN</a>
            </div>
        </div>

        <?php $currentUri = uri_string(); ?>
        <ul class="space-y-1 text-sm font-medium text-slate-700 divide-y divide-slate-100">
            <li class="pt-1">
                <a href="<?= base_url() ?>" class="block py-2 px-2.5 rounded-lg transition-colors <?= $currentUri === '' ? 'text-maritime-700 font-bold bg-maritime-50' : 'text-slate-700 hover:text-maritime-600' ?>">
                    <i class="fa-solid fa-house w-6 text-maritime-600"></i> <?= lang('App.nav_home') ?>
                </a>
            </li>
            <li class="pt-1">
                <a href="<?= base_url('profil') ?>" class="block py-2 px-2.5 rounded-lg transition-colors <?= str_starts_with($currentUri, 'profil') ? 'text-maritime-700 font-bold bg-maritime-50' : 'text-slate-700 hover:text-maritime-600' ?>">
                    <i class="fa-solid fa-circle-info w-6 text-maritime-600"></i> <?= lang('App.nav_about') ?>
                </a>
            </li>
            <li class="pt-1">
                <a href="<?= base_url('riset') ?>" class="block py-2 px-2.5 rounded-lg transition-colors <?= str_starts_with($currentUri, 'riset') ? 'text-maritime-700 font-bold bg-maritime-50' : 'text-slate-700 hover:text-maritime-600' ?>">
                    <i class="fa-solid fa-compass w-6 text-maritime-600"></i> <?= lang('App.nav_research') ?>
                </a>
            </li>
            <li class="pt-1">
                <a href="<?= base_url('publikasi') ?>" class="block py-2 px-2.5 rounded-lg transition-colors <?= str_starts_with($currentUri, 'publikasi') ? 'text-maritime-700 font-bold bg-maritime-50' : 'text-slate-700 hover:text-maritime-600' ?>">
                    <i class="fa-solid fa-newspaper w-6 text-maritime-600"></i> <?= lang('App.nav_publication') ?>
                </a>
            </li>
            <li class="pt-1">
                <a href="<?= base_url('layanan') ?>" class="block py-2 px-2.5 rounded-lg transition-colors <?= str_starts_with($currentUri, 'layanan') ? 'text-maritime-700 font-bold bg-maritime-50' : 'text-slate-700 hover:text-maritime-600' ?>">
                    <i class="fa-solid fa-screwdriver-wrench w-6 text-maritime-600"></i> <?= lang('App.nav_services') ?>
                </a>
            </li>
            <li class="pt-1">
                <a href="<?= base_url('berita') ?>" class="block py-2 px-2.5 rounded-lg transition-colors <?= str_starts_with($currentUri, 'berita') ? 'text-maritime-700 font-bold bg-maritime-50' : 'text-slate-700 hover:text-maritime-600' ?>">
                    <i class="fa-solid fa-bullhorn w-6 text-maritime-600"></i> <?= lang('App.nav_news') ?>
                </a>
            </li>
            <li class="pt-1">
                <a href="<?= base_url('unduhan') ?>" class="block py-2 px-2.5 rounded-lg transition-colors <?= str_starts_with($currentUri, 'unduhan') ? 'text-maritime-700 font-bold bg-maritime-50' : 'text-slate-700 hover:text-maritime-600' ?>">
                    <i class="fa-solid fa-download w-6 text-maritime-600"></i> <?= lang('App.nav_downloads') ?>
                </a>
            </li>
            <li class="pt-1">
                <a href="<?= base_url('kontak') ?>" class="block py-2 px-2.5 rounded-lg transition-colors <?= str_starts_with($currentUri, 'kontak') ? 'text-maritime-700 font-bold bg-maritime-50' : 'text-slate-700 hover:text-maritime-600' ?>">
                    <i class="fa-solid fa-address-book w-6 text-maritime-600"></i> <?= lang('App.nav_contact') ?>
                </a>
            </li>
            <li class="pt-3 pb-2">
                <a href="<?= base_url('kontak#kerjasama') ?>" class="w-full flex items-center justify-center gap-2 bg-maritime-600 hover:bg-maritime-700 text-white py-2.5 rounded-lg font-semibold text-xs shadow active:scale-[0.98] transition-all">
                    <i class="fa-solid fa-handshake text-gold-400"></i> <?= lang('App.btn_partner_apply') ?>
                </a>
            </li>
        </ul>
    </div>
</header>
