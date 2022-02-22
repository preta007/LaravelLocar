

<?php $__env->startSection('content'); ?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo app('translator')->get('cruds.taxa.title'); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo app('translator')->get('global.home'); ?></a></li>
                        <li class="breadcrumb-item"><a href="<?php echo e(route('userIndex')); ?>"><?php echo app('translator')->get('cruds.taxa.title'); ?></a></li>
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

                        <form action="<?php echo e(route('taxaCreate')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label><?php echo app('translator')->get('cruds.taxa.fields.name'); ?></label>
                                <input type="text" name="nome" class="form-control <?php echo e($errors->has('nome') ? "is-invalid":""); ?>" value="<?php echo e(old('nome')); ?>" required>
                                <?php if($errors->has('nome')): ?>
                                    <span class="error invalid-feedback"><?php echo e($errors->first('nome')); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label><?php echo app('translator')->get('cruds.plano.fields.percentage'); ?></label>
                                <input type="number" name="percentual" min="1" max="100" class="form-control <?php echo e($errors->has('percentual') ? "is-invalid":""); ?>" value="<?php echo e(old('percentual')); ?>" step="0.01" required>
                                <?php if($errors->has('percentage')): ?>
                                    <span class="error invalid-feedback"><?php echo e($errors->first('percentual')); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label><?php echo app('translator')->get('cruds.plano.fields.limit'); ?></label>
                                <input type="number" name="limite"  class="form-control <?php echo e($errors->has('limite') ? "is-invalid":""); ?>" step="0.01" required>
                
                                <?php if($errors->has('limite')): ?>
                                    <span class="error invalid-feedback"><?php echo e($errors->first('limite')); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success float-right"><?php echo app('translator')->get('global.save'); ?></button>
                                <a href="<?php echo e(route('userIndex')); ?>" class="btn btn-default float-left"><?php echo app('translator')->get('global.cancel'); ?></a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Laravel-8-RBAC-AdminLte3\resources\views/pages/taxas/add.blade.php ENDPATH**/ ?>