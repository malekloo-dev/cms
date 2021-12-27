<label for="jpeg">
    <input type="radio" checked id="jpeg" name="imageJson"
        value="{{ old('imageJson', $content->imageJson ?? ($company->imageJson ?? '')) }}">
    <img height="" src="{{ $cropperPreview ?? '' }}" id="cropperPreview">
</label>



<meta name="_token" content="{{ csrf_token() }}">

<link href="{{ url('/adminAssets/css/cropper.css') }}" rel="stylesheet">
<script src="{{ url('/adminAssets/js/cropper.js') }}"></script>

<style type="text/css">

    label[for=jpeg] {
        display: none
    }

    .modal-cropper img {
        display: block;
        max-width: 300px;
        max-height: 300px;
    }

    .preview {
        overflow: hidden;
        width: {{ env(Str::upper($content->attr_type ?? $attr_type) . '_LARGE_W') }}px;
        height: {{ env(Str::upper($content->attr_type ?? $attr_type) . '_LARGE_H') }}px;
        margin: 10px;
        border: 1px solid red;
    }

    .modal-lg {
        max-width: 1000px !important;
        ??
    }

</style>
<div class="modal fade modal-cropper" style="direction: ltr;" id="modal" tabindex="-1" role="dialog"
    aria-labelledby="modalLabel" aria-hidden="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <div class="row">

                    <div class="col-md-8 col-xs-12" style="">
                        <img id="image" src="">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" data-method="move" data-option="-1"
                                data-second-option="0" title="Move Left">
                                <span class="docs-tooltip" data-toggle="tooltip" title=""
                                    data-original-title="cropper.move(-1, 0)">
                                    <span class="fa fa-arrow-left"></span>
                                </span>
                            </button>
                            <button type="button" class="btn btn-primary" data-method="move" data-option="1"
                                data-second-option="0" title="Move Right">
                                <span class="docs-tooltip" data-toggle="tooltip" title=""
                                    data-original-title="cropper.move(1, 0)">
                                    <span class="fa fa-arrow-right"></span>
                                </span>
                            </button>
                            <button type="button" class="btn btn-primary" data-method="move" data-option="0"
                                data-second-option="-1" title="Move Up">
                                <span class="docs-tooltip" data-toggle="tooltip" title=""
                                    data-original-title="cropper.move(0, -1)">
                                    <span class="fa fa-arrow-up"></span>
                                </span>
                            </button>
                            <button type="button" class="btn btn-primary" data-method="move" data-option="0"
                                data-second-option="1" title="Move Down">
                                <span class="docs-tooltip" data-toggle="tooltip" title=""
                                    data-original-title="cropper.move(0, 1)">
                                    <span class="fa fa-arrow-down"></span>
                                </span>
                            </button>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" data-method="zoom" data-option="0.02"
                                title="Zoom In">
                                <span class="docs-tooltip" data-toggle="tooltip" title=""
                                    data-original-title="cropper.zoom(0.02)">
                                    <span class="fa fa-search-plus"></span>
                                </span>
                            </button>
                            <button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.02"
                                title="Zoom Out">
                                <span class="docs-tooltip" data-toggle="tooltip" title=""
                                    data-original-title="cropper.zoom(-0.02)">
                                    <span class="fa fa-search-minus"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12 hidden-xs" style="">
                        <div class="preview"></div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">

                <button type="button" class="close btn btn-secondary" data-dismiss="modal">@lang('messages.cancel')</button>
                <button type="button" class="btn btn-primary" id="crop">@lang('messages.crop')</button>
            </div>
        </div>
    </div>
</div>
<script>
    var $modal = $('#modal');
    var image = document.getElementById('image');
    var cropper;



    $('button[data-dismiss="modal"]').click(function(){	$(this).parents().modal('hide'); }) ;

    if ($('[name=imageJson]').val() != '')
        $('#cropperPreview').attr('src', $('input[name=imageJson]').val())

    $("body").on("click", "#images", function(e) {
        $(this).val('');
    });

    $("body").on("change", "#images", function(e) {
        console.log(1);
        var files = e.target.files;
        var done = function(url) {
            image.src = url;
            $modal.modal('show');
        };
        var reader;
        var file;
        var url;

        if (files && files.length > 0) {
            file = files[0];

            if (URL) {
                done(URL.createObjectURL(file));
            } else if (FileReader) {
                reader = new FileReader();
                reader.onload = function(e) {
                    done(reader.result);
                };
                reader.readAsDataURL(file);
            }
        }
    });

    $modal.on('shown.bs.modal', function() {

        cropper = new Cropper(image, {
            //   aspectRatio: 1,
            //   viewMode: 3,
            aspectRatio: {{ env(Str::upper($content->attr_type ?? $attr_type) . '_SMALL_W') }} /
                {{ env(Str::upper($content->attr_type ?? $attr_type) . '_SMALL_H') }},
            viewMode: 0,
            preview: '.preview'
        });
    }).on('hidden.bs.modal', function() {
        cropper.destroy();
        cropper = null;
    });

    $("#crop").click(function() {



        canvas = cropper.getCroppedCanvas({
            fillColor: '#ffffff',
            width: {{ env(Str::upper($content->attr_type ?? $attr_type) . '_LARGE_W') }},
            height: {{ env(Str::upper($content->attr_type ?? $attr_type) . '_LARGE_H') }},
            imageSmoothingEnabled: true,
            imageSmoothingQuality: 'high',
        });
        canvasPng = cropper.getCroppedCanvas({
            // fillColor: '#ffffff',
            width: {{ env(Str::upper($content->attr_type ?? $attr_type) . '_LARGE_W') }},
            height: {{ env(Str::upper($content->attr_type ?? $attr_type) . '_LARGE_H') }},
            imageSmoothingEnabled: true,
            imageSmoothingQuality: 'high',
        });
        // console.log(canvas.toDataURL('image/jpeg'));

        canvas.toBlob(function(blob) {

            $('label[for=jpeg]').show();
            $('label[for=png]').show();


            // console.log(blob);
            url = URL.createObjectURL(blob);
            // console.log(url);
            var reader = new FileReader();
            //  console.log(reader);
            reader.readAsDataURL(blob);


            // fileName = $("input[name=title]").val().replace(' ', '-');


            reader.onloadend = function() {
                // console.log(reader);
                var base64data = reader.result;
                $('input[name=imageJson]#jpeg').val(base64data)
                canvasPng.toBlob(function(blob) {
                    url = URL.createObjectURL(blob);
                    var reader = new FileReader();
                    reader.readAsDataURL(blob);
                    reader.onloadend = function() {
                        var base64data = reader.result;
                        $('input[name=imageJson]#png').val(base64data)
                        $('#cropperPreviewPng').attr('src', base64data)
                    };
                });
                $('#cropperPreview').attr('src', base64data)
                $modal.modal('hide');

            }
        }, 'image/png');
    });




    $('button[data-method]').click(function(e) {

        var method = $(this).data('method');
        var option = $(this).data('option');
        if (method == 'move') {
            var second = $(this).data('second-option');
            cropper.move(option, second);
        }
        if(method == 'zoom'){
            cropper.zoom(option);
        }
    });
</script>
