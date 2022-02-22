
<nav class="mt-2">

    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any('cadastro.show')): ?>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link <?php echo e((Request::is('contrato*')) ? 'active':''); ?>">
                <i class="fas fa-laptop"></i>
                    <p>
                        <?php echo app('translator')->get('cruds.register.title'); ?>
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: <?php echo e((Request::is('contrato*')) ? 'block':'none'); ?>;">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('contrato.show')): ?>
                        <li class="nav-item">
                            <a href="<?php echo e(route('contratoCliente')); ?>" class="nav-link <?php echo e(Request::is('contrato*') ? "active":''); ?>">
                                <i class="fas fa-file-contract"></i>
                                <p> <?php echo app('translator')->get('cruds.contrato.title_singular'); ?></p>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('imobiliaria.show')): ?>
                        <li class="nav-item">
                            <a href="<?php echo e(route('taxaIndex')); ?>" class="nav-link <?php echo e(Request::is('imobiliaria*') ? "active":''); ?>">
                                <i class="fas fa-sign"></i>
                                <p> <?php echo app('translator')->get('cruds.imobiliaria.title_singular'); ?></p>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </li>
    <?php endif; ?>  
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any('manage.show')): ?>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link <?php echo e((Request::is('plano*' || Request::is('taxa*'))) ? 'active':''); ?>">
                    <i class="fas fa-tasks"></i>
                    <p>
                        <?php echo app('translator')->get('cruds.management.title'); ?>
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: <?php echo e((Request::is('plano*')) ? 'block':'none'); ?>;">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('gestao.contrato.show')): ?>
                        <li class="nav-item">
                            <a href="<?php echo e(route('gestaoContratoShow')); ?>" class="nav-link <?php echo e(Request::is('contrato*') ? "active":''); ?>">
                            <i class="fas fa-file-contract"></i>
                                <p>  <?php echo app('translator')->get('cruds.contrato.title_singular'); ?></p>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('plano.show')): ?>
                        <li class="nav-item">
                            <a href="<?php echo e(route('planoIndex')); ?>" class="nav-link <?php echo e(Request::is('plano*') ? "active":''); ?>">
                                <i class="fas fa-star"></i>
                                <p> <?php echo app('translator')->get('cruds.plano.title_singular'); ?></p>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('taxa.show')): ?>
                        <li class="nav-item">
                            <a href="<?php echo e(route('taxaIndex')); ?>" class="nav-link <?php echo e(Request::is('taxa*') ? "active":''); ?>">
                                <i class="fas fa-percentage"></i>
                                <p> <?php echo app('translator')->get('cruds.taxa.title_singular'); ?></p>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user.show')): ?>
                        <li class="nav-item">
                            <a href="<?php echo e(route('userIndex')); ?>" class="nav-link <?php echo e(Request::is('user*') ? "active":''); ?>">
                                <i class="fas fa-user-friends"></i>
                                <p> <?php echo app('translator')->get('cruds.user.title'); ?></p>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </li>
        <?php endif; ?>    
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any([
          'permission.show',
          'roles.show',
          'user.show'
       ])): ?>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link <?php echo e((Request::is('permission*') || Request::is('role*') || Request::is('user*')) ? 'active':''); ?>">
                    <i class="fas fa-users-cog"></i>
                    <p>
                        <?php echo app('translator')->get('cruds.userManagement.title'); ?>
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: <?php echo e((Request::is('permission*') || Request::is('role*') || Request::is('user*')) ? 'block':'none'); ?>;">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission.show')): ?>
                        <li class="nav-item">
                            <a href="<?php echo e(route('permissionIndex')); ?>" class="nav-link <?php echo e(Request::is('permission*') ? "active":''); ?>">
                                <i class="fas fa-key"></i>
                                <p> <?php echo app('translator')->get('cruds.permission.title_singular'); ?></p>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('roles.show')): ?>
                        <li class="nav-item">
                            <a href="<?php echo e(route('roleIndex')); ?>" class="nav-link <?php echo e(Request::is('role*') ? "active":''); ?>">
                                <i class="fas fa-user-lock"></i>
                                <p> <?php echo app('translator')->get('cruds.role.fields.roles'); ?></p>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user.show')): ?>
                        <li class="nav-item">
                            <a href="<?php echo e(route('userIndex')); ?>" class="nav-link <?php echo e(Request::is('user*') ? "active":''); ?>">
                                <i class="fas fa-user-friends"></i>
                                <p> <?php echo app('translator')->get('cruds.user.title'); ?></p>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </li>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('api-user.view')): ?>
            <li class="nav-item">
                <a href="<?php echo e(route('api-userIndex')); ?>" class="nav-link <?php echo e(Request::is('api-users*') ? "active":''); ?>">
                    <i class="fas fa-cog"></i>
                    <sub><i class="fas fa-child"></i></sub>
                    <p> API Users</p>
                </a>
            </li>
        <?php endif; ?>
    </ul>

    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item has-treeview">
            <a href="" class="nav-link">
            <i class="fas fa-palette"></i>
            <p>
                <?php echo app('translator')->get('global.theme'); ?>
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
            <ul class="nav nav-treeview" style="display: none">
                <li class="nav-item">
                    <a href="<?php echo e(route('userSetTheme',[auth()->id(),'theme' => 'default'])); ?>" class="nav-link">
                        <i class="nav-icon fas fa-circle text-info"></i>
                        <p class="text">Default <?php echo e(auth()->user()->theme == 'default' ? '✅':''); ?></p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('userSetTheme',[auth()->id(),'theme' => 'light'])); ?>" class="nav-link">
                        <i class="nav-icon fas fa-circle text-white"></i>
                        <p>Light <?php echo e(auth()->user()->theme == 'light' ? '✅':''); ?></p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('userSetTheme',[auth()->id(),'theme' => 'dark'])); ?>" class="nav-link">
                        <i class="nav-icon fas fa-circle text-gray"></i>
                        <p>Dark <?php echo e(auth()->user()->theme == 'dark' ? '✅':''); ?></p>
                    </a>
                </li>
            </ul>
        </li>
    </ul>



</nav>
<?php /**PATH C:\xampp\htdocs\LocarMaisNovo\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>