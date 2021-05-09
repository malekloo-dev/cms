{{-- <input type="hidden" name="imageJson"> --}}
<meta name="_token" content="{{ csrf_token() }}">
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script> --}}

{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" crossorigin="anonymous" /> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha256-WqU1JavFxSAMcLP2WIOI+GB2zWmShMI82mTpLDcqFUg=" crossorigin="anonymous"></script> --}}

{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" integrity="sha256-jKV9n9bkk/CTP8zbtEtnKaKf+ehRovOYeKoyfthwbC8=" crossorigin="anonymous" /> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js" integrity="sha256-CgvH7sz3tHhkiVKh05kSUgG97YtzYNnWt6OXcmYzqHY=" crossorigin="anonymous"></script> --}}

<link href="{{ url('/adminAssets/css/cropper.css') }}" rel="stylesheet">
<script src="{{ url('/adminAssets/js/cropper.js') }}"></script>

<style type="text/css">
    .cropper img {
        display: block;
        max-width: 200px;
        max-height: 200px;
    }

    .cropper .cropper-bg {
        max-width: 100%;
    }

    .cropper .preview {
        overflow: hidden;
        width: 300px;
        height: 300px;
        margin: 10px auto;
        border-radius: 50%;
        background-color: #fff;
    }

    .cropper .modal-lg {
        max-width: 1000px !important;
    }
    .modal-content{
        background-color: #efefef
    }

</style>
<div class="modal fade cropper" style="direction: ltr;" id="modal" tabindex="-1" role="dialog"
    aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6  col-xs-12" style="float: inherit;">
                            <div class="preview"></div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="float: inherit;">
                            <img id="image" src="">
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn  close" data-dismiss="modal">@lang('messages.cancel')</button>
                <button type="button" class="btn btn-primary" id="crop">@lang('messages.crop')</button>
            </div>
        </div>
    </div>
</div>
<script>
    var $modal = $('#modal');
    var image = document.getElementById('image');
    var cropper;
    $("body").on("click", "#images", function(e) {
        $(this).val('');
    });
    $('#modal .close').on('click', function() {
        $modal.modal('hide');
    })
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
            aspectRatio: 1,
            viewMode: 0,
            preview: '.preview'
        });
    }).on('hidden.bs.modal', function() {
        cropper.destroy();
        cropper = null;
    });

    $("#crop").click(function() {
        canvas = cropper.getCroppedCanvas({
            fillColor: '#fff',
            width: 300,
            height: 300,
            imageSmoothingEnabled: false,
            imageSmoothingQuality: 'high',
        });
        // console.log(canvas.toDataURL('image/jpeg'));

        canvas.toBlob(function(blob) {

            // console.log(blob);
            url = URL.createObjectURL(blob);
            // console.log(url);
            var reader = new FileReader();
            //  console.log(reader);
            reader.readAsDataURL(blob);

            // fileName = $("input[name=title]").val().replace(' ', '-');
            fileName = "{{ $user->company->id ?? '0' }}";

            reader.onloadend = function() {
                // console.log(reader);
                var base64data = reader.result;
                // $('input[name=imageJson]').val(base64data)
                // $modal.modal('hide');
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('company.profile.changeLogo') }}",
                    data: {
                        '_token': $('meta[name="_token"]').attr('content'),
                        'fileName': fileName,
                        'image': base64data
                    },
                    success: function(data) {
                        $modal.modal('hide');
                        $('.company-logo svg').hide();
                        $('.company-logo img').show();
                        $('.company-logo img').attr('src', data.url.images.large);

                        // alert("success upload image");
                    }
                });
            }
        }, 'image/jpeg');
    })

</script>
