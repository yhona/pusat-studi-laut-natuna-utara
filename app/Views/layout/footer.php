<footer class="bg-navy-950 text-slate-300 pt-16 pb-8 border-t-4 border-gold-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 pb-12 border-b border-navy-800">
            
            <!-- Col 1: Identity & Address -->
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-xl bg-white/10 p-1 flex items-center justify-center flex-shrink-0 backdrop-blur-sm border border-white/10 shadow-sm">
                        <img src="<?= base_url('images/logo_umrah.png') ?>" alt="Logo Resmi UMRAH" class="w-10 h-10 object-contain drop-shadow">
                    </div>
                    <div>
                        <h4 class="text-white font-bold text-base tracking-tight uppercase"><?= lang('App.dept_name') ?></h4>
                        <p class="text-xs text-slate-400"><?= lang('App.inst_name') ?></p>
                    </div>
                </div>
                <p class="text-xs text-slate-400 leading-relaxed">
                    <?= lang('App.footer_tagline') ?>
                </p>
                <div class="space-y-2 text-xs text-slate-300 pt-2">
                    <div class="flex items-start gap-2.5">
                        <i class="fa-solid fa-location-dot text-gold-400 mt-1 flex-shrink-0"></i>
                        <span><?= lang('App.footer_address') ?></span>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <i class="fa-solid fa-envelope text-gold-400 flex-shrink-0"></i>
                        <a href="mailto:pusatstudilautnatunautara@umrah.ac.id" class="hover:text-gold-400 transition-colors">pusatstudilautnatunautara@umrah.ac.id</a>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <i class="fa-solid fa-phone text-gold-400 flex-shrink-0"></i>
                        <span>(0771) 4500089 / 4500090</span>
                    </div>
                </div>
            </div>

            <!-- Col 2: Quick Links -->
            <div>
                <h4 class="text-white font-semibold text-sm uppercase tracking-wider mb-4 pb-2 border-b border-navy-800 flex items-center gap-2">
                    <i class="fa-solid fa-link text-maritime-500 text-xs"></i> <?= lang('App.footer_quicklinks') ?>
                </h4>
                <ul class="space-y-2.5 text-xs text-slate-400">
                    <li><a href="https://umrah.ac.id" target="_blank" rel="noopener noreferrer" class="hover:text-gold-400 transition-colors flex items-center gap-1.5"><i class="fa-solid fa-chevron-right text-[9px] text-slate-600"></i> Universitas Maritim Raja Ali Haji</a></li>
                    <li><a href="https://lppm.umrah.ac.id" target="_blank" rel="noopener noreferrer" class="hover:text-gold-400 transition-colors flex items-center gap-1.5"><i class="fa-solid fa-chevron-right text-[9px] text-slate-600"></i> LPPM UMRAH</a></li>
                    <li><a href="https://bima.kemdikbud.go.id" target="_blank" rel="noopener noreferrer" class="hover:text-gold-400 transition-colors flex items-center gap-1.5"><i class="fa-solid fa-chevron-right text-[9px] text-slate-600"></i> SIMLITABMAS UMRAH</a></li>
                    <li><a href="<?= base_url('unduhan') ?>" class="hover:text-gold-400 transition-colors flex items-center gap-1.5"><i class="fa-solid fa-chevron-right text-[9px] text-slate-600"></i> <?= lang('App.nav_downloads') ?></a></li>
                    <li><a href="https://bima.kemdikbud.go.id" target="_blank" rel="noopener noreferrer" class="hover:text-gold-400 transition-colors flex items-center gap-1.5"><i class="fa-solid fa-chevron-right text-[9px] text-slate-600"></i> BIMA Kemdikbudristek</a></li>
                    <li><a href="https://brin.go.id" target="_blank" rel="noopener noreferrer" class="hover:text-gold-400 transition-colors flex items-center gap-1.5"><i class="fa-solid fa-chevron-right text-[9px] text-slate-600"></i> Badan Riset & Inovasi Nasional (BRIN)</a></li>
                </ul>
            </div>

            <!-- Col 3: Research Clusters -->
            <div>
                <h4 class="text-white font-semibold text-sm uppercase tracking-wider mb-4 pb-2 border-b border-navy-800 flex items-center gap-2">
                    <i class="fa-solid fa-compass text-maritime-500 text-xs"></i> <?= lang('App.footer_clusters') ?>
                </h4>
                <ul class="space-y-2.5 text-xs text-slate-400">
                    <li><a href="<?= base_url('riset/hukum-laut') ?>" class="hover:text-gold-400 transition-colors flex items-center gap-1.5"><i class="fa-solid fa-scale-balanced text-[9px] text-maritime-500"></i> <?= lang('App.cluster_1_title') ?></a></li>
                    <li><a href="<?= base_url('riset/logistik') ?>" class="hover:text-gold-400 transition-colors flex items-center gap-1.5"><i class="fa-solid fa-ship text-[9px] text-maritime-500"></i> <?= lang('App.cluster_2_title') ?></a></li>
                    <li><a href="<?= base_url('riset/ketahanan-digital') ?>" class="hover:text-gold-400 transition-colors flex items-center gap-1.5"><i class="fa-solid fa-network-wired text-[9px] text-maritime-500"></i> <?= lang('App.cluster_3_title') ?></a></li>
                    <li><a href="<?= base_url('riset/energi') ?>" class="hover:text-gold-400 transition-colors flex items-center gap-1.5"><i class="fa-solid fa-bolt text-[9px] text-maritime-500"></i> <?= lang('App.cluster_4_title') ?></a></li>
                    <li><a href="<?= base_url('layanan') ?>" class="hover:text-gold-400 transition-colors flex items-center gap-1.5"><i class="fa-solid fa-chart-line text-[9px] text-maritime-500"></i> <?= lang('App.footer_survey_service') ?></a></li>
                </ul>
            </div>

            <!-- Col 4: Operational & Socials -->
            <div>
                <h4 class="text-white font-semibold text-sm uppercase tracking-wider mb-4 pb-2 border-b border-navy-800 flex items-center gap-2">
                    <i class="fa-solid fa-clock text-maritime-500 text-xs"></i> <?= lang('App.footer_hours') ?>
                </h4>
                <div class="text-xs text-slate-400 space-y-2">
                    <p class="flex justify-between">
                        <span><?= lang('App.footer_mon_thu') ?></span>
                        <span class="text-slate-200 font-medium">08.00 – 16.00 WIB</span>
                    </p>
                    <p class="flex justify-between">
                        <span><?= lang('App.footer_fri') ?></span>
                        <span class="text-slate-200 font-medium">08.00 – 16.30 WIB</span>
                    </p>
                    <p class="flex justify-between">
                        <span><?= lang('App.footer_sat_sun') ?></span>
                        <span class="text-rose-400 font-medium"><?= lang('App.footer_closed') ?></span>
                    </p>
                </div>

                <div class="mt-6 pt-4 border-t border-navy-800">
                    <span class="block text-xs font-semibold text-white mb-2.5"><?= lang('App.footer_social') ?></span>
                    <div class="flex items-center gap-2">
                        <a href="https://youtube.com/@umrah" target="_blank" rel="noopener noreferrer" aria-label="YouTube UMRAH" class="w-8 h-8 rounded bg-navy-900 border border-navy-700 flex items-center justify-center text-slate-400 hover:text-gold-400 hover:border-gold-500 transition-colors"><i class="fa-brands fa-youtube"></i></a>
                        <a href="https://instagram.com/umrah.ac.id" target="_blank" rel="noopener noreferrer" aria-label="Instagram UMRAH" class="w-8 h-8 rounded bg-navy-900 border border-navy-700 flex items-center justify-center text-slate-400 hover:text-gold-400 hover:border-gold-500 transition-colors"><i class="fa-brands fa-instagram"></i></a>
                        <a href="https://x.com/umrah_official" target="_blank" rel="noopener noreferrer" aria-label="X Twitter UMRAH" class="w-8 h-8 rounded bg-navy-900 border border-navy-700 flex items-center justify-center text-slate-400 hover:text-gold-400 hover:border-gold-500 transition-colors"><i class="fa-brands fa-x-twitter"></i></a>
                        <a href="https://linkedin.com/school/umrah" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn UMRAH" class="w-8 h-8 rounded bg-navy-900 border border-navy-700 flex items-center justify-center text-slate-400 hover:text-gold-400 hover:border-gold-500 transition-colors"><i class="fa-brands fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>

        </div>

        <!-- Bottom Copyright & Disclaimer -->
        <div class="pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-slate-500">
            <p>© <?= date('Y') ?> <?= lang('App.dept_name') ?> - <?= lang('App.inst_name') ?>. <?= lang('App.footer_rights') ?></p>
            <div class="flex items-center gap-4">
                <a href="<?= base_url('kontak') ?>" class="hover:text-slate-300 transition-colors"><?= lang('App.btn_contact_us') ?></a>
                <span>•</span>
                <a href="<?= base_url('kontak') ?>" class="hover:text-slate-300 transition-colors"><?= lang('App.footer_privacy') ?></a>
                <span>•</span>
                <a href="<?= base_url('kontak') ?>" class="hover:text-slate-300 transition-colors"><?= lang('App.footer_a11y') ?></a>
                <span>•</span>
                <a href="<?= base_url('admin/login') ?>" class="text-slate-600 hover:text-gold-400 transition-colors flex items-center gap-1" title="Login Admin Portal">
                    <i class="fa-solid fa-lock text-[10px]"></i> <span>Admin</span>
                </a>
            </div>
        </div>
    </div>
</footer>
