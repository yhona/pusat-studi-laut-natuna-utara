<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Login Administrator - Pusat Studi Laut Natuna Utara UMRAH') ?></title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="<?= base_url('images/logo_umrah.png') ?>">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.5/dist/cdn.min.js"></script>

    <style>
        * { box-sizing: border-box; }
        body { 
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            background-color: #04101D;
        }
        .bg-ocean-glow {
            background: 
                radial-gradient(ellipse 80% 50% at 50% -20%, rgba(2, 132, 199, 0.28), transparent 70%),
                radial-gradient(ellipse 60% 40% at 80% 100%, rgba(245, 158, 11, 0.12), transparent 60%),
                #04101D;
        }
        .login-card {
            background: #ffffff;
            box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(255, 255, 255, 0.1);
        }
        .input-glow:focus-within {
            box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.2);
            border-color: #0284C7;
        }
    </style>
</head>
<body class="bg-ocean-glow min-h-screen text-slate-800 antialiased flex flex-col justify-between p-4 sm:p-6 lg:p-8 selection:bg-gold-500 selection:text-navy-950">

    <!-- Top Utility / Back to Portal -->
    <header class="w-full max-w-5xl mx-auto flex items-center justify-between py-2">
        <a href="<?= base_url() ?>" class="flex items-center gap-3 group">
            <img src="<?= base_url('images/logo_umrah.png') ?>" alt="Logo UMRAH" class="w-10 h-10 object-contain drop-shadow shrink-0 group-hover:scale-105 transition-transform">
            <div class="leading-tight">
                <span class="block text-[11px] font-extrabold uppercase tracking-wider text-gold-400">Pusat Studi Laut Natuna Utara</span>
                <span class="block text-[10px] text-slate-300 font-medium">Universitas Maritim Raja Ali Haji</span>
            </div>
        </a>

        <a href="<?= base_url() ?>" 
           class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs font-semibold text-slate-300 hover:text-white bg-white/10 hover:bg-white/15 border border-white/10 transition-colors shadow-xs">
            <i class="fa-solid fa-arrow-left text-[10px]"></i>
            <span class="hidden sm:inline">Kembali ke Portal</span>
        </a>
    </header>

    <!-- Main Content: Centered Professional Card with Dev Auto-Login Mode -->
    <main class="w-full max-w-md mx-auto my-auto py-6"
          x-data="loginPageData(<?= !empty($isDev) ? 'true' : 'false' ?>, <?= !empty($justLoggedOut) ? 'true' : 'false' ?>)"
          x-init="init()">
        
        <!-- Login Card -->
        <div class="login-card rounded-3xl p-7 sm:p-9 space-y-6">
            
            <!-- Card Header -->
            <div class="text-center space-y-2">
                <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-navy-950 text-gold-400 text-2xl shadow-md border-2 border-gold-500/30 mb-1">
                    <i class="fa-solid fa-compass"></i>
                </div>
                <div>
                    <h1 class="text-xl sm:text-2xl font-black text-navy-950 tracking-tight">Admin CMS Portal</h1>
                    <p class="text-xs text-slate-500 mt-1">Masuk dengan kredensial terdaftar untuk mengelola konten</p>
                </div>
            </div>

            <!-- Development Auto-Login Mode Banner -->
            <?php if (!empty($isDev)): ?>
            <div class="p-4 rounded-2xl bg-gradient-to-br from-amber-500/10 via-amber-500/5 to-transparent border-2 border-amber-500/40 text-slate-800 space-y-3 shadow-xs transition-all"
                 :class="{ 'ring-2 ring-amber-400/50 shadow-md': countdown > 0 && !autoLoggingIn }">
                
                <div class="flex items-center justify-between">
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-amber-500 text-navy-950 font-black text-[10px] uppercase tracking-wider shadow-xs">
                        <i class="fa-solid fa-bolt"></i> Mode Dev Aktif
                    </span>
                    <span class="text-[10px] font-mono font-bold text-amber-700 bg-amber-100/90 px-2 py-0.5 rounded-md border border-amber-300">
                        Auto-Login Ready
                    </span>
                </div>

                <!-- Dynamic Status Message / Countdown -->
                <div class="space-y-1">
                    <template x-if="countdown > 0 && !autoLoggingIn">
                        <div class="flex items-center justify-between bg-white/80 p-2.5 rounded-xl border border-amber-200">
                            <span class="text-xs text-amber-950 font-medium flex items-center gap-2">
                                <i class="fa-solid fa-clock-rotate-left text-amber-600 animate-spin"></i>
                                <span>Masuk otomatis dalam <strong class="text-sm font-black text-amber-700 font-mono" x-text="countdown">3</strong>s</span>
                            </span>
                            <button type="button" @click="cancelAuto()" 
                                    class="text-[11px] font-bold text-slate-600 hover:text-rose-600 underline cursor-pointer">
                                Batalkan
                            </button>
                        </div>
                    </template>
                    <template x-if="autoLoggingIn">
                        <div class="flex items-center gap-2 text-xs text-emerald-800 font-bold bg-emerald-50 p-2.5 rounded-xl border border-emerald-200">
                            <i class="fa-solid fa-circle-notch fa-spin text-emerald-600 text-sm"></i>
                            <span>Menghubungkan sesi administrator...</span>
                        </div>
                    </template>
                    <template x-if="countdown === 0 && !autoLoggingIn">
                        <p class="text-xs text-slate-600 font-medium">
                            Klik tombol di bawah untuk masuk instan tanpa perlu mengetik sandi:
                        </p>
                    </template>
                </div>

                <!-- One-Click Action Buttons -->
                <div class="flex items-center gap-2 pt-0.5">
                    <a href="<?= base_url('admin/dev-login') ?>" @click="autoLoggingIn = true"
                       class="flex-1 py-2.5 px-3 rounded-xl bg-amber-500 hover:bg-amber-400 text-navy-950 font-bold text-xs shadow-xs text-center transition-all flex items-center justify-center gap-1.5 active:scale-[0.98]">
                        <i class="fa-solid fa-bolt"></i>
                        <span>Masuk Otomatis Sekarang</span>
                    </a>
                    <button type="button" @click="fillDefaultCredentials()"
                            class="py-2.5 px-3 rounded-xl bg-white hover:bg-slate-50 border border-slate-200 text-slate-700 font-semibold text-xs transition-colors shrink-0 shadow-xs"
                            title="Isi formulir dengan kredensial default">
                        <i class="fa-solid fa-wand-magic-sparkles text-amber-500 mr-1"></i>
                        <span>Isi Form</span>
                    </button>
                </div>
            </div>
            <?php endif; ?>

            <!-- Flash Error Message -->
            <?php if (!empty($error)): ?>
            <div class="p-3.5 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs flex items-start gap-3">
                <i class="fa-solid fa-circle-exclamation text-rose-600 text-base mt-0.5 shrink-0"></i>
                <div class="leading-relaxed font-medium"><?= esc($error) ?></div>
            </div>
            <?php endif; ?>

            <!-- Flash Success Message -->
            <?php if (!empty($success)): ?>
            <div class="p-3.5 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs flex items-start gap-3">
                <i class="fa-solid fa-circle-check text-emerald-600 text-base mt-0.5 shrink-0"></i>
                <div class="leading-relaxed font-medium"><?= esc($success) ?></div>
            </div>
            <?php endif; ?>

            <!-- Login Form -->
            <form action="<?= base_url('admin/login-action') ?>" method="POST" 
                  @submit="cancelAuto(); submitting = true" class="space-y-4">
                <?= csrf_field() ?>

                <!-- Username or Email -->
                <div class="space-y-1.5">
                    <label for="username" class="block text-xs font-bold text-slate-700">
                        Username atau Email <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative flex items-center rounded-xl border border-slate-300 bg-slate-50/50 input-glow transition-all">
                        <span class="pl-3.5 text-slate-400 text-sm">
                            <i class="fa-solid fa-user-shield"></i>
                        </span>
                        <input type="text" id="username" name="username" value="<?= old('username') ?>" required autofocus
                               placeholder="admin_nnsrc atau email"
                               autocomplete="username"
                               class="w-full px-3 py-3 text-xs sm:text-sm bg-transparent border-0 focus:outline-none text-slate-900 font-medium">
                    </div>
                </div>

                <!-- Password -->
                <div class="space-y-1.5">
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-xs font-bold text-slate-700">
                            Kata Sandi <span class="text-rose-500">*</span>
                        </label>
                    </div>
                    <div class="relative flex items-center rounded-xl border border-slate-300 bg-slate-50/50 input-glow transition-all">
                        <span class="pl-3.5 text-slate-400 text-sm">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <input :type="showPass ? 'text' : 'password'" id="password" name="password" required
                               placeholder="••••••••••••"
                               autocomplete="current-password"
                               class="w-full px-3 py-3 text-xs sm:text-sm bg-transparent border-0 focus:outline-none text-slate-900 font-medium font-mono">
                        <button type="button" @click="showPass = !showPass"
                                class="px-3 text-slate-400 hover:text-slate-600 text-xs cursor-pointer focus:outline-none focus:text-maritime-700"
                                :title="showPass ? 'Sembunyikan Kata Sandi' : 'Tampilkan Kata Sandi'"
                                aria-label="Tampilkan atau sembunyikan kata sandi">
                            <i class="fa-solid" :class="showPass ? 'fa-eye-slash' : 'fa-eye'"></i>
                        </button>
                    </div>
                </div>

                <!-- Action Button -->
                <div class="pt-2">
                    <button type="submit" :disabled="submitting"
                            class="w-full py-3.5 px-4 rounded-xl font-bold text-xs sm:text-sm bg-navy-950 hover:bg-maritime-700 text-gold-400 hover:text-white shadow-lg shadow-navy-950/20 active:scale-[0.98] transition-all flex items-center justify-center gap-2 cursor-pointer disabled:opacity-75">
                        <template x-if="!submitting">
                            <span class="inline-flex items-center gap-2">
                                <span>Masuk ke Dashboard</span>
                                <i class="fa-solid fa-arrow-right text-xs"></i>
                            </span>
                        </template>
                        <template x-if="submitting">
                            <span class="inline-flex items-center gap-2">
                                <i class="fa-solid fa-circle-notch fa-spin text-xs"></i>
                                <span>Memverifikasi Sesi...</span>
                            </span>
                        </template>
                    </button>
                </div>
            </form>

            <!-- Card Footer -->
            <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-400">
                <a href="<?= base_url() ?>" class="hover:text-maritime-700 flex items-center gap-1.5 font-medium transition-colors">
                    <i class="fa-solid fa-arrow-left text-[10px]"></i>
                    <span>Kembali ke Beranda</span>
                </a>
                <span class="inline-flex items-center gap-1.5 font-medium text-emerald-600">
                    <i class="fa-solid fa-shield-halved text-xs"></i>
                    <span>Terkoneksi Aman</span>
                </span>
            </div>

        </div>

    </main>

    <!-- Page Footer -->
    <footer class="w-full max-w-5xl mx-auto py-3 text-center text-[11px] text-slate-400">
        &copy; <?= date('Y') ?> Pusat Studi Laut Natuna Utara &bull; Universitas Maritim Raja Ali Haji (UMRAH)
    </footer>

    <!-- Alpine Data Logic -->
    <script>
    function loginPageData(isDev, justLoggedOut) {
        return {
            showPass: false,
            submitting: false,
            isDev: isDev,
            countdown: (isDev && !justLoggedOut) ? 3 : 0,
            autoLoggingIn: false,
            timer: null,
            init() {
                if (this.isDev && !justLoggedOut && this.countdown > 0) {
                    this.startCountdown();
                }
            },
            startCountdown() {
                this.timer = setInterval(() => {
                    if (this.countdown > 1) {
                        this.countdown--;
                    } else {
                        this.stopCountdown();
                        this.triggerDevLogin();
                    }
                }, 1000);
            },
            stopCountdown() {
                if (this.timer) {
                    clearInterval(this.timer);
                    this.timer = null;
                }
            },
            cancelAuto() {
                this.stopCountdown();
                this.countdown = 0;
            },
            triggerDevLogin() {
                this.autoLoggingIn = true;
                window.location.href = '<?= base_url('admin/dev-login') ?>';
            },
            fillDefaultCredentials() {
                this.cancelAuto();
                const u = document.getElementById('username');
                const p = document.getElementById('password');
                if (u) u.value = 'admin_nnsrc';
                if (p) p.value = 'AdminNatuna2026!';
            }
        };
    }
    </script>

</body>
</html>
