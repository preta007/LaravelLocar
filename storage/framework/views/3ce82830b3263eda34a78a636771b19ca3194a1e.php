

<?php $__env->startSection('content'); ?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo app('translator')->get('cruds.contrato.title_imovel'); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo app('translator')->get('global.home'); ?></a></li>
                        <li class="breadcrumb-item"><a href="<?php echo e(route('userIndex')); ?>"><?php echo app('translator')->get('cruds.contrato.title_imovel'); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo app('translator')->get('global.add'); ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->

    <section class="content">
        <div class="col-lg-10 offset-lg-1 col-sm-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="m-0"><b>Cliente</b></h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-6"><b>Nome:</b> <?php echo e($cliente->nome); ?></div>
                        <div class="form-group col-6"><b>Cpf:</b> <?php echo e($cliente->cpf); ?></div>
                    </div>
                </div>
            </div>
        </div>
 
        <div class="col-lg-10 offset-lg-1 col-sm-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="m-0"><b><?php echo app('translator')->get('global.add'); ?> Imovél</b></h5>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="<?php echo e(route('contratoCreateImovel')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="id_cliente" value ='<?php echo e($cliente->id); ?>' >
                        <div class="row">
                            <div class="form-group col-6">
                                <label><?php echo app('translator')->get('cruds.contrato.fields.tipo_imovel'); ?></label>
                                <select name ='tipo_imovel' class="form-control <?php echo e($errors->has('tipo_imovel') ? "is-invalid":""); ?>" required>
                                    <option></option>
                                    <option value='Residencial'>Residencial</option>
                                    <option value='Comercial'>Comercial</option>
                                </select>
                               <?php if($errors->has('tipo_imovel')): ?>
                                    <span class="error invalid-feedback"><?php echo e($errors->first('tipo_imovel')); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-6">
                                <label><?php echo app('translator')->get('cruds.contrato.fields.cep'); ?></label>
                                <input type="numeric" name="cep" id="cep"  class="form-control cep <?php echo e($errors->has('cep') ? "is-invalid":""); ?>" value="<?php echo e(old('cep')); ?>" required>
                                <?php if($errors->has('cep')): ?>
                                    <span class="error invalid-feedback"><?php echo e($errors->first('cep')); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-9">
                                <label><?php echo app('translator')->get('cruds.contrato.fields.rua'); ?></label>
                                <input type="text" name="rua" id="rua" class="form-control <?php echo e($errors->has('rua') ? "is-invalid":""); ?>" value="<?php echo e(old('rua')); ?>" required>
                                <?php if($errors->has('rua')): ?>
                                    <span class="error invalid-feedback"><?php echo e($errors->first('rua')); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-3">
                                <label><?php echo app('translator')->get('cruds.contrato.fields.numero'); ?></label>
                                <input type="text" name="numero" class="form-control <?php echo e($errors->has('numero') ? "is-invalid":""); ?>" value="<?php echo e(old('numero')); ?>" required>
                                <?php if($errors->has('numero')): ?>
                                    <span class="error invalid-feedback"><?php echo e($errors->first('numero')); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label><?php echo app('translator')->get('cruds.contrato.fields.bairro'); ?></label>
                                <input type="text" name="bairro" id="bairro" class="form-control <?php echo e($errors->has('bairro') ? "is-invalid":""); ?>" value="<?php echo e(old('bairro')); ?>" required>
                                <?php if($errors->has('bairro')): ?>
                                    <span class="error invalid-feedback"><?php echo e($errors->first('bairro')); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class=" form-group col-3">
                                <label><?php echo app('translator')->get('cruds.contrato.fields.cidade'); ?></label>
                                <input type="text" name="cidade" id="cidade" class="form-control <?php echo e($errors->has('cidade') ? "is-invalid":""); ?>" value="<?php echo e(old('cidade')); ?>" required>
                                <?php if($errors->has('cidade')): ?>
                                    <span class="error invalid-feedback"><?php echo e($errors->first('cidade')); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-3">
                                <label><?php echo app('translator')->get('cruds.contrato.fields.estado'); ?></label>
                                <input type="text" name="estado" id="estado" class="form-control <?php echo e($errors->has('estado') ? "is-invalid":""); ?>" value="<?php echo e(old('estado')); ?>" required>
                                <?php if($errors->has('estado')): ?>
                                    <span class="error invalid-feedback"><?php echo e($errors->first('estado')); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label><?php echo app('translator')->get('cruds.contrato.fields.complemento'); ?></label>
                                <input type="text" name="complemento" class="form-control <?php echo e($errors->has('complemento') ? "is-invalid":""); ?>" value="<?php echo e(old('complemento')); ?>" >
                                <?php if($errors->has('complemento')): ?>
                                    <span class="error invalid-feedback"><?php echo e($errors->first('complemento')); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class=" form-group col-3">
                                <label><?php echo app('translator')->get('cruds.contrato.fields.valor_locaticio'); ?></label>
                                <input type="text" name="valor_locaticio" class="form-control valor <?php echo e($errors->has('valor_locaticio') ? "is-invalid":""); ?>" value="<?php echo e(old('valor_locaticio')); ?>" required>
                                <?php if($errors->has('valor_locaticio')): ?>
                                    <span class="error invalid-feedback"><?php echo e($errors->first('valor_locaticio')); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-3">
                                <label><?php echo app('translator')->get('cruds.contrato.fields.taxa'); ?></label>
                                <select class="form-control<?php echo e($errors->has('id_taxa') ? "is-invalid":""); ?>" name='id_taxa' required>
                                    <option value=''>Selecione</option>
                                    <?php $__currentLoopData = $taxas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taxa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value='<?php echo e($taxa->id); ?>'><?php echo e($taxa->valor); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php if($errors->has('id_taxa')): ?>
                                    <span class="error invalid-feedback"><?php echo e($errors->first('id_taxa')); ?></span>
                                <?php endif; ?>
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
        
    </section>
<br>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
       $(document).ready(function() {

        function limpa_formulário_cep() {
            // Limpa valores do formulário de cep.
            $("#rua").val("");
            $("#bairro").val("");
            $("#cidade").val("");
            $("#estado").val("");
            $("#ibge").val("");
        }

        //Quando o campo cep perde o foco.
        $("#cep").blur(function() {

            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if(validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    $("#rua").val("...");
                    $("#bairro").val("...");
                    $("#cidade").val("...");
                    $("#estado").val("...");
                    $("#ibge").val("...");

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#rua").val(dados.logradouro);
                            $("#bairro").val(dados.bairro);
                            $("#cidade").val(dados.localidade);
                            $("#estado").val(dados.uf);
                            $("#ibge").val(dados.ibge);
                        } //end if.
                        else {
                            //CEP pesquisado não foi encontrado.
                            limpa_formulário_cep();
                            alert("CEP não encontrado.");
                        }
                    });
                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
            });
        });

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\LocarMaisNovo\resources\views/cadastro/imovel/add.blade.php ENDPATH**/ ?>