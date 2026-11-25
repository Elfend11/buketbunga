
<?php $__env->startSection('content'); ?>
<h1>Edit Produk</h1>
<form class="form-grid" method="POST" action="<?php echo e(route('admin.products.update', $product->id)); ?>" enctype="multipart/form-data">
<?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
<label>Kategori<select name="category_id" required><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($category->id); ?>" <?php if($product->category_id == $category->id): echo 'selected'; endif; ?>><?php echo e($category->name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select></label>
<label>Nama<input name="name" value="<?php echo e(old('name', $product->name)); ?>" required></label>
<label>Harga Dasar<input type="number" name="price" value="<?php echo e(old('price', $product->price)); ?>" min="1000" required></label>
<label>Deskripsi<textarea name="description" required><?php echo e(old('description', $product->description)); ?></textarea></label>
<label>Foto Baru (opsional)<input type="file" name="image" accept="image/jpeg,image/png,image/webp"></label>
<label><input type="checkbox" name="is_available" value="1" <?php if($product->is_available): echo 'checked'; endif; ?>>Tersedia</label>
<button class="button" type="submit">Simpan Perubahan</button>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\jayan\Documents\buketbunga\buketbunga\resources\views\admin\products\edit.blade.php ENDPATH**/ ?>