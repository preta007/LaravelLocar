

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
                            <li class="breadcrumb-item active"><?php echo app('translator')->get('cruds.taxa.title'); ?></li>
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
                            <h3 class="card-title"><?php echo app('translator')->get('cruds.taxa.title_singular'); ?></h3>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('taxa.add')): ?>
                            <a href="<?php echo e(route('taxaAdd')); ?>" class="btn btn-success btn-sm float-right">
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
                                    <th><?php echo app('translator')->get('cruds.taxa.fields.id'); ?></th>
                                    <th><?php echo app('translator')->get('cruds.taxa.fields.name'); ?></th>
                                    <th><?php echo app('translator')->get('cruds.taxa.fields.valor'); ?></th>
                                    <th><?php echo app('translator')->get('cruds.taxa.fields.parcelas'); ?></th>
                                    <th><?php echo app('translator')->get('cruds.taxa.fields.comissao'); ?></th>
                                    <th><?php echo app('translator')->get('cruds.taxa.fields.status'); ?></th>
                                    <th class="w-25"><?php echo app('translator')->get('global.actions'); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $taxas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taxa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($taxa->id); ?></td>
                                        <td><?php echo e($taxa->nome); ?></td>
                                        <td><?php echo e($taxa->valor); ?></td>
                                        <td><?php echo e($taxa->parcelas); ?></td>
                                        <td><?php echo e($taxa->comissao); ?></td>
                                        <td class="text-center">
                                            <i style="cursor: pointer" id="taxa_<?php echo e($taxa->id); ?>" class="fas <?php echo e($taxa->ativo ? "fa-check-circle text-success":"fa-times-circle text-danger"); ?>"
                                               <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('taxa.edit')): ?> onclick="toggle_api_taxa(<?php echo e($taxa->id); ?>)" <?php endif; ?> ></i>
                                        </td>
                                        <td class="text-center">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('taxa.delete')): ?>
                                            <form action="<?php echo e(route('taxaDestroy',$taxa->id)); ?>" method="post">
                                                <?php echo csrf_field(); ?>
                                                <div class="btn-group">
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('taxa.edit')): ?>
                                                        <a href="<?php echo e(route('taxaEdit',$taxa->id)); ?>" type="button" class="btn btn-info btn-sm"> <?php echo app('translator')->get('global.edit'); ?></a>
                                                    <?php endif; ?>
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="if (confirm('Tem certeza?')) { this.form.submit() } "> <?php echo app('translator')->get('global.delete'); ?></button>
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
<?php $__env->startSection('scripts'); ?>
    <script>
        function toggle_api_taxa(id){
            $.ajax({
                url: "/api/api-taxa/toggle-status/"+id,
                type: "POST",
                data:{
                    _token: '<?php echo auth()->user()->password; ?>'
                },
                dataType: "JSON",
                success: function(result){
                    if (result.ativo == 1){
                        $('#taxa_'+id).attr('class',"fas fa-check-circle text-success");
                    }else{
                        $('#taxa_'+id).attr('class',"fas fa-times-circle text-danger");
                    }

                },
                error: function (errorMessage){
                    console.log(errorMessage)
                }
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\LocarMaisNovo\resources\views/gestao/taxas/index.blade.php ENDPATH**/ ?>