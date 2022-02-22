

<?php $__env->startSection('content'); ?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo app('translator')->get('cruds.contrato.title'); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo app('translator')->get('global.home'); ?></a></li>
                        <li class="breadcrumb-item"><a href="<?php echo e(route('contratoIndex')); ?>"><?php echo app('translator')->get('cruds.contrato.title'); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo app('translator')->get('global.add'); ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->

    <section class="content">
        <div class="row">
            <div class="col-lg-10 offset-lg-1 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo app('translator')->get('global.add'); ?> Cliente</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <form action="<?php echo e(route('planoCreate')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo app('translator')->get('cruds.contrato.fields.cpf'); ?></label>
                                        <input type="text" name="cpf" id="cpf" class="form-control cpf <?php echo e($errors->has('cpf') ? "is-invalid":""); ?>" value="<?php echo e(old('cpf')); ?>" onBlur="toggle_api_spc()" required>
                                        <?php if($errors->has('cpf')): ?>
                                            <span class="error invalid-feedback"><?php echo e($errors->first('cpf')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo app('translator')->get('cruds.contrato.fields.nome'); ?></label>
                                        <input type="text" name="nome" class="form-control <?php echo e($errors->has('nome') ? "is-invalid":""); ?>" value="<?php echo e(old('nome')); ?>" required>
                                        <?php if($errors->has('nome')): ?>
                                            <span class="error invalid-feedback"><?php echo e($errors->first('nome')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo app('translator')->get('cruds.contrato.fields.telefone'); ?></label>
                                        <input type="text" name="telefone" class="form-control telefone <?php echo e($errors->has('telefone') ? "is-invalid":""); ?>" value="<?php echo e(old('telefone')); ?>" required>
                                        <?php if($errors->has('telefone')): ?>
                                            <span class="error invalid-feedback"><?php echo e($errors->first('telefone')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo app('translator')->get('cruds.contrato.fields.email'); ?></label>
                                        <input type="email" name="email" class="form-control <?php echo e($errors->has('email') ? "is-invalid":""); ?>" value="<?php echo e(old('email')); ?>" required>
                                        <?php if($errors->has('email')): ?>
                                            <span class="error invalid-feedback"><?php echo e($errors->first('email')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo app('translator')->get('cruds.contrato.fields.data_nascimento'); ?></label>
                                        <input type="date" name="data_nasc" class="form-control <?php echo e($errors->has('data_nasc') ? "is-invalid":""); ?>" value="<?php echo e(old('data_nasc')); ?>" required>
                                        <?php if($errors->has('data_nasc')): ?>
                                            <span class="error invalid-feedback"><?php echo e($errors->first('data_nasc')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo app('translator')->get('cruds.contrato.fields.tefone_contato'); ?></label>
                                        <input type="text" name="tefone_contato" class="form-control telefone <?php echo e($errors->has('tefone_contato') ? "is-invalid":""); ?>" value="<?php echo e(old('tefone_contato')); ?>" required>
                                        <?php if($errors->has('tefone_contato')): ?>
                                            <span class="error invalid-feedback"><?php echo e($errors->first('tefone_contato')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
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

<?php $__env->startSection('scripts'); ?>
    <script>
        function toggle_api_spc(){
            cpf= document.getElementById("cpf").value;
            $.ajax({
                url: "/api/api-spc/consulta/"+cpf,
                type: "POST",
                data:{
                    _token: '<?php echo auth()->user()->password; ?>'
                },
                dataType: "JSON",
                success: function(result){
                    console.log(result)
                    if (result.ativo == 1){
                        $('#plano_'+id).attr('class',"fas fa-check-circle text-success");
                    }else{
                        $('#plano_'+id).attr('class',"fas fa-times-circle text-danger");
                    }

                },
                error: function (errorMessage){
                    console.log(errorMessage)
                }
            });
        }
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\LocarMaisNovo\resources\views/cadastro/cliente/add.blade.php ENDPATH**/ ?>