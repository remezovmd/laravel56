<?php $__env->startSection('content'); ?>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>Профиль пользователя</h2></div>

                <div class="card-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>
					<form enctype="multipart/form-data" method="POST" action="<?php echo e(route('profile-update')); ?>" aria-label="<?php echo e(__('Profile')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right"><?php echo e(__('ФИО')); ?></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" name="name" value="<?php echo e($user->name); ?>" required autofocus>

                                <?php if($errors->has('name')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="DOB" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Дата рождения')); ?></label>

                            <div class="col-md-6">
                                <input id="DOB" type="date" class="form-control" name="DOB" value="<?php echo e($user->DOB); ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="photo" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Фото')); ?></label>

                            <div class="col-md-6">
                                <input id="photo" type="file" class="form-control-file" name="photo">
                            </div>
                        </div>
                        <?php if(Null !== $user->photo): ?>
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <img id="preview" src="storage/<?php echo e($user->photo); ?>" width = 100%>
                                </div>
                            </div>
                        <?php endif; ?>
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