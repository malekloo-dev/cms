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
            $("ul.select2-choices").sortable({
                containment: 'parent'
            });



        });

        $("#meta_keywords").select2({
            tags: [],
            maximumInputLength: 100
        });

    </script>


    <script src="/ckeditor5/ckeditor5-build-classic/ckeditor.js"> </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#brief_description'), {
                ckfinder: {
                    uploadUrl: "{{ route('contents.upload', ['_token' => csrf_token()]) }}",
                },
                toolbar: {
                    viewportTopOffset: 80
                },
                @if(!$ltr)
                language: 'fa'
                @endif
            })
            .then(editor => {
                const wordCountPlugin = editor.plugins.get('WordCount');
                const wordCountWrapper = document.getElementById('word-count1');
                wordCountWrapper.appendChild(wordCountPlugin.wordCountContainer);

                window.editor = editor;
            })

            .catch(err => {
                console.error(err.stack);
            });


        ClassicEditor
            .create(document.querySelector('#description'), {
                ckfinder: {
                    uploadUrl: "{{ route('contents.upload', ['_token' => csrf_token()]) }}",
                },
                toolbar: {
                    viewportTopOffset: 80
                },
                @if(!$ltr)
                language: 'fa'
                @endif
            })
            .then(editor => {
                const wordCountPlugin = editor.plugins.get('WordCount');
                const wordCountWrapper = document.getElementById('word-count2');
                wordCountWrapper.appendChild(wordCountPlugin.wordCountContainer);

                window.editor = editor;
            })
            .catch(err => {
                console.error(err.stack);
            });

    </script>





@endsection

@section('content')

<div class="content-control">
    <ul class="breadcrumb">
        <li><a href="{{ route('contents.show', ['type' => $content_info->attr_type]) }}" class=""> @lang('messages.'.
                $content_info->attr_type .'s' ) </a></li>
        <li class="active">@lang('messages.edit') {{ old('title', $content_info->title) }}</li>
    </ul>
</div>


<div class="content-body">
    <div class="panel panel-default  pos-abs chat-panel bottom-0">

        <div class="panel-body full-height">
            <form method="post" action="{{ route('contents.update', $content_info->id) }}"
                enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="form-group row">
                    <div class="col-md-5">
                        <label for="title" class=" col-form-label text-md-left">@lang('messages.title'):</label>
                        <input type="text" class="form-control" name="title"
                            value="{{ old('title', $content_info->title) }}" />
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    </div>
                    <div class="col-md-5">
                        <label for="slug" class=" col-form-label text-md-left">@lang('messages.url') :</label>
                        <input type="text" class="form-control" name="slug"
                            value="{{ old('slug', $content_info->slug) }}" />
                        <span class="text-danger">{{ $errors->first('slug') }}</span>
                    </div>
                    <div class="col-md-2">
                        <label for="name">@lang('messages.publish date') :</label>
                        <input  type="{{ ($ltr)?'date':'' }}" class="form-control @if(!$ltr) datepicker @endif" name="publish_date"
                            value="{{ old('publish_date', $content_info->publish_date) }}" />
                    </div>
                </div>
                @if ($content_info->attr_type == 'html')

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="brand" class=" col-form-label text-md-left">@lang('messages.static template') @lang('messages.name'):</label>
                            <input type="text" class="form-control" name="attr[template_name]"
                                value="{{ old('attr[template_name]', $content_info->attr['template_name'])  }}" />

                        </div>
                    </div>
                @endif

                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="name" class=" col-form-label text-md-left">@lang('messages.brief'):</label>

                        <textarea class="form-control" id="brief_description" name="brief_description" rows="10"
                            placeholder="Enter your Content">{{ old('brief_description', $content_info->brief_description) }}</textarea>
                        <div id="word-count1"></div>
                        <span class="text-danger">{{ $errors->first('brief_description') }}</span>
                    </div>

                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="name" class=" col-form-label text-md-left">@lang('messages.description'):</label>
                        <textarea class="form-control" id="description"
                            name="description">{{ old('description', $content_info->description) }}</textarea>
                        <div id="word-count2"></div>
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    </div>

                </div>


                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="name" >@lang('messages.category'):</label>
                        {{--<select multiple name="parent_id" id="parent_id"
                            class="form-control">--}}
                            <select id="parent_id" class="js-example-basic-multiple" name="parent_id[]"
                                multiple="multiple">

                                @foreach ($category as $Key => $fields)
                                    <option value="{{ $fields['id'] }}"
                                        {{ $content_info->parent_id == $fields['id'] ? 'selected' : '' }}>{!!
                                        $fields['symbol'] . $fields['title'] !!}</option>
                                @endforeach
                            </select>
                            <div id="parent_id_val" class="parent_id_val"></div>
                            <span class="text-danger">{{ $errors->first('parent_id') }}</span>
                    </div>

                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="images" class="control-label">@lang('messages.image') (@lang('messages.content') {{ env('ARTICLE_LARGE') }}px)
                            (@lang('messages.product') {{ env('PRODUCT_LARGE') }}px)</label>
                        <input type="file" class="form-control images" name="images" id="images"
                            placeholder="@lang('messages.select image')" value="{{ old('imageUrl') }}">

                            <input type="hidden" name="imageJson">



                    </div>

                </div>

                <div class="form-group row">
                    <div class="col-sm-12">
                        @if (is_array($content_info->images))
                            @foreach ($content_info->images['images'] as $key => $image)
                                <div class="col-sm-2">
                                    <label class="control-label">
                                        {{ $key }}
                                        <input type="radio" name="imagesThumb" value="{{ $image }}"
                                            {{ $content_info->images['thumb'] == $image ? 'checked' : '' }} />
                                        <a href="{{ $image }}" target="_blank"><img src="{{ $image }}" width="100%"></a>
                                    </label>
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="meta_title">Meta Title</label>
                        <input type="text" class="form-control" name="meta_title"
                            value="{{ old('meta_keywords', $content_info->meta_title) }}" />
                        <span class="text-danger">{{ $errors->first('meta_title') }}</span>
                    </div>
                    <div class="col-md-6">
                        <label for="name" class=" text-md-left">meta keywords</label>
                        <input id="meta_keywords" type="text" name="meta_keywords"
                            value="{{ old('meta_keywords', $content_info->meta_keywords) }}" />
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="meta_description" class=" col-form-label text-md-left">meta
                            Description:</label>
                        <textarea class="form-control" id="meta_description"
                            name="meta_description">{{ old('meta_description', $content_info->meta_description) }}</textarea>
                    </div>

                </div>


                @if ($content_info->attr_type == 'product')

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="brand" class=" col-form-label text-md-left">@lang('messages.brand'):</label>
                            <input type="text" class="form-control" name="attr[brand]"
                                value="{{ old('attr[brand]', $content_info->attr['brand']) }}" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="price" class=" col-form-label text-md-left">@lang('messages.price'):</label>
                            <input type="text" class="form-control" name="attr[price]"
                                value="{{ old('attr[price]', $content_info->attr['price']) }}" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="offer_price" class=" col-form-label text-md-left">@lang('messages.discount'):</label>

                            <input type="text" class="form-control" name="attr[offer_price]"
                                value="{{ old('attr[offer_price]', $content_info->attr['offer_price']) }}" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="alternate_name" class=" col-form-label text-md-left">@lang('messages.alternative') @lang('messages.name'):</label>

                            <input type="text" class="form-control" name="attr[alternate_name]"
                                value="{{ old('attr[alternate_name]', $content_info->attr['alternate_name'] ?? '') }}" />
                        </div>
                    </div>

                @endif
                <div class="form-group row">
                    <div class="col-md-1">
                        <label for="rate" class="col-form-label text-md-left">@lang('messages.rate'):</label>

                        <input type="text" class="form-control" name="attr[rate]"
                            value="{{ old('attr[rate]', $content_info->attr['rate'] ?? '') }}" />
                    </div>
                    <div class="col-md-4">
                        <label for="name" class="col-form-label text-md-left">@lang('messages.status'):</label>
                        <select class="form-control" name="status">
                            <option value="1" {{ $content_info->status == '1' ? 'selected' : '' }}>@lang('messages.Active')</option>
                            <option value="0" {{ $content_info->status == '0' ? 'selected' : '' }}>@lang('messages.Disactive')</option>
                        </select>
                    </div>
                </div>



                <button type="submit" class="btn btn-success  @if(!$ltr)pull-right @endif mat-btn ">@lang('messages.edit')
                </button>
            </form>
        </div>
    </div>
</div>

@endsection
