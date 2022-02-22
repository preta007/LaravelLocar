

<?php $__env->startSection('content'); ?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>API <?php echo app('translator')->get('cruds.userManagement.title'); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo app('translator')->get('global.home'); ?></a></li>
                        <li class="breadcrumb-item"><a href="<?php echo e(route('api-userIndex')); ?>">API <?php echo app('translator')->get('cruds.user.title'); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo app('translator')->get('global.add'); ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->

    <section class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo app('translator')->get('global.add'); ?></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <form action="<?php echo e(route('api-userCreate')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label>Имя пользователя</label>
                                <input type="text" name="name" class="form-control <?php echo e($errors->has('name') ? "is-invalid":""); ?>" value="<?php echo e(old('name')); ?>">
                                <?php if($errors->has('name')): ?>
                                    <span class="error invalid-feedback"><?php echo e($errors->first('name')); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label>Срок действия токена</label>
                                <input type="number" name="token_valid_period" max="999999" min="1" class="form-control <?php echo e($errors->has('token_valid_period') ? "is-invalid":""); ?>" value="<?php echo e(old('token_valid_period',30)); ?>">
                                <?php if($errors->has('token_valid_period')): ?>
                                    <span class="error invalid-feedback"><?php echo e($errors->first('token_valid_period')); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label><?php echo app('translator')->get('cruds.user.fields.password'); ?></label>
                                <input type="password" name="password" id="password-field" class="form-control <?php echo e($errors->has('password') ? "is-invalid":""); ?>" required>
                                <span toggle="#password-field" class="fa fa-fw fa-eye toggle-password field-icon"></span>
                                <?php if($errors->has('password')): ?>
                                    <span class="error invalid-feedback"><?php echo e($errors->first('password')); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label><?php echo app('translator')->get('global.login_password_confirmation'); ?></label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                <span toggle="#password-confirm" class="fa fa-fw fa-eye toggle-password field-icon"></span>
                                <?php if($errors->has('password_confirmation')): ?>
                                    <span class="error invalid-feedback"><?php echo e($errors->first('password_confirmation')); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success float-right"><?php echo app('translator')->get('global.save'); ?></button>
                                <a href="<?php echo e(route('api-userIndex')); ?>" class="btn btn-default float-left"><?php echo app('translator')->get('global.cancel'); ?></a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\LocarMaisNovo\resources\views/pages/api-user/add.blade.php ENDPATH**/ ?>