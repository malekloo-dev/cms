<?php $__env->startSection('content'); ?>
    <div class="content-control">
        <ul class="breadcrumb">
            <li><a class="text-18">Operators</a></li>
        </ul>


        <a href="<?php echo e(route('contents.create').'?type=article'); ?>"
           class="top-heading-button btn btn-warning btn-icon mat-elevation-z radius-all mat-button ppos-abs">
            <i class="fa fa-plus"></i> Create New Article
        </a>
        <a href="<?php echo e(route('contents.create').'?type=product'); ?>"
           class="top-heading-button btn btn-warning btn-icon mat-elevation-z radius-all mat-button ppos-abs">
            <i class="fa fa-plus"></i> Create New Product
        </a>
    </div>

    <div class="content-body">
        <div class="panel panel-default mat-elevation-z pos-abs chat-panel bottom-0">
            <div class="panel-body full-height">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Brief Description</th>
                        <th>category</th>
                        <th>Status</th>
                        <th>Publish date at</th>
                        <td colspan="2">Action</td>
                    </tr>
                    </thead>
                    <tbody>


                    <?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($content->id); ?></td>
                            <td><?php echo e($content->title); ?></td>
                            <td><?php echo e($content->brief_description); ?></td>
                            <td><?php echo e($category[$content->parent_id]->title); ?></td>
                            <td>
                                <?php if($content->status == 1): ?>
                                    <?php echo e('فعال'); ?>

                                <?php else: ?>
                                    <?php echo e('غیر فعال'); ?>

                                <?php endif; ?>
                                </td>

                            <td><?php echo e(date('Y-m-d', strtotime($content->publish_date))); ?></td>
                            <td class="width-80">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <form class=" width-30 height-30 line-height-30" action="<?php echo e(route('contents.destroy', $content->id)); ?>" method="post">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button class="font-full-plus-half-em text-danger btn-xs pull-left no-border no-bg no-padding" type="submit">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="col-xs-6">
                                        <a href="<?php echo e(route('contents.edit',$content->id)); ?>"
                                           class="font-full-plus-half-em text-success btn-xs pull-left no-border no-bg no-margin no-padding width-30 height-30 line-height-30" title="edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </div>
                                </div>
                            </td>

                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>




   

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH O:\xampp\htdocs\live-chat\resources\views/content/list.blade.php ENDPATH**/ ?>