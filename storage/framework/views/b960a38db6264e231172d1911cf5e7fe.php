
<?php $__env->startSection('content'); ?>
<h1>Dashboard</h1>
<div class="grid">
    <article class="card"><h2><?php echo e($newOrdersTodayCount); ?></h2><p>Pesanan hari ini</p></article>
    <article class="card"><h2><?php echo e($pendingVerificationCount); ?></h2><p>Menunggu verifikasi</p></article>
    <article class="card"><h2><?php echo e($customNeedsPricingCount); ?></h2><p>Perlu penentuan harga</p></article>
    <article class="card"><h2>Rp <?php echo e(number_format((float) $monthlyRevenue, 0, ',', '.')); ?></h2><p>Pendapatan bulan ini</p></article>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\jayan\Documents\buketbunga\buketbunga\resources\views\admin\dashboard\index.blade.php ENDPATH**/ ?>