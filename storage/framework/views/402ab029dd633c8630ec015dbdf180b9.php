
<?php $__env->startSection('content'); ?>
<div style="display:flex;justify-content:space-between;align-items:center">
    <h1>Produk</h1><a class="button" href="<?php echo e(route('admin.products.create')); ?>">Tambah Produk</a>
</div>
<div class="table-wrap">
<table><thead><tr><th>Nama</th><th>Kategori</th><th>Harga</th><th>Ketersediaan</th><th>Aksi</th></tr></thead>
<tbody>
<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
    <td><?php echo e($product->name); ?></td><td><?php echo e($product->category->name); ?></td>
    <td>Rp <?php echo e(number_format((float) $product->price, 0, ',', '.')); ?></td>
    <td><?php echo e($product->is_available ? 'Tersedia' : 'Habis'); ?></td>
    <td>
        <a href="<?php echo e(route('admin.products.edit', $product->id)); ?>">Edit</a>
        <form method="POST" action="<?php echo e(route('admin.products.toggle', $product->id)); ?>" style="display:inline"><?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?><button type="submit">Toggle</button></form>
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody></table></div>
<?php echo e($products->links()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\jayan\Documents\buketbunga\buketbunga\resources\views\admin\products\index.blade.php ENDPATH**/ ?>