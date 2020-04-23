<?php echo $__env->make('head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


        <div class="container" style="margin-top: 50px">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 center-block">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </div>
        </div>





<?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH O:\xampp\htdocs\live-chat\resources\views/layouts/login.blade.php ENDPATH**/ ?>