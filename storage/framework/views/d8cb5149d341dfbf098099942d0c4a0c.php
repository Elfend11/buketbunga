

<?php $__env->startSection('content'); ?>
<section class="page-header">
    <div class="container">
        <h1><?php echo e($product->name); ?></h1>
        <p><?php echo e($product->category->name); ?></p>
    </div>
</section>
<section class="container" style="padding-top:32px">
    <p><?php echo e($product->description); ?></p>
    <p><strong>Harga dasar: Rp <?php echo e(number_format((float) $product->price, 0, ',', '.')); ?></strong></p>

    <form data-estimator-form action="<?php echo e(route('catalog.estimate', $product->slug)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="form-grid">
            <?php $__currentLoopData = $product->personalizationOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <fieldset>
                    <legend><?php echo e($option->name); ?><?php echo e($option->is_required ? ' (wajib)' : ''); ?></legend>
                    <?php $__currentLoopData = $option->values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <label>
                            <input type="<?php echo e($option->type === 'select' ? 'radio' : 'checkbox'); ?>"
                                   name="<?php echo e($option->type === 'select' ? 'option_value_ids[]' : 'option_value_ids[]'); ?>"
                                   value="<?php echo e($value->id); ?>">
                            <?php echo e($value->value_name); ?>

                            <?php if((float) $value->additional_price > 0): ?>
                                (+Rp <?php echo e(number_format((float) $value->additional_price, 0, ',', '.')); ?>)
                            <?php endif; ?>
                        </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </fieldset>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php $__currentLoopData = $product->addOns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addOn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <label>
                    <input type="checkbox" name="add_on_ids[]" value="<?php echo e($addOn->id); ?>">
                    <?php echo e($addOn->name); ?> (+Rp <?php echo e(number_format((float) $addOn->price, 0, ',', '.')); ?>)
                </label>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <div>
                <strong>Estimasi harga: <span data-estimated-total>Rp <?php echo e(number_format((float) $product->price, 0, ',', '.')); ?></span></strong>
                <p>Harga akhir dikonfirmasi pemilik melalui WhatsApp.</p>
            </div>
        </div>
    </form>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\jayan\Documents\buketbunga\buketbunga\resources\views\customer\catalog\show.blade.php ENDPATH**/ ?>