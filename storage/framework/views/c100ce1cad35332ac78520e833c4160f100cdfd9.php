<?php $__env->startSection('Content'); ?>

    <section class="products" id="index-best">
        <div class="flex one">
            <div>
                <div class="shadow">
                    <h2>پر بازدیدترین مطالب در مورد سوئیچ و ریموت خودرو</h2>
                    <div class="flex one two-500 four-900 center ">

                        
                        <?php $__currentLoopData = $topViewPost; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div>
                                <article>
                                    <?php if(isset($content->images['thumb'])): ?>
                                        <div><img src="<?php echo e($content->images['thumb']); ?>"></div>
                                    <?php endif; ?>
                                    <footer>
                                        <h2><a href="<?php echo e($content->slug); ?>"> <?php echo e($content->title); ?></a></h2>
                                        <?php echo $content->brief_description; ?>

                                    </footer>
                                </article>
                            </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="wide" id="index-comment">
        <div>جدید ترین مطالب در مورد سوئیچ و ریموت خودرو</div>
    </section>
    <section class="products" id="index-best-view">
        <div class="flex one ">
            <div>
                <div class="shadow">
                    <h2>جدید ترین مطالب در مورد سوئیچ و ریموت خودرو</h2>
                    <div class="flex one two-500 four-900 center ">

                        
                        <?php $__currentLoopData = $newPost; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div>
                                <article>

                                    <?php if(isset($content->images['thumb'])): ?>
                                        <div><img src="<?php echo e($content->images['thumb']); ?>"></div>
                                    <?php endif; ?>
                                    <footer>
                                        <h2><a href="<?php echo e($content->slug); ?>"> <?php echo e($content->title); ?></a></h2>
                                        <?php echo $content->brief_description; ?>

                                    </footer>
                                </article>
                            </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('cms.App', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH O:\xampp\htdocs\live-chat\resources\views/cms/Home.blade.php ENDPATH**/ ?>