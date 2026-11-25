<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e($title ?? 'BLOOMÉ — Flowers & Stories'); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body>
    <header class="site-header">
        <div class="container nav-wrap">
            <a class="brand" href="<?php echo e(route('home')); ?>">BLOOMÉ</a>
            <nav class="main-nav" aria-label="Navigasi utama">
                <a href="<?php echo e(route('home')); ?>">Beranda</a>
                <a href="<?php echo e(route('catalog.index')); ?>">Katalog</a>
                <a href="<?php echo e(route('static.about')); ?>">Tentang</a>
                <a href="<?php echo e(route('static.contact')); ?>">Kontak</a>
            </nav>
        </div>
    </header>

    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <footer class="site-footer">
        <div class="container">
            <strong>BLOOMÉ — Flowers & Stories</strong>
            <p>Samarinda</p>
        </div>
    </footer>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\Users\jayan\Documents\buketbunga\buketbunga\resources\views\layouts\app.blade.php ENDPATH**/ ?>