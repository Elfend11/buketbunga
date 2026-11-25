
<?php $__env->startSection('content'); ?>
<h1>Tambah Produk</h1>
<form class="form-grid" method="POST" action="<?php echo e(route('admin.products.store')); ?>" enctype="multipart/form-data">
<?php echo csrf_field(); ?>
<label>Kategori<select name="category_id" required><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select></label>
<label>Nama<input name="name" value="<?php echo e(old('name')); ?>" required></label>
<label>Harga Dasar<input type="number" name="price" value="<?php echo e(old('price')); ?>" min="1000" required></label>
<label>Deskripsi<textarea name="description" required><?php echo e(old('description')); ?></textarea></label>
<label>Foto Utama<input type="file" name="image" accept="image/jpeg,image/png,image/webp" required></label>
<label><input type="checkbox" name="is_available" value="1" checked>Tersedia</label>
<button class="button" type="submit">Simpan</button>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\jayan\Documents\buketbunga\buketbunga\resources\views\admin\products\create.blade.php ENDPATH**/ ?>