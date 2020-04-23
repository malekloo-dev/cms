<?php $__env->startSection('content'); ?>
<?php $__env->startSection('ckeditor'); ?>

    <script>
        /*$(document).ready(function() { $("#parent_id").select2(); });

        $("#parent_id").on("change", function() { $("#parent_id_val").html($("#parent_id").val());});

        $("#parent_id").select2("container").find("ul.select2-choices").sortable({
            containment: 'parent',
            start: function() { $("#parent_id").select2("onSortStart"); },
            update: function() { $("#parent_id").select2("onSortEnd"); }
        });*/


        $(document).ready(function() {

            var $input = $("#parent_id");
            $input.select2();
            $("ul.select2-choices").sortable({
                containment: 'parent'
            });


            /*$("#parent_id").on("change", function() { $("#parent_id_val").html($("#parent_id").val());});
            $("#parent_id").select2("container").find("ul.select2-choices").sortable({
                containment: 'parent',
                start: function() { $("#parent_id").select2("onSortStart"); },
                update: function() { $("#parent_id").select2("onSortEnd"); }
            });*/

        });

        $("#meta_keywords").select2({
            tags:[],
            maximumInputLength: 100
        });



    </script>


    <script src="/ckeditor5/ckeditor.js" > </script>
    <script>
        ClassicEditor
            .create( document.querySelector('#brief_description'),{
                ckfinder: {
                    uploadUrl: "<?php echo e(route('contents.upload', ['_token' => csrf_token() ])); ?>",
                },
                alignment: {
                    options: [ 'left', 'right' ]
                },

                language: {
                    // The UI will be English.
                    ui: 'en',

                    // But the content will be edited in Arabic.
                    content: 'fa'
                },

                /*toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'imageUpload','numberedList' ,'alignment','undo', 'redo','blockQuote' ],
                 blockToolbar: [
                 'paragraph', 'heading1', 'heading2', 'heading3',
                 '|',
                 'blockQuote', 'imageUpload'
                 ,'alignment','undo', 'redo',
                 '|',
                 'bulletedList', 'numberedList',
                 '|'

                 ],*/


                image: {
                    // You need to configure the image toolbar, too, so it uses the new style buttons.
                    toolbar: [ 'imageTextAlternative', '|', 'imageStyle:alignLeft', 'imageStyle:full', 'imageStyle:alignRight','imageStyle:alignCenter' ],

                    styles: [
                        // This option is equal to a situation where no style is applied.
                        'full',

                        // This represents an image aligned to the left.
                        'alignLeft',

                        // This represents an image aligned to the right.
                        'alignRight',
                        'alignCenter'

                    ]
                }
            } )
            .then( editor => {
            window.editor = editor;
        } )

        .catch( err => {
            console.error( err.stack );
        } );

        ClassicEditor
            .create( document.querySelector('#description'),{
                ckfinder: {
                    uploadUrl: "<?php echo e(route('contents.upload', ['_token' => csrf_token() ])); ?>",
                },
                alignment: {
                    options: [ 'left', 'right' ]
                },

                language: {
                    // The UI will be English.
                    ui: 'en',

                    // But the content will be edited in Arabic.
                    content: 'fa'
                },

                /*toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'imageUpload','numberedList' ,'alignment','undo', 'redo','blockQuote' ],
                 blockToolbar: [
                 'paragraph', 'heading1', 'heading2', 'heading3',
                 '|',
                 'blockQuote', 'imageUpload'
                 ,'alignment','undo', 'redo',
                 '|',
                 'bulletedList', 'numberedList',
                 '|'

                 ],*/


                image: {
                    // You need to configure the image toolbar, too, so it uses the new style buttons.
                    toolbar: [ 'imageTextAlternative', '|', 'imageStyle:alignLeft', 'imageStyle:full', 'imageStyle:alignRight','imageStyle:alignCenter' ],

                    styles: [
                        // This option is equal to a situation where no style is applied.
                        'full',

                        // This represents an image aligned to the left.
                        'alignLeft',

                        // This represents an image aligned to the right.
                        'alignRight',
                        'alignCenter'

                    ]
                }
            } )
            .then( editor => {
            window.editor = editor;
        } )

        .catch( err => {
            console.error( err.stack );
        } );
    </script>


<?php $__env->stopSection(); ?>


    <div class="content-control">
        <ul class="breadcrumb">
            <li><a  class="text-18">Add</a></li>
        </ul>
    </div>

    <div class="content-body">
        <div class="panel panel-default mat-elevation-z pos-abs chat-panel bottom-0">
            <div class="panel-body full-height">
                <form action="<?php echo e(route('contents.store')); ?>" method="POST" name="add_content" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="form-group row">
                        <label for="name" class="col-md-12 col-form-label text-md-left">Enter Title:</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="title"
                                   value="<?php echo e(old('title')); ?>" />
                            <span class="text-danger"><?php echo e($errors->first('title')); ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-12 col-form-label text-md-left">Brief Description:</label>
                        <div class="col-md-12">

                            <textarea class="form-control" id="brief_description" name="brief_description"><?php echo e(old('brief_description')); ?></textarea>

                            
                        </div>

                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-12 col-form-label text-md-left">Description:</label>
                        <div class="col-md-12">
                            <textarea class="form-control" id="description" name="description"><?php echo e(old('description')); ?></textarea>

                        </div>

                    </div>



                    <div class="form-group row">
                        <label for="name" class="col-md-12 col-form-label text-md-left">Category</label>
                        <div class="col-md-12">
                            
                                <select id="parent_id"  class="js-example-basic-multiple" name="parent_id[]" multiple="multiple">

                                <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Key => $fields): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($fields['id']); ?>"><?php echo $fields['symbol'].$fields['title']; ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <div id="parent_id_val" class="parent_id_val"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-12 col-form-label text-md-left">meta keywords</label>
                        <div class="col-md-12">
                            <input id="meta_keywords" type="text" name="meta_keywords"
                                   value="<?php echo e(old('meta_keywords')); ?>" />
                        </div>
                    </div>




                    <div class="form-group row">
                        <label for="name" class="col-md-12 col-form-label text-md-left">Publish Date:</label>
                        <div class="col-md-12">
                            <input type="datetime" class="form-control" name="publish_date"
                                   value = "<?php echo e(old('date2',Carbon\Carbon::now()->addDay()->format('Y-m-d'))); ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="images" class="control-label">تصویر مقاله</label>
                            <input type="file" class="form-control" name="images" id="images" placeholder="تصویر مقاله را وارد کنید" value="<?php echo e(old('imageUrl')); ?>">
                        </div>

                    </div>
                    <div class="form-group row">
                        <label for="meta_description" class="col-md-12 col-form-label text-md-left">meta
                            Description:</label>
                        <div class="col-md-12">
                        <textarea class="form-control" id="meta_description" name="meta_description"><?php echo e(old('meta_description')); ?></textarea>
                        </div>
                    </div>


                    <?php if($attr_type=='product'): ?>

                        <div class="form-group row">
                            <label for="brand" class="col-md-12 col-form-label text-md-left">Brand:</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="attr[brand]" value="<?php echo e(old('attr[brand]')); ?>"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-md-12 col-form-label text-md-left">Price:</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="attr[price]" value="<?php echo e(old('attr[price]')); ?>"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="offer_price" class="col-md-12 col-form-label text-md-left">offer_price:</label>

                            <div class="col-md-12">
                                <input type="text" class="form-control" name="attr[offer_price]" value="<?php echo e(old('attr[offer_price]')); ?>"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="alternate_name" class="col-md-12 col-form-label text-md-left">alternate_name:</label>

                            <div class="col-md-12">
                                <input type="text" class="form-control" name="attr[alternate_name]" value="<?php echo e(old('attr[alternate_name]')); ?>"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="rate" class="col-md-12 col-form-label text-md-left">rate:</label>

                            <div class="col-md-12">
                                <input type="text" class="form-control" name="attr[rate]" value="<?php echo e(old('attr[rate]')); ?>"/>
                            </div>
                        </div>
                    <?php endif; ?>



                    <div class="form-group row">
                        <label for="name" class="col-md-12 col-form-label text-md-left">Status:</label>
                        <div class="col-md-12">
                            <select class="form-control" name="status" >
                                <option value="1">فعال</option>
                                <option value="0">غیر فعال</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="attr_type" value="<?php echo e($attr_type); ?>">

                    <button type="submit" class="btn btn-success pull-right mat-btn radius-all  mat-elevation-z">Add Content</button>
                    <a href="<?php echo e(old('publish_date')); ?>" class="link ">
                        <i class="fa fa-arrow-left"></i> Back to List
                    </a>
                </form>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>


<span class="text-danger"><?php echo e($errors->first('brief_description')); ?></span>
<span class="text-danger"><?php echo e($errors->first('description')); ?></span>
<span class="text-danger"><?php echo e($errors->first('status')); ?></span>
<span class="text-danger"><?php echo e($errors->first('publish_date')); ?></span>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH O:\xampp\htdocs\live-chat\resources\views/content/create.blade.php ENDPATH**/ ?>