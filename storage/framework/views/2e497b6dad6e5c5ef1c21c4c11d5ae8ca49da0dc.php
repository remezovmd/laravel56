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
						<form enctype="multipart/form-data" method="POST" action="<?php echo e(route('new-add')); ?>" aria-label="<?php echo e(__('Register')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Заголовок')); ?></label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="abbrText" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Cокращенный текст')); ?></label>

                            <div class="col-md-6">
                                <textarea id="abbrText" class="form-control" name="abbrText" rows=5></textarea>
                            </div>
                        </div>
						
						<div class="form-group row">
                            <label for="fullText" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Полный текст')); ?></label>

                            <div class="col-md-6">
                                <textarea id="fullText" class="form-control" name="fullText" rows=10></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="photo" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Фото')); ?></label>

                            <div class="col-md-6">
                                <input id="photo" type="file" class="form-control" name="photo">
                            </div>
							
                        </div>
						
						<div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo e(__('Сохранить')); ?>

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