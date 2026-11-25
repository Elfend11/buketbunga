
<?php $__env->startSection('content'); ?>
<section class="container" style="padding-top:32px"><h1>Ringkasan</h1><p>Kode: <?php echo e($order->order_code); ?></p><?php if($waLink): ?><a class="button" href="<?php echo e($waLink); ?>">Lanjutkan ke WhatsApp</a><?php else: ?><p>Tautan WhatsApp belum dikonfigurasi oleh admin.</p><?php endif; ?></section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\jayan\Documents\buketbunga\buketbunga\resources\views\customer\order\summary.blade.php ENDPATH**/ ?>