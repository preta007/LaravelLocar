

<?php $__env->startSection('content'); ?>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><?php echo app('translator')->get('panel.gestao.title'); ?></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo app('translator')->get('global.home'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo app('translator')->get('cruds.plano.title'); ?></li>
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
                            <h3 class="card-title"><?php echo app('translator')->get('panel.gestao.contrato'); ?></h3>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('plano.add')): ?>
                            <a href="<?php echo e(route('planoAdd')); ?>" class="btn btn-success btn-sm float-right">
                            <span class="fas fa-plus-circle"></span>
                                <?php echo app('translator')->get('global.add'); ?>
                            </a>
                            <?php endif; ?>
                        </div>
                        <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th><?php echo app('translator')->get('panel.gestao.id'); ?></th>
                    <th><?php echo app('translator')->get('panel.gestao.nome'); ?></th>
                    <th><?php echo app('translator')->get('panel.gestao.aluguel'); ?></th>
                    <th><?php echo app('translator')->get('panel.gestao.telefone'); ?></th>
                    <th><?php echo app('translator')->get('panel.gestao.registro'); ?></th>
                    <th><?php echo app('translator')->get('panel.gestao.pagamento'); ?></th>
                    <th><?php echo app('translator')->get('panel.gestao.status'); ?></th>
                    <th><?php echo app('translator')->get('panel.gestao.acao'); ?></th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $__currentLoopData = $contratos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contrato): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($contrato->id); ?></td>
                            <td><?php echo e($contrato->cliente->nome); ?></td>
                            <td><?php echo e($contrato->valor_locaticio); ?></td>
                            <td><?php echo e($contrato->cliente->telefone); ?></td>
                            <td><?php echo e(date('d-m-Y H:i', strtotime($contrato->created_at))); ?></td>
                            <td><?php echo e(date('d-m-Y H:i', strtotime($contrato->created_at))); ?></td>
                            <td>
                                <?php if($contrato->status =='Aprovado'): ?> 
                                    <button type="button" class="btn btn-block btn-success"><?php echo e($contrato->status); ?></button>
                                <?php elseif($contrato->status =='Reprovado' || $contrato->status =='Mesa de Análise'): ?>
                                    <button type="button" class="btn btn-block btn-danger"><?php echo e($contrato->status); ?></button> 
                                <?php else: ?> 
                                    <button type="button" class="btn btn-block btn-warning"><?php echo e($contrato->status); ?></button>  
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="<?php echo e(route('contratoShow',$contrato->id)); ?>" type="button" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                                    <a href="<?php echo e(route('planoAdd')); ?>" type="button" class="btn btn-info btn-sm"><i class="fa fa-pen"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
                  
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "order": [[ 3, "desc" ]],
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\LocarMaisNovo\resources\views/gestao/contrato/show.blade.php ENDPATH**/ ?>