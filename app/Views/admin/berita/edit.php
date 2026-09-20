<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="space-y-6 max-w-4xl">
    
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-navy-950">Sunting Berita</h2>
            <p class="text-xs text-slate-500 mt-0.5">Perbarui informasi naskah atau gambar berita</p>
        </div>
        <a href="<?= base_url('admin/berita') ?>" class="text-xs text-slate-500 hover:text-navy-950 font-semibold">
            &larr; Kembali ke Daftar
        </a>
    </div>

    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-xs">
        <form action="<?= base_url('admin/berita/update/' . $article['id']) ?>" method="POST" enctype="multipart/form-data" class="space-y-5">
            <?= csrf_field() ?>

            <div class="space-y-1.5">
                <label for="title" class="block text-xs font-bold text-slate-700">Judul Berita *</label>
                <input type="text" id="title" name="title" required value="<?= esc($article['title']) ?>"
                       class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-maritime-600 focus:border-transparent bg-white">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label for="category" class="block text-xs font-bold text-slate-700">Kategori *</label>
                    <select id="category" name="category" required class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-maritime-600 focus:border-transparent bg-white">
                        <option value="Kerjasama Riset" <?= $article['category'] === 'Kerjasama Riset' ? 'selected' : '' ?>>Kerjasama Riset</option>
                        <option value="Kelembagaan" <?= $article['category'] === 'Kelembagaan' ? 'selected' : '' ?>>Kelembagaan</option>
                        <option value="Ekspedisi Maritim" <?= $article['category'] === 'Ekspedisi Maritim' ? 'selected' : '' ?>>Ekspedisi Maritim</option>
                        <option value="Kebijakan Strategis" <?= $article['category'] === 'Kebijakan Strategis' ? 'selected' : '' ?>>Kebijakan Strategis</option>
                        <option value="Seminar & Konferensi" <?= $article['category'] === 'Seminar & Konferensi' ? 'selected' : '' ?>>Seminar & Konferensi</option>
                    </select>
                </div>

                <div class="space-y-1.5">
                    <label for="tags" class="block text-xs font-bold text-slate-700">Tagar / Topik (pisahkan koma)</label>
                    <?php 
                        $tagStr = is_array($article['tags']) ? implode(', ', $article['tags']) : $article['tags'];
                    ?>
                    <input type="text" id="tags" name="tags" value="<?= esc($tagStr) ?>"
                           class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-maritime-600 focus:border-transparent bg-white">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label for="author" class="block text-xs font-bold text-slate-700">Nama Penulis / Tim *</label>
                    <input type="text" id="author" name="author" required value="<?= esc($article['author']) ?>"
                           class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-maritime-600 focus:border-transparent bg-white">
                </div>

                <div class="space-y-1.5">
                    <label for="author_role" class="block text-xs font-bold text-slate-700">Afiliasi Penulis</label>
                    <input type="text" id="author_role" name="author_role" value="<?= esc($article['author_role']) ?>"
                           class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-maritime-600 focus:border-transparent bg-white">
                </div>
            </div>

            <div class="space-y-1.5">
                <label for="excerpt" class="block text-xs font-bold text-slate-700">Ringkasan Berita (Excerpt) *</label>
                <textarea id="excerpt" name="excerpt" required rows="2"
                          class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-maritime-600 focus:border-transparent bg-white"><?= esc($article['excerpt']) ?></textarea>
            </div>

            <div class="space-y-1.5">
                <label for="content" class="block text-xs font-bold text-slate-700">Konten Lengkap Berita (Pisahkan per paragraf dengan baris baru) *</label>
                <?php 
                    $contentStr = is_array($article['content']) ? implode("\n\n", $article['content']) : $article['content'];
                ?>
                <textarea id="content" name="content" required rows="8"
                          class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-maritime-600 focus:border-transparent bg-white"><?= esc($contentStr) ?></textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label for="image" class="block text-xs font-bold text-slate-700">Ganti Foto Utama (Opsional)</label>
                    <input type="file" id="image" name="image" accept="image/*"
                           class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-maritime-600 focus:border-transparent bg-white">
                    <div class="text-[11px] text-slate-400">File saat ini: <?= esc($article['image']) ?></div>
                </div>

                <div class="space-y-1.5">
                    <label for="image_caption" class="block text-xs font-bold text-slate-700">Keterangan Foto</label>
                    <input type="text" id="image_caption" name="image_caption" value="<?= esc($article['image_caption']) ?>"
                           class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-maritime-600 focus:border-transparent bg-white">
                </div>
            </div>

            <div class="pt-2 flex items-center gap-2">
                <input type="checkbox" id="is_featured" name="is_featured" value="1" <?= !empty($article['is_featured']) ? 'checked' : '' ?>
                       class="rounded border-slate-300 text-maritime-600 focus:ring-maritime-500">
                <label for="is_featured" class="text-xs font-semibold text-slate-700 cursor-pointer">
                    Jadikan Berita Unggulan (Tampil di bagian atas beranda)
                </label>
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="<?= base_url('admin/berita') ?>" class="px-4 py-2.5 text-xs font-semibold text-slate-600 hover:bg-slate-100 rounded-xl transition-colors">
                    Batal
                </a>
                <button type="submit" 
                        class="px-5 py-2.5 bg-navy-950 hover:bg-maritime-700 text-gold-400 hover:text-white rounded-xl font-bold text-xs shadow-md transition-all active:scale-[0.98] cursor-pointer flex items-center gap-2">
                    <i class="fa-solid fa-check"></i>
                    <span>Simpan Perubahan</span>
                </button>
            </div>
        </form>
    </div>

</div>

<?= $this->endSection() ?>
