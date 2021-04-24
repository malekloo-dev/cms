@extends('admin.layouts.app')
@section('head')
    <meta name="_token" content="{{ csrf_token() }}">
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" crossorigin="anonymous" /> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha256-WqU1JavFxSAMcLP2WIOI+GB2zWmShMI82mTpLDcqFUg=" crossorigin="anonymous"></script> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" integrity="sha256-jKV9n9bkk/CTP8zbtEtnKaKf+ehRovOYeKoyfthwbC8=" crossorigin="anonymous" /> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js" integrity="sha256-CgvH7sz3tHhkiVKh05kSUgG97YtzYNnWt6OXcmYzqHY=" crossorigin="anonymous"></script> --}}
    <link href="{{ url('/adminAssets/css/cropper.css') }}" rel="stylesheet">
    <script src="{{ url('/adminAssets/js/cropper.js') }}"></script>

    <style type="text/css">
        img {
          display: block;
          max-width: 100%;
        }
        .preview {
          overflow: hidden;
          width: {{ env('ARTICLE_SMALL_W') }}px;
          height: {{ env('ARTICLE_SMALL_H') }}px;
          margin: 10px;
          border: 1px solid red;
        }
        .modal-lg{
          max-width: 1000px !important;
        }
        </style>
@endsection
@section('footer')
<div class="modal fade" style="direction: ltr;" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalLabel">Laravel Crop Image Before Upload using Cropper JS - NiceSnippets.com</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="img-container">
              <div class="row">
                  <div class="col-md-8">
                      <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                  </div>
                  <div class="col-md-4">
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

    $("body").on("change", ".images", function(e){
        var files = e.target.files;
        var done = function (url) {
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
            reader.onload = function (e) {
              done(reader.result);
            };
            reader.readAsDataURL(file);
          }
        }
    });

    $modal.on('shown.bs.modal', function () {

        cropper = new Cropper(image, {
        //   aspectRatio: 1,
        //   viewMode: 3,
          aspectRatio: {{ env('ARTICLE_SMALL_W') }}/{{ env('ARTICLE_SMALL_H') }},
          viewMode: 0,
          preview: '.preview'
        });
    }).on('hidden.bs.modal', function () {
       cropper.destroy();
       cropper = null;
    });

    $("#crop").click(function(){
        canvas = cropper.getCroppedCanvas({
            fillColor:'#fff',
            width: {{ env('ARTICLE_SMALL_W') }},
            height: {{ env('ARTICLE_SMALL_H') }},
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

             fileName = $("input[name=title]").val().replace(' ','-');

             reader.onloadend = function() {
                // console.log(reader);
                var base64data = reader.result;
                $('input[name=imageJson]').val(base64data)
                $modal.modal('hide');
                // $.ajax({
                //     type: "POST",
                //     dataType: "json",
                //     url: "/admin/image-cropper/upload",
                //     data: {
                //         '_token': $('meta[name="_token"]').attr('content'),
                //         'fileName':fileName,
                //         'type': `{{ $content_info->attr_type }}`,
                //         'image': base64data
                //     },
                //     success: function(data){
                //         $modal.modal('hide');
                //         alert("success upload image");
                //     }
                //   });
             }
        },'image/jpeg');
    })

    </script>


@endsection

@section('ckeditor')

<script>

    $(document).ready(function() {

        var $input = $("#parent_id");
        $input.select2();

        $input.on("selecting unselecting change", function() {
            setOption($("#parent_id").parent().find("ul.select2-choices"));

        })
        setOption($("#parent_id").parent().find("ul.select2-choices"));
        $("#parent_id").parent().find("ul.select2-choices").sortable({
            containment: 'parent',
            update : function(){ setOption(this)},

        });

        function setOption($this) {
            var $select = $("#parent_id");
            //$(this).closest(".select2-container").next();
            var options;
            options = $select.find("option");
            $("#parent_id_hide").empty();
            //var newoptions = '';
            var newoptions = [];
            // Clear option
            $($this).find(".select2-search-choice").each(function (i, tag) {

                options.each(function (j, option) {
                    var optionTag='';
                    if ($.trim($(tag).text()) == $.trim($(option).text())) {
                        // console.log(option.val());
                        //$("#par_idd").append(new Option($(tag).text(),  $(option).val()));
                        optionTag = new Option($(tag).text(), $(option).val());
                        $("#par_idd").append(new Option($(tag).text(), $(option).val()));
                        //newoptions=newoptions+','+$(option).val();
                        newoptions.push(optionTag);
                        //$("#par_idd").append(option);
                    }

                });
            });

            $("#parent_id_hide").empty();
            $("#parent_id_hide").append(newoptions);
            $('#parent_id_hide option').prop('selected', true);

        }

    $("#meta_keywords").select2({
        tags:[],
        maximumInputLength: 100
    });

    </script>

@endsection
@section('content')


    <div class="content-control">
        <ul class="breadcrumb">
            <li><a  class="text-18">Add</a></li>
        </ul>
    </div>

    <div class="content-body">
        <div class="panel panel-default  pos-abs chat-panel bottom-0">
            <div class="panel-body full-height">
                <form action="{{ route('contents.store') }}" method="POST" name="add_content" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-md-12 col-form-label text-md-left">Enter Title:</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="title"
                                   value="{{ old('title') }}" />
                            <span class="text-danger">{{ $errors->first('title') }}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-12 col-form-label text-md-left"> template name:</label>
                        <div class="col-md-12">
                            <textarea rows="5" class="form-control" id="append_header'" name="attr[template_name]">{{ old('attr[template_name]') }}</textarea>
                        </div>

                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-12 col-form-label text-md-left">Description:</label>
                        <div class="col-md-12">
                            <textarea rows="30" class="form-control"   id="description" name="description">{{ old('description') }}</textarea>

                        </div>

                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-12 col-form-label text-md-left">Append Footer:</label>
                        <div class="col-md-12">
                            <textarea rows="5" class="form-control" id="append_footer'" name="attr[append_footer]">{{ old('attr[append_footer]') }}</textarea>
                        </div>

                    </div>



                    <div class="form-group row">
                        <label for="name" class="col-md-12 col-form-label text-md-left">Category</label>
                        <div class="col-md-12">
                            {{--<select multiple name="parent_id" id="parent_id" class="form-control" >--}}
                                <select id="parent_id"  class="js-example-basic-multiple" name="parent_id[]" multiple="multiple">

                                @foreach($category as $Key => $fields)
                                    <option value="{{$fields['id']}}">{!! $fields['symbol'].$fields['title']!!}</option>
                                @endforeach
                            </select>
                            <div id="parent_id_val" class="parent_id_val"></div>
                            <select style="visibility: hidden" id="parent_id_hide"  name="parent_id_hide[]" multiple="multiple"></select>

                            <span class="text-danger">{{ $errors->first('parent_id') }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-12 col-form-label text-md-left">meta keywords</label>
                        <div class="col-md-12">
                            <input id="meta_keywords" type="text" name="meta_keywords"
                                   value="{{ old('meta_keywords') }}" />
                        </div>
                    </div>




                    <div class="form-group row">
                        <label for="name" class="col-md-12 col-form-label text-md-left">Publish Date:</label>
                        <div class="col-md-12">
                            <input type="datetime" class="form-control datepicker" name="publish_date"
                                   value = "{{ old('date2',Carbon\Carbon::now()->addDay()->format('Y-m-d')) }}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="images" class="control-label">تصویر مقاله (سایز مقاله {{ env('ARTICLE_LARGE') }}px) (سایز محصول {{ env('PRODUCT_LARGE') }}px)</label>
                            <input type="file" class="form-control" name="images" id="images" placeholder="تصویر مقاله را وارد کنید" value="{{ old('imageUrl') }}">
                            <input type="hidden" name="imageJson">
                        </div>

                    </div>
                    <div class="form-group row">
                        <label for="meta_description" class="col-md-12 col-form-label text-md-left">meta
                            Description:</label>
                        <div class="col-md-12">
                        <textarea class="form-control" id="meta_description" name="meta_description">{{ old('meta_description') }}</textarea>
                        </div>
                    </div>



                    <div class="form-group row">
                        <label for="name" class="col-md-12 col-form-label text-md-left">Status:</label>
                        <div class="col-md-12">
                            <select class="form-control" name="status" >
                                <option value="1">فعال</option>
                                <option value="0">غیر فعال</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="attr_type" value="{{ $attr_type }}">

                    <button type="submit" class="btn btn-success pull-right mat-btn radius-all  mat-elevation-z">Add Content</button>
                    <a href="{{ old('publish_date') }}" class="link ">
                        <i class="fa fa-arrow-left"></i> Back to List
                    </a>
                </form>
            </div>
        </div>
    </div>

@endsection


<span class="text-danger">{{ $errors->first('brief_description') }}</span>
<span class="text-danger">{{ $errors->first('description') }}</span>
<span class="text-danger">{{ $errors->first('status') }}</span>
<span class="text-danger">{{ $errors->first('publish_date') }}</span>


