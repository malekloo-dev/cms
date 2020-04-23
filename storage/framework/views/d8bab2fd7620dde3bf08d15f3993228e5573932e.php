

<!-- section header -->
<header class="header bg-white text-black mat-elevation-z3">
    <!-- header-profile -->
    <div class="header-profile pull-right">
        <div class="profile-nav">
            <?php if(auth()->guard()->check()): ?>
            <a  class="dropdown-toggle" data-toggle="dropdown">
                <span class="profile-username disBlock pull-left">
                    <img class="img-circle mat-elevation-z4" src="<?php echo e(asset('img/profile-placeholder.jpg')); ?>" alt="">
                </span>
            </a>
            <ul class="dropdown-menu animated fadeInDown pull-right mat-elevation-z4" role="menu">
                <li><a class="text-left left"><?php echo e(Auth::user()->name); ?></a></li>
                <li>
                    <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <?php echo e(__('Logout')); ?>

                    </a>

                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                        <?php echo csrf_field(); ?>
                    </form>
                </li>
            </ul>
            <?php endif; ?>
        </div>
    </div><!-- header-profile -->

    <!-- header brand -->
    <div class="header-brand">
        <a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(asset('img/abatalk-logo.svg')); ?>" class="liveChatLogo pull-left"></a>
    </div>

    <a id="toggleSideBar"><i class="fa fa-bars"></i></a>

</header><!--/header--><?php /**PATH O:\xampp\htdocs\live-chat\resources\views/nav.blade.php ENDPATH**/ ?>