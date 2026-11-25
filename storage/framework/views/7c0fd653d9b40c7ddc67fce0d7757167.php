
<?php $__env->startSection('content'); ?>
<h1>Personalisasi</h1>
<form class="form-grid" method="POST" action="<?php echo e(route('admin.personalization.store')); ?>">
<?php echo csrf_field(); ?>
<label>Nama opsi<input name="name" required></label>
<label>Tipe<select name="type"><option value="select">Select</option><option value="radio">Radio</option><option value="color_swatch">Color swatch</option></select></label>
<label><input type="checkbox" name="is_required" value="1"> Wajib</label>
<fieldset><legend>Produk terkait</legend><?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><label><input type="checkbox" name="product_ids[]" value="<?php echo e($product->id); ?>"> <?php echo e($product->name); ?></label><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></fieldset>
<button class="button" type="submit">Tambah Opsi</button>
</form>
<?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<article class="card" style="margin-top:24px">
<h2><?php echo e($option->name); ?></h2>
<form class="form-grid" method="POST" action="<?php echo e(route('admin.personalization.values.store', $option->id)); ?>">
<?php echo csrf_field(); ?>
<label>Nama nilai<input name="value_name" required></label>
<label>Harga tambahan<input type="number" name="additional_price" min="0" value="0" required></label>
<label>Kode warna (opsional)<input name="color_hex" placeholder="#E99AAF"></label>
<label><input type="checkbox" name="is_available" value="1" checked>Tersedia</label>
<button class="button" type="submit">Tambah Nilai</button>
</form>
<form method="POST" action="<?php echo e(route('admin.personalization.destroy', $option->id)); ?>"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button class="button button-secondary" type="submit">Hapus Opsi</button></form>
</article>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\jayan\Documents\buketbunga\buketbunga\resources\views\admin\personalization\index.blade.php ENDPATH**/ ?>