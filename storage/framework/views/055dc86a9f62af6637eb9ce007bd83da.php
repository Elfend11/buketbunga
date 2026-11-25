
<?php $__env->startSection('content'); ?>
<section class="container" style="max-width:480px;padding-top:48px">
    <h1>Login Admin</h1>
    <?php if($errors->any()): ?>
        <div class="alert alert-error"><?php echo e($errors->first()); ?></div>
    <?php endif; ?>
    <form class="form-grid" method="POST" action="<?php echo e(route('admin.login.submit')); ?>">
        <?php echo csrf_field(); ?>
        <label>Email
            <input type="email" name="email" value="<?php echo e(old('email')); ?>" required>
        </label>
        <label>Password
            <input type="password" name="password" required>
        </label>
        <label><input type="checkbox" name="remember" value="1"> Ingat saya</label>
        <button class="button" type="submit">Masuk</button>
    </form>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\jayan\Documents\buketbunga\buketbunga\resources\views/admin/auth/login.blade.php ENDPATH**/ ?>