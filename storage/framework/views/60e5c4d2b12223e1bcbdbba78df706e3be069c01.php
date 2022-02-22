

<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo app('translator')->get('cruds.permission.title'); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo app('translator')->get('global.home'); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo app('translator')->get('cruds.permission.title'); ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo app('translator')->get('cruds.permission.title_singular'); ?></h3>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission.add')): ?>
                        <a href="<?php echo e(route('permissionAdd')); ?>" class="btn btn-success btn-sm float-right">
                            <span class="fas fa-plus-circle"></span>
                            <?php echo app('translator')->get('global.add'); ?>
                        </a>
                        <?php endif; ?>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- Data table -->
                        <table id="dataTable" class="table table-bordered table-striped dataTable dtr-inline table-responsive-lg" role="grid" aria-describedby="dataTable_info">
                            <thead>
                            <tr>
                                <th><?php echo app('translator')->get('cruds.permission.fields.id'); ?></th>
                                <th><?php echo app('translator')->get('cruds.permission.fields.name'); ?></th>
                                <th><?php echo app('translator')->get('cruds.permission.fields.title'); ?></th>
                                <th><?php echo app('translator')->get('cruds.permission.fields.roles'); ?></th>
                                <th class="w-25"><?php echo app('translator')->get('global.actions'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($permission->id); ?></td>
                                    <td><?php echo e($permission->name); ?></td>
                                    <td><?php echo e($permission->title); ?></td>
                                    <td>
                                        <?php $__currentLoopData = $permission->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="badge badge-success"><?php echo e($role->name); ?> </span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission.delete')): ?>
                                        <form action="<?php echo e(route('permissionDestroy',$permission->id)); ?>" method="post">
                                            <?php echo csrf_field(); ?>
                                            <div class="btn-group">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission.edit')): ?>
                                                <a href="<?php echo e(route('permissionEdit',$permission->id)); ?>" type="button" class="btn btn-info btn-sm"> <?php echo app('translator')->get('global.edit'); ?></a>
                                                <?php endif; ?>
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button type="button" class="btn btn-danger btn-sm" onclick="if (confirm('Вы уверены?')) {this.form.submit()}"> <?php echo app('translator')->get('global.delete'); ?></button>
                                            </div>
                                        </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\LocarMaisNovo\resources\views/pages/permissions/index.blade.php ENDPATH**/ ?>