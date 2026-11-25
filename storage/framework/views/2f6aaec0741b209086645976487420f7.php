

<?php $__env->startSection('content'); ?>
<section class="hero">
    <div class="container">
        <h1>BLOOMÉ — Flowers & Stories</h1>
        <p>Katalog buket dan personalisasi untuk momen istimewa.</p>
        <a class="button" href="<?php echo e(route('catalog.index')); ?>">Lihat Katalog</a>
    </div>
</section>
<section class="container" style="padding-top:32px">
    <h2>Kategori</h2>
    <div class="grid">
        <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <article class="card">
                <h3><?php echo e($category->name); ?></h3>
                <p><?php echo e($category->description); ?></p>
            </article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p>Belum ada kategori yang terdaftar.</p>
        <?php endif; ?>
    </div>
</section>
<section class="container" style="padding-top:32px">
    <h2>Buket Unggulan</h2>
    <div class="grid">
        <?php $__empty_1 = true; $__currentLoopData = $featuredProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <article class="card">
                <h3><?php echo e($product->name); ?></h3>
                <p>Rp <?php echo e(number_format((float) $product->price, 0, ',', '.')); ?></p>
                <a href="<?php echo e(route('catalog.show', $product->slug)); ?>">Lihat detail</a>
            </article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p>Belum ada produk yang tersedia.</p>
        <?php endif; ?>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\jayan\Documents\buketbunga\buketbunga\resources\views/customer/home.blade.php ENDPATH**/ ?>