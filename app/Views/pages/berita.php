<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<!-- Page Header Banner -->
<div class="bg-navy-950 text-white py-14 relative overflow-hidden border-b-2 border-gold-500">
    <div class="absolute inset-0 opacity-10 bg-pattern"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <nav class="flex items-center space-x-2 text-xs text-gold-400 mb-2 font-medium">
            <a href="<?= base_url() ?>" class="hover:underline">Beranda</a>
            <span>/</span>
            <span class="text-slate-300">Berita & Agenda</span>
        </nav>
        <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight text-white">Berita, Agenda & Opini Kemaritiman</h1>
        <p class="text-slate-300 text-xs sm:text-sm mt-1 max-w-2xl">
            Kumpulan berita penelitian, agenda seminar internasional, dan kabar pengabdian masyarakat pesisir UMRAH.
        </p>
    </div>
</div>

<!-- Main Content -->
<div class="py-16 bg-slate-50" x-data="{
    search: '',
    selectedCategory: 'all',
    filterCategory(cat) {
        this.selectedCategory = cat;
    },
    matches(category, title, excerpt, author) {
        const catMatch = (this.selectedCategory === 'all' || this.selectedCategory.toLowerCase() === category.toLowerCase());
        const term = this.search.toLowerCase().trim();
        if (!term) return catMatch;
        const textMatch = title.toLowerCase().includes(term) ||
                          excerpt.toLowerCase().includes(term) ||
                          author.toLowerCase().includes(term);
        return catMatch && textMatch;
    }
}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
        
        <!-- Filter & Search Bar -->
        <div class="bg-white rounded-xl p-4 border border-slate-200 shadow-xs flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex flex-wrap items-center gap-2 text-xs font-semibold">
                <button @click="filterCategory('all')"
                        class="px-3 py-1.5 rounded-lg transition-colors cursor-pointer"
                        :class="selectedCategory === 'all' ? 'bg-navy-900 text-gold-400 font-bold' : 'bg-slate-100 hover:bg-slate-200 text-slate-700'">Semua</button>
                <?php foreach (($categories ?? []) as $cat): ?>
                <button @click="filterCategory('<?= esc($cat) ?>')"
                        class="px-3 py-1.5 rounded-lg transition-colors cursor-pointer"
                        :class="selectedCategory === '<?= esc($cat) ?>' ? 'bg-navy-900 text-gold-400 font-bold' : 'bg-slate-100 hover:bg-slate-200 text-slate-700'">
                    <?= esc($cat) ?>
                </button>
                <?php endforeach; ?>
            </div>
            <div class="relative w-full sm:w-64">
                <input x-model="search" type="text" id="search-berita" name="search-berita" aria-label="Cari berita atau agenda riset" placeholder="Cari berita/agenda..." class="w-full pl-9 pr-4 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-maritime-500">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-slate-400 text-xs"></i>
            </div>
        </div>

        <!-- News Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($articles as $art): ?>
            <article x-show="matches('<?= addslashes(esc($art['category'])) ?>', '<?= addslashes(esc($art['title'])) ?>', '<?= addslashes(esc($art['excerpt'])) ?>', '<?= addslashes(esc($art['author'])) ?>')"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     class="bg-white rounded-xl overflow-hidden shadow-xs hover:shadow-lg border border-slate-200 transition-all duration-300 flex flex-col justify-between group">
                <!-- Header / Thumbnail Area -->
                <div class="h-44 bg-gradient-to-tr from-navy-900 via-navy-800 to-maritime-700 relative flex flex-col justify-between overflow-hidden">
                    <?php if (!empty($art['image'])): ?>
                    <img src="<?= base_url($art['image']) ?>" alt="<?= esc($art['title']) ?>" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-navy-950/90 via-navy-900/40 to-transparent"></div>
                    <?php else: ?>
                    <div class="absolute -right-4 -bottom-4 text-white/5 text-8xl pointer-events-none">
                        <i class="fa-solid fa-ship"></i>
                    </div>
                    <?php endif; ?>
                    <div class="p-4 relative z-10 flex flex-col justify-between h-full">
                        <span class="inline-block self-start px-2.5 py-1 rounded bg-navy-950/80 backdrop-blur-sm text-gold-400 font-bold text-[10px] uppercase tracking-wider border border-gold-400/20">
                            <?= esc($art['category']) ?>
                        </span>
                        <div class="text-white/80 text-[11px] flex items-center gap-2">
                            <i class="fa-regular fa-calendar text-gold-400"></i>
                            <span><?= esc($art['date']) ?></span>
                        </div>
                    </div>
                </div>

                <div class="p-5 flex-grow flex flex-col justify-between space-y-3">
                    <h3 class="text-sm sm:text-base font-bold text-navy-950 group-hover:text-maritime-600 transition-colors leading-snug line-clamp-2">
                        <a href="<?= base_url('berita/' . $art['slug']) ?>">
                            <?= esc($art['title']) ?>
                        </a>
                    </h3>
                    <p class="text-xs text-slate-600 line-clamp-3 leading-relaxed">
                        <?= esc($art['excerpt']) ?>
                    </p>
                    <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                        <span><i class="fa-solid fa-user-pen mr-1 text-slate-400"></i> <?= esc($art['author']) ?></span>
                        <a href="<?= base_url('berita/' . $art['slug']) ?>" class="font-semibold text-maritime-600 hover:text-navy-950">Baca Selengkapnya →</a>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        </div>

    </div>
</div>

<?= $this->endSection() ?>
