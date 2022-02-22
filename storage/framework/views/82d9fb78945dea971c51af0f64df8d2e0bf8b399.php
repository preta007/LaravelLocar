<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="<?php echo e(asset('plugins/fontawesome-free/css/all.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('dist/css/adminlte.min.css')); ?>">
		<!-- Ionicons -->
		<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="<?php echo e(asset('plugins/bootstrap_my/my_style.css')); ?>">
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

		<title><?php echo app('translator')->get('panel.site_title'); ?></title>
</head>
<body>
<div class="loader">
    <div class="loader-in">
        <div class="innerx one"></div>
        <div class="innerx two"></div>
        <div class="innerx three"></div>
    </div>
</div>
    <div id="app" style="display: none">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                    <?php echo app('translator')->get('panel.site_title'); ?>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php echo e(__('Toggle navigation')); ?>">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <?php if(auth()->guard()->guest()): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo app('translator')->get('global.login'); ?></a>
														</li>
                            <?php if(Route::has('register')): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo app('translator')->get('global.register'); ?></a>
                                </li>
                            <?php endif; ?>
                        <?php else: ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="#" role="button">
                                    <?php echo e(Auth::user()->name); ?>

                                </a>
                            </li>
                            <li class="nav-item">
                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                    <?php echo csrf_field(); ?>
                                </form>
                                <a href="#" class="nav-link" role="button" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><?php echo app('translator')->get('global.logout'); ?> <span class="fas fa-close"></span></a>
                            </li>
                        <?php endif; ?>
                        <div class="sl-nav">
                            <i class="sl-flag flag-<?php echo e(App::getLocale('locale')); ?>"></i>
                            <ul>
                                <li class="nav-link" style="padding-left: 0"><?php echo e(strtoupper(App::getLocale('locale'))); ?>

                                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                                    <div class="triangle"></div>
                                    <ul>
                                        <li><a href="language/uz"><i class="sl-flag flag-uz"><div id="uzbek"></div></i> <span class="active">Uz</span></a></li>
                                        <li><a href="language/ru"><i class="sl-flag flag-ru"><div id="russian"></div></i> <span>Ru</span></a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>
</body>
</html>
<script src="<?php echo e(asset('plugins/jquery/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bootstrap_my/myScripts.js')); ?>" type="text/javascript"></script>
<script>
    $(window).on('load', function() {
        preloader();
    });
</script>
<?php /**PATH C:\xampp\htdocs\Laravel-8-RBAC-AdminLte3\resources\views/layouts/app.blade.php ENDPATH**/ ?>