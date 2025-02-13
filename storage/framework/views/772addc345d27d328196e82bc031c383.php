

<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white dark:bg-gray-800 p-6 rounded shadow-md">
    <h1 class="text-xl font-bold">Willkommen im Admin Panel!</h1>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Programming\oauth\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>