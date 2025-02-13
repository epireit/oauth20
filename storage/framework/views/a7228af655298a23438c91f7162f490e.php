

<?php $__env->startSection('title', 'Branding-Einstellungen'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white dark:bg-gray-800 p-6 rounded shadow-md">
    <h1 class="text-xl font-bold mb-4">Branding-Einstellungen</h1>

    <form action="<?php echo e(route('admin.branding.update')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        <label class="block font-semibold">Plattform-Name:</label>
        <input type="text" name="platform_name" value="<?php echo e($branding['platform_name']); ?>" class="w-full p-2 border dark:bg-gray-700 dark:text-white">

        <label class="block font-semibold mt-2">Primärfarbe:</label>
        <input type="color" name="primary_color" value="<?php echo e($branding['primary_color']); ?>" class="w-full p-2 border dark:bg-gray-700 dark:text-white">

        <label class="block font-semibold mt-2">Logo hochladen:</label>
        <input type="file" name="logo" class="block mt-2 p-2 border dark:bg-gray-700 dark:text-white">

        <?php if($branding['logo']): ?>
            <img src="<?php echo e(asset($branding['logo'])); ?>" alt="Logo" class="h-16 mt-2">
        <?php endif; ?>

        <button type="submit" class="mt-3 p-2 bg-blue-500 text-white rounded">Speichern</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Programming\oauth\resources\views/admin/settings/branding.blade.php ENDPATH**/ ?>