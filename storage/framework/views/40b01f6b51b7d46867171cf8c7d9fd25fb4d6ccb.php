<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row justify-content-center">
        <router-view name="articlesIndex"></router-view>
        <router-view></router-view>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>