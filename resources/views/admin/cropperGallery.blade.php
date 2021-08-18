{{-- <input type="" id="jpeg" name="imageJson"> --}}

<style type="text/css">
    .modal-cropper img {
        display: block;
        max-width: 300px;
        max-height: 300px;
    }

    .modal-lg {
        max-width: 1000px !important;
    }

    .gallery {
        display: flex
    }

    .gallery>div {
        position: relative;
        display: flex;
        cursor: pointer;
        justify-content: flex-end;
        align-items: flex-start;
    }

    .gallery>div::after {
        content: 'X';
        position: absolute;
        color: red;
        font-weight: bold;
        font-size: 3em;

    }

</style>
<div class="modal fade modal-cropper" style="direction: ltr;" id="galleryModal" tabindex="-1" role="dialog"
    aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <div class="row">

                    <div class="col-md-8 col-xs-12" style="">
                        <img id="galleryImage" src="">

                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" data-method="move" data-option="-10"
                                data-second-option="0" title="Move Left">
                                <span class="docs-tooltip" data-toggle="tooltip" title=""
                                    data-original-title="cropper.move(-10, 0)">
                                    <span class="fa fa-arrow-left"></span>
                                </span>
                            </button>
                            <button type="button" class="btn btn-primary" data-method="move" data-option="10"
                                data-second-option="0" title="Move Right">
                                <span class="docs-tooltip" data-toggle="tooltip" title=""
                                    data-original-title="cropper.move(10, 0)">
                                    <span class="fa fa-arrow-right"></span>
                                </span>
                            </button>
                            <button type="button" class="btn btn-primary" data-method="move" data-option="0"
                                data-second-option="-10" title="Move Up">
                                <span class="docs-tooltip" data-toggle="tooltip" title=""
                                    data-original-title="cropper.move(0, -10)">
                                    <span class="fa fa-arrow-up"></span>
                                </span>
                            </button>
                            <button type="button" class="btn btn-primary" data-method="move" data-option="0"
                                data-second-option="10" title="Move Down">
                                <span class="docs-tooltip" data-toggle="tooltip" title=""
                                    data-original-title="cropper.move(0, 10)">
                                    <span class="fa fa-arrow-down"></span>
                                </span>
                            </button>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" data-method="zoom" data-option="0.1"
                                title="Zoom In">
                                <span class="docs-tooltip" data-toggle="tooltip" title=""
                                    data-original-title="cropper.zoom(0.1)">
                                    <span class="fa fa-search-plus"></span>
                                </span>
                            </button>
                            <button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.1"
                                title="Zoom Out">
                                <span class="docs-tooltip" data-toggle="tooltip" title=""
                                    data-original-title="cropper.zoom(-0.1)">
                                    <span class="fa fa-search-minus"></span>
                                </span>
                            </button>
                        </div>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('messages.cancel')</button>
                <button type="button" class="btn btn-primary" id="galleryCrop">@lang('messages.crop')</button>
            </div>
        </div>
    </div>
</div>
<script>
    var $galleryModal = $('#galleryModal');
    var galleryImage = document.getElementById('galleryImage');
    var galleryCropper;

    if ($('[name=imageJson]').val() != '')
        $('#cropperPreview').attr('src', $('input[name=imageJson]').val())


    $("body").on("change", "#galleryFile", function(e) {
        var files = e.target.files;
        var done = function(url) {
            galleryImage.src = url;
            $galleryModal.modal('show');
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

    $galleryModal.on('shown.bs.modal', function() {

        galleryCropper = new Cropper(galleryImage, {
            aspectRatio: {{ env(Str::upper($content_info->attr_type ?? $attr_type) . '_SMALL_W') }} /
                {{ env(Str::upper($content_info->attr_type ?? $attr_type) . '_SMALL_H') }},
            viewMode: 0
        });
    }).on('hidden.bs.modal', function() {
        galleryCropper.destroy();
        galleryCropper = null;
    });

    $("#galleryCrop").click(function() {



        canvas = galleryCropper.getCroppedCanvas({
            fillColor: '#ffffff',
            width: {{ env(Str::upper($content_info->attr_type ?? $attr_type) . '_LARGE_W') }},
            height: {{ env(Str::upper($content_info->attr_type ?? $attr_type) . '_LARGE_H') }},
            imageSmoothingEnabled: true,
            imageSmoothingQuality: 'high',
        });


        canvas.toBlob(function(blob) {

            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);

            reader.onloadend = function() {

                var base64data = reader.result;

                $('.gallery').append('<div><img src="' + base64data +
                    '" height="100"><input id="jpeg" type="hidden" name="imageJsonGallery[]" value="' +
                    base64data + '" ></div>');

                $('#galleryFile').val('');

                $galleryModal.modal('hide');

            }
        }, 'image/jpeg');
    });




    $('button[data-method]').click(function(e) {

        var method = $(this).data('method');
        var option = $(this).data('option');
        if (method == 'move') {
            var second = $(this).data('second-option');
            galleryCropper.move(option, second);
        }
        if (method == 'zoom') {
            galleryCropper.zoom(option);
        }
    });

    $('body').on('click', '.gallery div', function(e) {
        var img = $(this).find('img');

        if(img.data('id')){
            var id = img.data("id");
            var token = $("meta[name='csrf-token']").attr("content");

            $.ajax(
            {
                url: "/admin/gallery/"+id,
                type: 'DELETE',
                data: {
                    "id": id,
                    "_token": token,
                },
                success: function (){
                    console.log("it Works");

                }
            });

        }

        $(this).remove();

    });
</script>
