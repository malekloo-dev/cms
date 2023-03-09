@extends('admin.layouts.app')
@section('content')
@section('ckeditor')
    <script>
        /*  $(document).ready(function() {
                    var $input = $("#parent_id");
                    $input.select2();
                    $("ul.select2-choices").sortable({
                        containment: 'parent'
                    });
                }); */
    </script>
@endsection

<div class="content-control">
    <ul class="breadcrumb">
        <li class="active">@lang('messages.setting')</li>
    </ul>
</div>

<div class="content-body">
    <div class="panel panel-default  ">
        <div class="panel-body ">
            <form action="{{ route('seo.websiteSetting.update') }}" method="POST" class="">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-lg-6">
                        <h3>@lang('messages.seo setting')</h3>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="meta_title" class="col-form-label ">Meta title:</label>
                                <input type="text" class="form-control " name="meta_title"
                                    value="{{ $data['meta_title'] ?? '' }}" />
                                <span class="text-danger">{{ $errors->first('meta_title') }}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="meta_keywords" class=" col-form-label ">Meta keyword:</label>
                                <input type="text" class="form-control " name="meta_keywords"
                                    value="{{ $data['meta_keywords'] ?? '' }}" />
                                <span class="text-danger">{{ $errors->first('meta_keywords') }}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="meta_description" class=" col-form-label ">Meta description:</label>
                                <input type="text" class="form-control " name="meta_description"
                                    value="{{ $data['meta_description'] ?? '' }}" />
                                <span class="text-danger">{{ $errors->first('meta_description') }}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="og:type" class=" col-form-label ">og:type:</label>
                                <input type="text" class="form-control " name="og:type" placeholder="website"
                                    value="{{ $data['og:type'] ?? '' }}" />
                                <span class="text-danger">{{ $errors->first('og:type') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <h3>@lang('messages.setting')</h3>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="phone" class=" col-form-label ">phone:</label>
                                <input type="text" class="form-control " name="phone" placeholder="09331181877"
                                    value="{{ $data['phone'] ?? '' }}" />
                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                            </div>
                            @if (isset($data['goldPrice']))
                                <div class="col-md-12">
                                    <label for="goldPrice" class=" col-form-label ">Gold price:</label>
                                    <input type="text" class="form-control ltr " name="goldPrice"
                                        placeholder="09331181877" value="{{ $data['goldPrice'] ?? '' }}" />
                                    <span class="text-danger">{{ $errors->first('goldPrice') }}</span>
                                </div>
                            @endif
                        </div>

                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-success   mat-btn ">@lang('messages.confirm')
                        </button>
                    </div>
                </div>


            </form>
        </div>
    </div>
</div>

@endsection
