<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>LiveChat</title>

    <!-- Fonts -->
    
    <!-- Styles -->
    <link href="<?php echo e(asset('css/animate.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/jquery-ui.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/bootstrap-theme.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/font-awesome.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/dependencies.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/helper.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/iziToast.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/fancy.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/iziToast.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/responsive.css')); ?>" rel="stylesheet">

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/jquery.min.js')); ?>" ></script>
    <script src="<?php echo e(asset('js/jquery-ui.min.js')); ?>" ></script>
    <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>" ></script>
    <script src="<?php echo e(asset('js/demo-setup.js')); ?>" ></script>
    <script src="<?php echo e(asset('js/dependencies-setup.js')); ?>" ></script>
    <script src="<?php echo e(asset('js/iziToast.min.js')); ?>" ></script>
    <script src="<?php echo e(asset('js/jquery.bootstrap-growl.min.js')); ?>" ></script>
    <script src="<?php echo e(asset('js/jquery.multi-select.js')); ?>" ></script>
    <script src="<?php echo e(asset('js/jquery.validate.min.js')); ?>" ></script>
    <script src="<?php echo e(asset('js/panel-setup.js')); ?>" ></script>
    <script src="<?php echo e(asset('js/select2.min.js')); ?>" ></script>
    <script src="<?php echo e(asset('js/theme-setup.js')); ?>" ></script>
    <script src="<?php echo e(asset('js/fancy.min.js')); ?>" ></script>
    <script src="<?php echo e(asset('js/iziToast.min.js')); ?>" ></script>
    <script src="<?php echo e(asset('js/iziToast-custom.js')); ?>" ></script>
    <script src="<?php echo e(asset('js/scripts.js')); ?>" ></script>


    <script>
        $(function () {
            /* essential functions */
            $.httpRequest = function (url, method, data, isJson) {
                var option = {
                    url: url,
                    headers:  {'X-CSRF-TOKEN': $('html').find('meta[name="csrf-token"]').attr('content')}
                };

                if (method !== undefined && method !== null && method !== '') {
                    option.method = method;
                }

                if (data !== undefined && data !== null && data !== '') {
                    option.data = data;
                }

                if (isJson !== undefined && isJson === true) {
                    option.contentType = "application/json; charset=utf-8";
                }

                return $.ajax(option);
            };
        });
    </script>
</head>
<body>
<div class="overlay pos-fix right-0 top-0 bottom-0 left-0"></div>

<?php /**PATH O:\xampp\htdocs\live-chat\resources\views/head.blade.php ENDPATH**/ ?>