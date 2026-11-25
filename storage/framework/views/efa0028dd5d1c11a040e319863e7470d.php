
<?php $__env->startSection('content'); ?>
<section class="page-header"><div class="container"><h1><?php echo e($product->name); ?></h1></div></section>
<section class="container" style="padding-top:32px"><p>Checkout internal bersifat legacy dan tidak menjadi alur WhatsApp utama. Lihat detail produk untuk estimasi dan konsultasi.</p><a class="button" href="<?php echo e(route('catalog.show', $product->slug)); ?>">Lihat Personalisasi</a></section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\jayan\Documents\buketbunga\buketbunga\resources\views\customer\order\create.blade.php ENDPATH**/ ?>