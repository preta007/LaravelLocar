<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo app('translator')->get('panel.site_title'); ?></title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/fontawesome-free/css/all.min.css')); ?>">

    <!-- Styles -->
    <link rel="stylesheet" href="<?php echo e(asset('dist/css/adminlte.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bootstrap_my/my_style.css')); ?>">
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="wrapper flex-center position-ref full-height">
    <?php if(Route::has('login')): ?>
        <div class="top-right links">
            <?php if(auth()->guard()->check()): ?>
                <div class="sl-nav" style="display: inline">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle link-black"><i class="fas fa-user"></i>
                                <?php echo e(auth()->user()->name); ?>

                            </a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
                                <li>
                                    <a href="<?php echo e(route('userEdit',auth()->user()->id)); ?>" class="dropdown-item">
                                        <i class="fas fa-cogs"></i> <?php echo app('translator')->get('global.settings'); ?>
                                    </a>
                                </li>
                                <li>
                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                        <?php echo csrf_field(); ?>
                                    </form>
                                    <a href="#" class="dropdown-item" role="button" onclick="
                                            event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i> <?php echo app('translator')->get('global.logout'); ?>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            <?php endif; ?>
            <?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(url('/home')); ?>"><?php echo app('translator')->get('global.home'); ?></a>
            <?php else: ?>
                <a href="<?php echo e(route('login')); ?>"><?php echo app('translator')->get('global.login'); ?></a>

                <?php if(Route::has('register')): ?>
                    <a href="<?php echo e(route('register')); ?>"><?php echo app('translator')->get('global.register'); ?></a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <div class="content">
        <div class="title m-b-md">
            <?php echo app('translator')->get('panel.site_title'); ?>
        </div>

    </div>
</div>
</body>
</html>

<script src="<?php echo e(asset('plugins/jquery/jquery.min.js')); ?>"></script>
<script>
    $(window).on('load', function() {
        $(".loader-in").fadeOut();
        $(".loader").delay(150).fadeOut("fast");
        $(".wrapper").fadeIn("fast");
        $("#app").fadeIn("fast");
    });
</script>
<?php /**PATH C:\xampp\htdocs\Laravel-8-RBAC-AdminLte3\resources\views/welcome.blade.php ENDPATH**/ ?>