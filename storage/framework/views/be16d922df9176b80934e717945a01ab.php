

<?php $__env->startSection('title', 'Benutzerverwaltung'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white dark:bg-gray-800 p-6 rounded shadow-md">
    <h1 class="text-xl font-bold mb-4">Benutzerverwaltung</h1>
    <table class="w-full border-collapse">
        <tr class="bg-gray-300 dark:bg-gray-700">
            <th class="p-2 border">ID</th>
            <th class="p-2 border">Name</th>
            <th class="p-2 border">E-Mail</th>
            <th class="p-2 border">Aktionen</th>
        </tr>
        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td class="p-2 border"><?php echo e($user->id); ?></td>
            <td class="p-2 border"><?php echo e($user->name); ?></td>
            <td class="p-2 border"><?php echo e($user->email); ?></td>
            <td class="p-2 border">
                <a href="<?php echo e(route('admin.users.edit', $user->id)); ?>" class="px-2 py-1 bg-blue-500 text-white rounded">Bearbeiten</a>
                <form action="<?php echo e(route('admin.users.delete', $user->id)); ?>" method="POST" style="display:inline;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded">Löschen</button>
                </form>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Programming\oauth\resources\views/admin/users/index.blade.php ENDPATH**/ ?>