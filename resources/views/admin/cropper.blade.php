

<label for="jpeg" >
    jpeg
    <input type="radio" checked id="jpeg" name="imageJson" value="{{ old('imageJson',($content_info->imageJson??($company->imageJson??''))) }}">
    <img height="" src="{{ $cropperPreview ??''}}" id="cropperPreview" >
</label>

<label for="png">
    png
    <input type="radio" id="png" name="imageJson" value="{{ old('imageJson',($content_info->imageJson??($company->imageJson??''))) }}">
    <img height="" src="{{ $cropperPreview ??''}}" id="cropperPreviewPng" >
</label>

<meta name="_token" content="{{ csrf_token() }}">

<link href="{{ url('/adminAssets/css/cropper.css') }}" rel="stylesheet">
<script src="{{ url('/adminAssets/js/cropper.js') }}"></script>

<style type="text/css">

    label[for=jpeg],label[for=png]{
        display: none
    }

    .modal-cropper img {
        display: block;
        max-width: 300px;
        max-height: 300px;
    }

    .preview {
        overflow: hidden;
        width: {{ env(Str::upper($content_info->attr_type ?? $attr_type) . '_LARGE_W') }}px;
        height: {{ env(Str::upper($content_info->attr_type ?? $attr_type) . '_LARGE_H') }}px;
        margin: 10px;
        border: 1px solid red;
    }

    .modal-lg {
        max-width: 1000px !important;??
    }

</style>
<div class="modal fade modal-cropper" style="direction: ltr;" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Laravel Crop Image Before Upload using Cropper JS -
                    NiceSnippets.com</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">

                        <div class="col-lg-8 col-md-8 col-sm-8" style="max-width: 50%;float: inherit;">
                            <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4" style="max-width: 50%;float: inherit;">
                            <div class="preview"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="crop">Crop</button>
            </div>
        </div>
    </div>
</div>
<script>
    var $modal = $('#modal');
    var image = document.getElementById('image');
    var cropper;

    if($('[name=imageJson]').val() != '')
        $('#cropperPreview').attr('src',$('input[name=imageJson]').val())


    $("body").on("change", "#images", function(e) {
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
            aspectRatio: {{ env(Str::upper($content_info->attr_type ?? $attr_type) . '_SMALL_W') }} /
                {{ env(Str::upper($content_info->attr_type ?? $attr_type) . '_SMALL_H') }},
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
            width: {{ env(Str::upper($content_info->attr_type ?? $attr_type) . '_LARGE_W') }},
            height: {{ env(Str::upper($content_info->attr_type ?? $attr_type) . '_LARGE_H') }},
            imageSmoothingEnabled: false,
            imageSmoothingQuality: 'high',
        });
        canvasPng = cropper.getCroppedCanvas({
            // fillColor: '#ffffff',
            width: {{ env(Str::upper($content_info->attr_type ?? $attr_type) . '_LARGE_W') }},
            height: {{ env(Str::upper($content_info->attr_type ?? $attr_type) . '_LARGE_H') }},
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
                        $('#cropperPreviewPng').attr('src',base64data)
                    };
                });
                $('#cropperPreview').attr('src',base64data)
                $modal.modal('hide');
                // $.ajax({
                //     type: "POST",
                //     dataType: "json",
                //     url: "/admin/image-cropper/upload",
                //     data: {
                //         '_token': $('meta[name="_token"]').attr('content'),
                //         'fileName':fileName,
                //         'image': base64data
                //     },
                //     success: function(data){
                //         $modal.modal('hide');
                //         alert("success upload image");
                //     }
                //   });
            }
        }, 'image/png');
    })

</script>
