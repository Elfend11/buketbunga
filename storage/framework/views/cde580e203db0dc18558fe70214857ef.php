
<?php $__env->startSection('content'); ?>
<h1>Kategori</h1>
<form class="form-grid" method="POST" action="<?php echo e(route('admin.categories.store')); ?>">
    <?php echo csrf_field(); ?>
    <label>Nama<input name="name" value="<?php echo e(old('name')); ?>" required></label>
    <label>Deskripsi<textarea name="description"><?php echo e(old('description')); ?></textarea></label>
    <button class="button" type="submit">Tambah kategori</button>
</form>
<div class="table-wrap" style="margin-top:24px">
<table><thead><tr><th>Nama</th><th>Produk</th><th>Aksi</th></tr></thead>
<tbody>
<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
    <td><?php echo e($category->name); ?></td><td><?php echo e($category->products_count); ?></td>
    <td>
        <form method="POST" action="<?php echo e(route('admin.categories.destroy', $category->id)); ?>" onsubmit="return confirm('Hapus kategori?')">
            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button class="button button-secondary" type="submit">Hapus</button>
        </form>
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody></table></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\jayan\Documents\buketbunga\buketbunga\resources\views\admin\categories\index.blade.php ENDPATH**/ ?>