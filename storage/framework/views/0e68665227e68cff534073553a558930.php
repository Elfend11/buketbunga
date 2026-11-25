
<?php $__env->startSection('content'); ?>
<h1>Pengaturan</h1>
<form class="form-grid" method="POST" action="<?php echo e(route('admin.settings.update')); ?>">
<?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
<label>Nama<input name="name" value="<?php echo e(old('name', $admin->name)); ?>" required></label>
<label>Kata sandi saat ini<input type="password" name="current_password"></label>
<label>Kata sandi baru<input type="password" name="new_password"></label>
<label>Konfirmasi kata sandi baru<input type="password" name="new_password_confirmation"></label>
<label>Nomor WhatsApp resmi<input name="whatsapp_number" value="<?php echo e(old('whatsapp_number', $settings['whatsapp_number'])); ?>" placeholder="Kosongkan jika nomor belum dikonfirmasi"></label>
<label>Alamat toko<textarea name="shop_address"><?php echo e(old('shop_address', $settings['shop_address'])); ?></textarea></label>
<label>Jam operasional<input name="operational_hours" value="<?php echo e(old('operational_hours', $settings['operational_hours'])); ?>"></label>
<button class="button" type="submit">Simpan Pengaturan</button>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\jayan\Documents\buketbunga\buketbunga\resources\views\admin\settings\index.blade.php ENDPATH**/ ?>