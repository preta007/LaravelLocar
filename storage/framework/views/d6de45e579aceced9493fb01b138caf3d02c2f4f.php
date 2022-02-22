

<?php $__env->startSection('content'); ?>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>API-<?php echo app('translator')->get('cruds.user.title'); ?></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo app('translator')->get('global.home'); ?></a></li>
                            <li class="breadcrumb-item active">API-<?php echo app('translator')->get('cruds.user.title'); ?></li>
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
                            <h3 class="card-title"><?php echo app('translator')->get('cruds.user.title_singular'); ?></h3>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user.add')): ?>
                            <a href="<?php echo e(route('api-userAdd')); ?>" class="btn btn-success btn-sm float-right">
                            <span class="fas fa-plus-circle"></span>
                                <?php echo app('translator')->get('global.add'); ?>
                            </a>
                            <?php endif; ?>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- Data table -->
                            <table id="dataTable" class="table table-bordered table-striped dataTable dtr-inline table-responsive-lg" user="grid" aria-describedby="dataTable_info">
                                <thead>
                                <tr class="text-center">
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Valid period</th>
                                    <th>Created by</th>
                                    <th>Tokens</th>
                                    <th>Activate</th>
                                    <th style="width: 10px"><?php echo app('translator')->get('global.actions'); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="text-center">
                                        <td>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('passport.view')): ?><i class="fa fa-eye" onmousedown="showPassword(<?php echo e($user->id); ?>)" onmouseup="hidePassword(<?php echo e($user->id); ?>)"></i><?php endif; ?>
                                            <?php echo e($user->name); ?>

                                        </td>
                                        <td>
                                            <span style="display: block" id="hidden_<?php echo e($user->id); ?>">*****</span>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('password.view')): ?><span style="display: none" id="password_<?php echo e($user->id); ?>"><?php echo e($user->password); ?></span><?php endif; ?>
                                        </td>
                                        <td><?php echo e($user->token_valid_period); ?></td>
                                        <td><?php echo e($user->creator->name ?? '-'); ?></td>
                                        <td><?php echo e($user->tokens->count() ?? 0); ?></td>
                                        <td class="text-center">
                                            <i style="cursor: pointer" id="api_user_<?php echo e($user->id); ?>" class="fas <?php echo e($user->is_active ? "fa-check-circle text-success":"fa-times-circle text-danger"); ?>"
                                               <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('api-user.edit')): ?> onclick="toggle_api_user(<?php echo e($user->id); ?>)" <?php endif; ?> ></i>
                                        </td>
                                        <td class="text-center">
                                            <form action="<?php echo e(route('api-userDestroy',$user->id)); ?>" method="post">
                                                <?php echo csrf_field(); ?>
                                                <div class="btn-group">
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('api-user.edit')): ?>
                                                        <a href="<?php echo e(route('api-userShow',$user->id)); ?>" type="button" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('api-user.edit')): ?>
                                                    <a href="<?php echo e(route('api-userEdit',$user->id)); ?>" type="button" class="btn btn-info btn-sm"><i class="fa fa-pen"></i></a>
                                                    <?php endif; ?>
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="if (confirm('Вы уверены?')) { this.form.submit() } "><i class="fa fa-trash"></i></button>
                                                </div>
                                            </form>
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
<?php $__env->startSection('scripts'); ?>
    <script>
        function showPassword(id){
            $("#hidden_"+id).hide();
            $("#password_"+id).show();
        }

        function hidePassword(id){
            $("#hidden_"+id).show();
            $("#password_"+id).hide();
        }
        function toggle_api_user(id){
            $.ajax({
                url: "/api/api-user/toggle-status/"+id,
                type: "POST",
                data:{
                    _token: '<?php echo auth()->user()->password; ?>'
                },
                success: function(result){
                    if (result.is_active == 1){
                        $("#api_user_"+id).attr('class',"fas fa-check-circle text-success");
                    }
                    else
                    {
                        $("#api_user_"+id).attr('class',"fas fa-times-circle text-danger");
                    }
                },
                error: function (errorMessage){
                    console.log(errorMessage)
                }
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Laravel-8-RBAC-AdminLte3\resources\views/pages/api-user/index.blade.php ENDPATH**/ ?>