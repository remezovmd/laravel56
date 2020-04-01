<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Новости</div>

                <div class="card-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>
					
                    <form enctype="multipart/form-data" method="POST" action="<?php echo e(route('new-add-show')); ?>" aria-label="<?php echo e(__('Register')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="form-group row">
							<div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo e(__('Добавить')); ?>

                                </button>
                            </div>
						</div>
					</form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>