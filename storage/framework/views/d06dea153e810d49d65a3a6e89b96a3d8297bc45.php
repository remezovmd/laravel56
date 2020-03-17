<?php $__env->startSection('content'); ?>
<?php $user = DB::table('users')->where('id', Auth::user()->id)->first(); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Профиль пользователя <?php echo e(Auth::user()->name); ?></div>

                <div class="card-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>
					<form enctype="multipart/form-data" method="POST" action="<?php echo e(route('profile-update')); ?>" aria-label="<?php echo e(__('Register')); ?>">
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
                                <input id="DOB" type="date" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="DOB" value="<?php echo e($user->DOB); ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="photo" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Фото')); ?></label>

                            <div class="col-md-6">
                                <input id="photo" type="file" class="form-control" name="photo">
                            </div>
							
                        </div>
						<div class="form-group row">
							<label for="photo" class="col-md-4 col-form-label text-md-right"></label>
							<div class="col-md-6">
								<img id="photoImage" src="<?php echo e(Storage::url($user->photo)); ?>" class="form-control" name="photoImage">
							</div>
						</div>
						<input id="id" type="hidden" class="form-control" name="id" value="<?php echo e($user->id); ?>">
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