<?php $__env->startSection('Content'); ?>
    <?php
        $tableOfImages=tableOfImages($detail->description);
        $append='';
    ?>

    <?php if($detail->attr_type=='product'): ?>

    <script type="application/ld+json">
    {
        "@context": "https://schema.org/",
        "@type": "Product",
        "name": "<?php echo e($detail->title); ?>",

        <?php if(isset($detail->images['thumb'])): ?>
            "image": [
                "<?php echo e($detail->images['images']['300']); ?>",
                "<?php echo e($detail->images['images']['600']); ?>",
                "<?php echo e($detail->images['images']['900']); ?>"
            ],
        <?php endif; ?>
        <?php if(count($tableOfImages)): ?>

            "images": [

                <?php $__currentLoopData = $tableOfImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    {
                    "type": "gallery",
                    "url": "<?php echo e($item['src']); ?>",
                    "alt": "<?php echo e($item['alt']); ?>",
                    "title":"<?php echo e($item['alt']); ?>"

                    }
                    <?php if(isset($tableOfImages[$key+1])): ?>
                        <?php echo e(","); ?>

                    <?php endif; ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            ],
        <?php endif; ?>

        "description": "<?php echo e($detail->description); ?>",
        "sku": "<?php echo e($detail->id); ?>",
        "mpn": "<?php echo e($detail->id); ?>",
        "brand":
        {
            "@type": "Brand",
            "name": "<?php echo e($detail->brand); ?>"
        },

        "aggregateRating":
        {
            "@type": "AggregateRating",
            "ratingValue": <?php echo e($detail->attr['rate']); ?>,
            "reviewCount": <?php echo e($detail->viewCount); ?>,
            "bestRating": 5,
            "worstRating": 0
        },
        "offers":
        {
            "@type": "Offer",
            "url": "<?php echo e(url()->current().$detail->slug); ?>",
            "priceCurrency": "IRR",
            "price": "<?php echo e($detail->attr['price']); ?>",
            "itemCondition": "https://schema.org/UsedCondition",
            "availability": "https://schema.org/InStock",
            "seller":
            {
                "@type": "Organization",
                "name": "ایران ریموت"
            }
        }
    }
    </script>
    <?php endif; ?>

    <section class="" id="">
        <div class="flex one ">
            <div>
                <div class="shadow ">
                    <a class="button"  href="/" >iran remote</a>
                        <?php $__currentLoopData = $breadcrumb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <a class="button"  href="<?php echo e($item['slug']); ?>" ><?php echo e($item['title']); ?></a>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
            </div>
        </div>
    </section>

    <section class="" id="">
        <div class="flex one ">
            <div>
                <div class="shadow ">
                    <h1 class=""><?php echo e($detail->title); ?></h1>

                    <ul>
                        <?php $__currentLoopData = $table_of_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="toc1">
                                <a id="test" href="#<?php echo e($item['anchor']); ?>"><?php echo e($item['label']); ?></a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </ul>
                    <?php echo $detail->description; ?>

                </div>
            </div>
        </div>
    </section>

    <?php if(count($relatedProduct)): ?>
        <section class="products" id="index-best-view">
            <div class="flex one ">
                <div>
                    <div class="shadow">
                        <h2>محصولات مرتبط  <?php echo e($detail->title); ?></h2>
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
                        <h2>مقاله های مرتبط  <?php echo e($detail->title); ?></h2>
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('cms.App', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH O:\xampp\htdocs\live-chat\resources\views/cms/Detail.blade.php ENDPATH**/ ?>