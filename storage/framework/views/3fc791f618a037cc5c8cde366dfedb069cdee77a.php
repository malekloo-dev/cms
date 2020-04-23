<?php $__env->startSection('Content'); ?>

    <?php
        $tableOfImages=tableOfImages($detail->description);
        $append='';
    ?>
<script type="application/ld+json">

<?php if(count($relatedProduct)): ?>
[
   <?php $__currentLoopData = $relatedProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        {
            "@context": "https://schema.org/",
            "@type": "Product",
            "name": "<?php echo e($content->title); ?>",

            <?php if(isset($content->images['thumb'])): ?>
                "image": [
                    "<?php echo e($content->images['images']['300']); ?>",
                    "<?php echo e($content->images['images']['600']); ?>",
                    "<?php echo e($content->images['images']['900']); ?>"
                ],
            <?php endif; ?>

            "description": "<?php echo e($content->brief_description); ?>",
            "sku": "<?php echo e($content->id); ?>",
            "mpn": "<?php echo e($content->id); ?>",
            "brand":
            {
                "@type": "Brand",
                "name": "<?php echo e($detail->brand); ?>"
            },

            "aggregateRating":
            {
                "@type": "AggregateRating",
                "ratingValue": <?php echo e($content->attr['rate']); ?>,
                "reviewCount": <?php echo e($content->viewCount); ?>,
                "bestRating": 5,
                "worstRating": 0
            },
            "offers":
            {
                "@type": "Offer",
                "url": "<?php echo e(url()->current().$content->slug); ?>",
                "priceCurrency": "IRR",
                "price": "<?php echo e($content->attr['price']??"0"); ?>",
                "itemCondition": "https://schema.org/UsedCondition",
                "availability": "https://schema.org/InStock",
                "seller":
                {
                    "@type": "Organization",
                    "name": "ایران ریموت"
                }
            }
        }
        <?php if(isset($relatedProduct[$key+1])): ?>
            <?php echo e(","); ?>

        <?php endif; ?>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

]
<?php endif; ?>
</script>

    <?php if(count($breadcrumb)): ?>

        <section class="" id="">
            <div class="flex one ">
                <div>
                    <div class="shadow ">
                        <a class="button" href="/">iran remote</a>

                        <?php $__currentLoopData = $breadcrumb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <a class="button" href="<?php echo e($item['slug']); ?>"><?php echo e($item['title']); ?></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if(count($subCategory)): ?>
        <section class="products" id="index-best-view">
            <div class="flex one ">
                <div>
                    <div class="shadow">
                        <h2>زیر دسته های <?php echo e($detail->title); ?></h2>
                        <div class="flex one two-500 four-900 center ">

                            
                            <?php $__currentLoopData = $subCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
    <?php endif; ?>

    <?php if(count($relatedProduct)): ?>
        <section class="products" id="index-best-view">
            <div class="flex one ">
                <div>
                    <div class="shadow">
                        <h2>محصولات زیر مجموعه <?php echo e($detail->title); ?></h2>
                        <div class="flex one two-500 four-900 center ">

                            
                            <?php $__currentLoopData = $relatedProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
    <?php endif; ?>

    <?php if(count($relatedPost)): ?>
        <section class="products" id="index-best-view">
            <div class="flex one ">
                <div>
                    <div class="shadow">
                        <h2>مقاله های زیر مجموعه <?php echo e($detail->title); ?></h2>
                        <div class="flex one two-500 four-900 center ">

                            
                            <?php $__currentLoopData = $relatedPost; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
    <?php endif; ?>


    <section class="" id="">
        <div class="flex one ">
            <div>

                <div class="shadow ">
                    <h1 class=""><?php echo e($detail->title); ?></h1>
                    <?php echo $detail->description; ?>

                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('cms.App', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH O:\xampp\htdocs\live-chat\resources\views/cms/DetailCategory.blade.php ENDPATH**/ ?>