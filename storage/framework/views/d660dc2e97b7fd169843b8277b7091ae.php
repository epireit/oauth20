

<?php $__env->startSection('title', 'Benutzer bearbeiten'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white dark:bg-gray-800 p-6 rounded shadow-md">
    <h1 class="text-xl font-bold mb-4">Benutzer bearbeiten</h1>
    <form action="<?php echo e(route('admin.users.update', $user->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <label class="block">Name:</label>
        <input type="text" name="name" value="<?php echo e($user->name); ?>" class="w-full p-2 border dark:bg-gray-700 dark:text-white">

        <label class="block mt-2">E-Mail:</label>
        <input type="email" name="email" value="<?php echo e($user->email); ?>" class="w-full p-2 border dark:bg-gray-700 dark:text-white">

        <button type="submit" class="mt-3 p-2 bg-blue-500 text-white rounded">Speichern</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Programming\oauth\resources\views/admin/users/edit.blade.php ENDPATH**/ ?>