

<?php $__env->startSection('content'); ?>

<h1>Home :<?php echo e(Auth::user()->name); ?></h1>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xaamp\htdocs\natural-shop\resources\views/dashboard.blade.php ENDPATH**/ ?>