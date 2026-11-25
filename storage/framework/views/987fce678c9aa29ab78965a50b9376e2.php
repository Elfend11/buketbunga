

<?php $__env->startSection('content'); ?>
<section class="page-header">
    <div class="container">
        <h1>Katalog Buket</h1>
    </div>
</section>
<section class="container" style="padding-top:32px">
    <form method="GET">
        <label>Kategori
            <select name="kategori">
                <option value="">Semua kategori</option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->slug); ?>" <?php if(request('kategori') === $category->slug): echo 'selected'; endif; ?>><?php echo e($category->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </label>
        <button class="button" type="submit">Terapkan</button>
    </form>
    <div class="grid" style="margin-top:20px">
        <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <article class="card">
                <h2><?php echo e($product->name); ?></h2>
                <p><?php echo e($product->category->name); ?></p>
                <p>Rp <?php echo e(number_format((float) $product->price, 0, ',', '.')); ?></p>
                <a href="<?php echo e(route('catalog.show', $product->slug)); ?>">Lihat detail</a>
            </article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p>Tidak ada produk yang cocok.</p>
        <?php endif; ?>
    </div>
    <?php echo e($products->links()); ?>

</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\jayan\Documents\buketbunga\buketbunga\resources\views/customer/catalog/index.blade.php ENDPATH**/ ?>