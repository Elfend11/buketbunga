<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e($title ?? 'Admin — BLOOMÉ'); ?></title>
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
</head>
<body class="admin-body">
    <aside class="admin-sidebar">
        <a class="brand" href="<?php echo e(route('admin.dashboard')); ?>">BLOOMÉ</a>
        <nav class="admin-nav" aria-label="Navigasi admin">
            <a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a>
            <a href="<?php echo e(route('admin.categories.index')); ?>">Kategori</a>
            <a href="<?php echo e(route('admin.products.index')); ?>">Produk</a>
            <a href="<?php echo e(route('admin.personalization.index')); ?>">Personalisasi</a>
            <a href="<?php echo e(route('admin.addons.index')); ?>">Add-on</a>
            <a href="<?php echo e(route('admin.settings.index')); ?>">Pengaturan</a>
        </nav>
        <form method="POST" action="<?php echo e(route('admin.logout')); ?>">
            <?php echo csrf_field(); ?>
            <button class="button button-secondary" type="submit">Keluar</button>
        </form>
    </aside>
    <main class="admin-main">
        <?php if(session('success')): ?><div class="alert alert-success"><?php echo e(session('success')); ?></div><?php endif; ?>
        <?php if(session('error')): ?><div class="alert alert-error"><?php echo e(session('error')); ?></div><?php endif; ?>
        <?php echo $__env->yieldContent('content'); ?>
    </main>
</body>
</html>
<?php /**PATH C:\Users\jayan\Documents\buketbunga\buketbunga\resources\views\layouts\admin.blade.php ENDPATH**/ ?>