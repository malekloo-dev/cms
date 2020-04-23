<?php $__env->startSection('content'); ?>
    <div class="content-control">
        <ul class="breadcrumb">
            <li><a class="text-18">Bot List</a></li>
        </ul>

        <a id="createBot" href="<?php echo e(route('bots.create')); ?>" class="top-heading-button btn btn-warning btn-icon mat-elevation-z radius-all mat-button pos-abs">
            <i class="fa fa-plus"></i> Create New Bot
        </a>
    </div>
    <div class="content-body">
        <div class="row bot-container">
            <?php $__currentLoopData = $bots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-4">
                    <div class="panel panel-default mat-elevation-z">
                        <div class="panel-body full-height no-padding height-100 pos-rel overflow-hide">
                            <a href="<?php echo e(route('questions.show' , $bot->id)); ?>" class="bot-name-holder disBlock full-width full-height padding-full text-18 text-danger"><?php echo e($bot['name']); ?></a>
                            <form class="deleteForm" action="<?php echo e(route('bots.destroy', $bot->id)); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button class="delete-btn circle-btn-icon btn btn-danger mat-elevation-z radius-all mat-button pos-abs bottom-half text-18 right-half" type="submit"><i class="fa fa-trash"></i></button>
                            </form>

                            <div class="material-toggle pos-abs">
                                <input type="checkbox" data-botid="<?php echo e($bot->id); ?>" id="toggle_<?php echo e($bot->id); ?>" <?php echo e($bot->status ? 'checked' : ''); ?> name="toggle" class="switch">
                                <label for="toggle_<?php echo e($bot->id); ?>" class=""></label>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <div id="createBotModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header no-border">
                    <h4 class="modal-title text-danger" id="gridSystemModalLabel">Create New Bot</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" placeholder="name">
                    </div>
                </div>
                <div class="modal-footer no-border">
                    <button type="button" class="btn btn-link text-danger" data-dismiss="modal">Close</button>
                    <button type="button" class="save-bot btn btn-success radius-all mat-button mat-elevation-z">Save</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script>
        $(function() {
            var $body = $('body'),
                $botContainer = $body.find('.bot-container');

            $body.on('change', '.switch', function() {
                var $this = $(this),
                    botName = $this.parents('.panel-body').find('.bot-name-holder').text();

                if ($this.is(':checked')) {
                    $body.find('.switch').prop('checked', false);

                    $this.prop('checked', true);
                }

                var data = [];
                $body.find('.switch').each(function() {
                    var botId = $(this).data('botid'),
                        checked = $(this).is(':checked') ? '1' : '0';

                    var obj = {
                        botId: botId,
                        status: checked
                    };

                    console.log(obj);

                    data.push(obj);
                });

                $.httpRequest('/api/bots/update/ajax', 'post', JSON.stringify(data), true).then(function(res) {
                    var result = JSON.parse(res);

                    if (result.result) {
                        $.iziSuccess('', botName + ' was ' + ($this.is(':checked') ? 'enabled' : 'disabled'));
                    }
                });
            });

            $body.on('click', '#createBot', function(e) {
                e.preventDefault();

                $body.find('#createBotModal').modal('show');

                setTimeout(function() {
                    $body.find('#name').focus();
                }, 500);
            });

            $body.on('keydown', '#name', function (e) {
                var keyCode = e.which ? e.which : e.keyCode;

                if (keyCode === 13) {
                    $body.find('.save-bot').trigger('click');
                }
            });

            $body.on('click', '.save-bot', function(e) {
                e.preventDefault();

                var $name = $('#name');

                if ($name.val().length < 2) {

                    $name.parent().addClass('has-error');

                    $.iziWarning('', 'Please fill name field');

                    return;
                } else {
                    $name.parent().removeClass('has-error');
                }

                var data = {name: $name.val(), status: 0};

                $.httpRequest('/api/bots/add/ajax', 'post', JSON.stringify(data), true).then(function(res) {
                    var result = JSON.parse(res),
                        html = [
                        '<div class="col-xs-12 col-sm-6 col-md-3 col-lg-4">',
                        '   <div class="panel panel-default mat-elevation-z">',
                        '       <div class="panel-body full-height no-padding height-100 pos-rel overflow-hide">',
                        '           <a href="<?php echo e(url('')); ?>/questions/'+ result.bot_id +'" class="bot-name-holder disBlock full-width full-height padding-full text-18 text-danger">'+ $name.val() +'</a>',
                        '           <form class="deleteForm" action="<?php echo e(url('')); ?>/bots/'+ result.bot_id +'" method="post">',
                        '               <?php echo csrf_field(); ?>',
                        '               <?php echo method_field("DELETE"); ?>',
                        '               <button class="delete-btn circle-btn-icon btn btn-danger mat-elevation-z radius-all mat-button pos-abs bottom-half text-18 right-half" type="submit"><i class="fa fa-trash"></i></button>',
                        '           </form>',
                        '           <div class="material-toggle pos-abs">',
                        '               <input type="checkbox" data-botid="'+ result.bot_id +'" id="toggle_'+ result.bot_id +'" name="toggle" class="switch">',
                        '               <label for="toggle_'+ result.bot_id +'"></label>',
                        '           </div>',
                        '       </div>',
                        '   </div>',
                        '</div>'
                    ].join('');

                    if (result.result) {
                        $.iziSuccess('', 'Bot Created');

                        $body.find('#createBotModal').modal('hide');

                        $botContainer.append(html);

                        $name.val('');
                    } else {
                        $.iziWarning('', 'Something went wrong, please try later.');
                    }
                });
            });

            $body.on('click', '.delete-btn', function(e) {
                e.preventDefault();

                var $form = $(this).parent('.deleteForm');

                $.iziQuestionDelete('Warning', 'Are you sure want to delete this bot?').then(function(res) {
                    if (res) {
                        $form.submit();
                    }
                });
            });
        });
    </script>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH O:\xampp\htdocs\live-chat\resources\views/bots/index.blade.php ENDPATH**/ ?>