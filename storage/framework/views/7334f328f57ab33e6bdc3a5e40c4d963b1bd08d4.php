

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
            <div class="row">
                <div class="col-lg-10 offset-lg-1 col-sm-12">
                <div class="card card-primary card-outline">
          <div class="card-header">
                <div class="ribbon-wrapper ribbon-xl">
                    <?php if($contrato->status =='Aprovado'): ?> 
                        <div class="ribbon bg-success text-xl">
                            <?php echo e($contrato->status); ?>

                        </div>
                    <?php elseif($contrato->status =='Reprovado' || $contrato->status =='Mesa de Análise'): ?>
                        <div class="ribbon bg-danger text-lg">
                            <?php echo e($contrato->status); ?>

                        </div>
                    <?php else: ?>  
                        <div class="ribbon bg-warning text-lg">
                            <?php echo e($contrato->status); ?>

                        </div>   
                    <?php endif; ?>
                </div>
            <h3 class="card-title">
              <i class="fas fa-edit"></i>
              <b>CONTRATO - <?php echo e($contrato->id); ?></b>
            </h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-5 col-sm-3">
                <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                  <a class="nav-link active" id="vert-tabs-contrato-tab" data-toggle="pill" href="#vert-tabs-contrato" role="tab" aria-controls="vert-tabs-contrato" aria-selected="true">Dados da Locação</a>
                  <a class="nav-link" id="vert-tabs-cliente-tab" data-toggle="pill" href="#vert-tabs-cliente" role="tab" aria-controls="vert-tabs-cliente" aria-selected="false">Dados do Inquilino</a>
                  <a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill" href="#vert-tabs-messages" role="tab" aria-controls="vert-tabs-messages" aria-selected="false">Coninquilino</a>
                  <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill" href="#vert-tabs-settings" role="tab" aria-controls="vert-tabs-settings" aria-selected="false">Settings</a>
                </div>
              </div>
              <div class="col-7 col-sm-9">
                <div class="tab-content" id="vert-tabs-tabContent">
                  <div class="tab-pane text-left fade active show" id="vert-tabs-contrato" role="tabpanel" aria-labelledby="vert-tabs-contrato-tab">
                    <table class="table table-hover text-nowrap">
                        <tbody>
                            <tr>
                                <td style='width: 30%;'><b>Tipo de Imóvel:</b></td>
                                <td><?php echo e($contrato->tipo_imovel); ?></td>
                            </tr>
                            <tr>
                                <td><b>Valor Locatício:</b></td>
                                <td>R$ <?php echo e($contrato->valor_locaticio); ?></td>
                            </tr>
                            <tr>
                                <td><b>Nome Serviço:</b></td>
                                <td><?php echo e($contrato->plano->nome); ?></td>
                            </tr>
                            <tr>
                                <td><b>Total Serviço:</b></td>
                                <td>R$ <?php echo e($contrato->valor_plano); ?> anual</td>
                            </tr>
                            <tr>
                                <td><b>Valor taxa SETUP:</b></td>
                                <td>R$ <?php echo e($contrato->taxa->valor); ?>  anual</td>
                            </tr>
                            <tr>
                                <td><b>CEP:</b></td>
                                <td><?php echo e($contrato->cep); ?></td>
                            </tr>
                            <tr>
                                <td><b>Endereço/Número:</b></td>
                                <td><?php echo e($contrato->rua); ?>-<?php echo e($contrato->numero); ?></td>
                            </tr>
                            <tr>
                                <td><b>Bairro:</b></td>
                                <td><?php echo e($contrato->bairro); ?></td>
                            </tr>
                            <tr>
                                <td><b>Cidade/UF:</b></td>
                                <td><?php echo e($contrato->cidade); ?>/<?php echo e($contrato->estado); ?></td>
                            </tr>
                            <tr>
                                <td><b>Complemento:</b></td>
                                <td><?php echo e($contrato->complemento); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="vert-tabs-cliente" role="tabpanel" aria-labelledby="vert-tabs-cliente-tab">
                    <table class="table table-hover text-nowrap">
                        <tbody>
                            <tr>
                                <td style='width: 30%;'><b>Nome:</b></td>
                                <td><?php echo e($contrato->cliente->nome); ?></td>
                            </tr>
                            <tr>
                                <td><b>CPF:</b></td>
                                <td><?php echo e($contrato->cliente->cpf); ?></td>
                            </tr>
                            <tr>
                                <td><b>Dara Nascimento:</b></td>
                                <td><?php echo e(date( 'd/m/Y' , strtotime($contrato->cliente->data_nasc))); ?></td>
                            </tr>
                            <tr>
                                <td><b>E-mail</b></td>
                                <td><?php echo e($contrato->cliente->email); ?></td>
                            </tr>
                            <tr>
                                <td><b>Telefone:</b></td>
                                <td><?php echo e($contrato->cliente->telefone); ?></td>
                            </tr>
                            <tr>
                                <td><b>Telefone Contato:</b></td>
                                <td><?php echo e($contrato->cliente->telefone_contato); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                  <div class="tab-pane fade" id="vert-tabs-messages" role="tabpanel" aria-labelledby="vert-tabs-messages-tab">
                     Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
                  </div>
                  <div class="tab-pane fade" id="vert-tabs-settings" role="tabpanel" aria-labelledby="vert-tabs-settings-tab">
                     Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
                  </div>
                </div>
              </div>
            </div>

   
          </div>
          <!-- /.card -->
        </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\LocarMaisNovo\resources\views/cadastro/imovel/show.blade.php ENDPATH**/ ?>