

<?php $__env->startSection('content'); ?>
<div class="container mx-auto py-10 px-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Yazılar</h1>
        <?php if(auth()->guard()->check()): ?>
            <a href="<?php echo e(route('posts.create')); ?>" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md">Yeni Yazı Ekle</a>
        <?php endif; ?>
    </div>

    <?php if(session('success')): ?>
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded-lg shadow-md p-5 flex flex-col justify-between">
                <div>
                    <h2 class="text-lg font-semibold mb-2"><?php echo e($post->title); ?></h2>
                    <p class="text-sm text-gray-700 dark:text-gray-300 mb-4"><?php echo e(Str::limit($post->content, 100)); ?></p>
                </div>
                <div class="flex justify-between items-center mt-auto">
                    <a href="<?php echo e(route('posts.show', $post->id)); ?>" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-sm">Göster</a>
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('posts.edit', $post->id)); ?>" class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-md text-sm">Düzenle</a>
                        <form action="<?php echo e(route('posts.destroy', $post->id)); ?>" method="POST" class="inline-block" onsubmit="return confirm('Silmek istediğinize emin misiniz?');">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-sm">Sil</button>
                        </form>
                    <?php endif; ?>
                </div>
                <div class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                    <?php echo e($post->created_at->format('d-m-Y H:i')); ?>

                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-1 md:col-span-2 lg:col-span-3">
                <div class="text-center p-6 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-md">
                    Henüz yazı eklenmemiş.
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Monster\Desktop\xamapp\htdocs\php\Blog_2\resources\views/posts/index.blade.php ENDPATH**/ ?>