<!DOCTYPE html>
<html lang="<?= esc(service('request')->getLocale()) ?>" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        $locale = service('request')->getLocale();
        $isEn = ($locale === 'en');
        $siteTitle = $isEn ? 'NNSRC UMRAH' : (lang('App.dept_name') . ' UMRAH');
        $rawTitle = trim($title ?? ($isEn ? 'Home' : 'Beranda'));
        $fullTitle = (str_ends_with($rawTitle, 'UMRAH') || str_ends_with($rawTitle, 'NNSRC') || str_ends_with($rawTitle, lang('App.dept_name')))
            ? $rawTitle 
            : ($rawTitle . ' - ' . $siteTitle);

        $defaultMetaDesc = $isEn 
            ? 'North Natuna Sea Research Center (NNSRC) Universitas Maritim Raja Ali Haji - Premier scientific think-tank for maritime studies, UNCLOS 1982 border governance, and archipelagic oceanography.'
            : (lang('App.dept_name') . ' ' . lang('App.inst_name') . ' - Lembaga riset, kajian strategis, dan inovasi ilmu pengetahuan kelautan dan peradaban maritim di Laut Natuna Utara dan Kepulauan Riau.');

        $metaDescription = !empty($meta_desc) ? trim(strip_tags((string)$meta_desc)) : $defaultMetaDesc;
        $ogDescription = !empty($og_desc) ? trim(strip_tags((string)$og_desc)) : $metaDescription;

        $defaultOgImage = base_url('images/hero_ship.jpg');
        $resolvedOgImage = $defaultOgImage;
        if (!empty($og_image)) {
            $resolvedOgImage = (str_starts_with($og_image, 'http://') || str_starts_with($og_image, 'https://'))
                ? $og_image
                : base_url(ltrim($og_image, '/'));
        }
        $resolvedOgType = !empty($og_type) ? $og_type : 'website';
        $resolvedUrl = !empty($canonical_url) ? $canonical_url : current_url();
    ?>
    <title><?= esc($fullTitle) ?></title>
    <meta name="description" content="<?= esc($metaDescription) ?>">
    <link rel="canonical" href="<?= esc($resolvedUrl) ?>">

    <!-- Open Graph / Social Sharing (Facebook, LinkedIn, WhatsApp, Telegram) -->
    <meta property="og:type" content="<?= esc($resolvedOgType) ?>">
    <meta property="og:url" content="<?= esc($resolvedUrl) ?>">
    <meta property="og:title" content="<?= esc($fullTitle) ?>">
    <meta property="og:description" content="<?= esc($ogDescription) ?>">
    <meta property="og:image" content="<?= esc($resolvedOgImage) ?>">
    <meta property="og:site_name" content="NNSRC UMRAH">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="<?= esc($resolvedUrl) ?>">
    <meta name="twitter:title" content="<?= esc($fullTitle) ?>">
    <meta name="twitter:description" content="<?= esc($ogDescription) ?>">
    <meta name="twitter:image" content="<?= esc($resolvedOgImage) ?>">

    <!-- Favicon Logo Resmi UMRAH -->
    <link rel="shortcut icon" type="image/png" href="<?= base_url('images/logo_umrah.png') ?>">
    <link rel="apple-touch-icon" href="<?= base_url('images/logo_umrah.png') ?>">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Static Compiled Tailwind CSS (Local & Blazing Fast, No CDN Dependency) -->
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">

    <!-- Alpine.js for lightweight UI state management -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.5/dist/cdn.min.js"></script>
</head>
<body class="font-sans bg-sand text-slate-800 antialiased flex flex-col min-h-screen">

    <!-- Topbar & Navbar -->
    <?= $this->include('layout/navbar') ?>

    <!-- Main Content -->
    <main class="flex-grow">
        <?= $this->renderSection('content') ?>
    </main>

    <!-- Footer -->
    <?= $this->include('layout/footer') ?>

    <!-- Back to Top Button -->
    <div x-data="{ showTop: false }" @scroll.window="showTop = (window.pageYOffset > 300)">
        <button x-show="showTop" x-cloak @click="window.scrollTo({top: 0, behavior: 'smooth'})"
            class="fixed bottom-6 right-6 z-40 bg-maritime-600 hover:bg-maritime-700 text-white p-3 rounded-full shadow-lg transition-all duration-300 transform hover:scale-110 focus:outline-none cursor-pointer"
            aria-label="<?= $isEn ? 'Back to top' : 'Kembali ke atas' ?>">
            <i class="fa-solid fa-arrow-up text-lg"></i>
        </button>
    </div>

    <?= $this->renderSection('scripts') ?>
</body>
</html>
