
<?php $__env->startSection('content'); ?>
<section class="page-header"><div class="container"><h1>Kontak</h1></div></section>
<section class="container" style="padding-top:32px">
    <?php if($contact['address']): ?><p><strong>Alamat:</strong> <?php echo e($contact['address']); ?></p><?php endif; ?>
    <?php if($contact['hours']): ?><p><strong>Jam operasional:</strong> <?php echo e($contact['hours']); ?></p><?php endif; ?>
    <?php if(!$contact['address'] && !$contact['hours']): ?><p>Informasi kontak resmi belum dikonfigurasi.</p><?php endif; ?>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\jayan\Documents\buketbunga\buketbunga\resources\views/customer/static/contact.blade.php ENDPATH**/ ?>