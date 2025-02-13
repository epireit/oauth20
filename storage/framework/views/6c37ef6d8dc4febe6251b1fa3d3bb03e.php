

<?php $__env->startSection('title', 'Theme-Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white dark:bg-gray-800 p-6 rounded shadow-md">
    <h1 class="text-xl font-bold mb-4">Theme-Management</h1>

    <h2 class="text-lg font-bold mb-2">Aktuelles Theme: <?php echo e($activeTheme); ?></h2>

    <table class="w-full border-collapse">
        <tr class="bg-gray-300 dark:bg-gray-700">
            <th class="p-2 border">Theme-Name</th>
            <th class="p-2 border">Aktionen</th>
        </tr>
        <?php $__currentLoopData = $themes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $theme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td class="p-2 border"><?php echo e(basename($theme)); ?></td>
            <td class="p-2 border">
                <?php if($activeTheme !== basename($theme)): ?>
                    <form action="<?php echo e(route('admin.themes.activate', basename($theme))); ?>" method="POST" style="display:inline;">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="px-2 py-1 bg-blue-500 text-white rounded">Aktivieren</button>
                    </form>
                    <form action="<?php echo e(route('admin.themes.delete', basename($theme))); ?>" method="POST" style="display:inline;">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded">Löschen</button>
                    </form>
                <?php else: ?>
                    <span class="px-2 py-1 bg-green-500 text-white rounded">Aktiv</span>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>

    <h2 class="text-lg font-bold mt-6 mb-2">Neues Theme hochladen</h2>
    <form action="<?php echo e(route('admin.themes.upload')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <input type="file" name="theme" class="block mt-2 p-2 border dark:bg-gray-700 dark:text-white">
        <button type="submit" class="mt-3 p-2 bg-blue-500 text-white rounded">Hochladen</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Programming\oauth\resources\views/admin/themes/index.blade.php ENDPATH**/ ?>