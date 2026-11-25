
<?php $__env->startSection('content'); ?>
<h1>Add-on</h1>
<form class="form-grid" method="POST" action="<?php echo e(route('admin.addons.store')); ?>">
<?php echo csrf_field(); ?>
<label>Nama<input name="name" required></label>
<label>Harga<input type="number" name="price" min="0" required></label>
<label>Deskripsi<textarea name="description"></textarea></label>
<label><input type="checkbox" name="is_available" value="1" checked>Tersedia</label>
<fieldset><legend>Produk terkait</legend><?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><label><input type="checkbox" name="product_ids[]" value="<?php echo e($product->id); ?>"> <?php echo e($product->name); ?></label><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></fieldset>
<button class="button" type="submit">Tambah Add-on</button>
</form>
<div class="grid" style="margin-top:24px">
<?php $__currentLoopData = $addOns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addOn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<article class="card"><h2><?php echo e($addOn->name); ?></h2><p>Rp <?php echo e(number_format((float) $addOn->price, 0, ',', '.')); ?></p><form method="POST" action="<?php echo e(route('admin.addons.destroy', $addOn->id)); ?>"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button class="button button-secondary" type="submit">Hapus</button></form></article>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\jayan\Documents\buketbunga\buketbunga\resources\views\admin\addons\index.blade.php ENDPATH**/ ?>