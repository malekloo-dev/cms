@extends('admin.layouts.app')
@section('content')
@section('ckeditor')

    <script>
        $(document).ready(function() {

            var $parent = $(".parent_id");
            $parent.select2();
            $("ul.select2-choices").sortable({
                containment: 'parent'
            });

        });
        var $module_id = $(".module_id");
        $module_id.select2();

        var $anchor_link = $(".anchor_link");
        $anchor_link.select2();

    </script>

@endsection



<div class="content-control">
    <ul class="breadcrumb">
        <li class="active">@lang('messages.home') @lang('messages.modules') </li>
    </ul>
</div>

<div class="content-body">
    <div class="panel panel-default  pos-abs chat-panel bottom-0">

        <div class="panel-body full-height">

            <div class="col-md-4">
                <ul>
                    <li><a href="{{ route('moduleBuilder.update', ['fileName' => 'Home']) }}">Home</a></li>
                    @foreach ($files as $itemFileName => $item)
                        <li><a
                                href="{{ route('moduleBuilder.update', ['fileName' => $itemFileName]) }}">{{ $itemFileName }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-8">
                @if ($errors->any())
                    {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                @endif
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{!! \Session::get('success') !!}</li>
                        </ul>
                    </div>
                @endif

                @if (count($arrayContent))
                    <form method="post" action="{{ route('moduleBuilder.update', ['fileName' => $fileName]) }}"
                        enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <div class="form-group row">


                            <div class="col-md-8 btn-block">
                                @if (count($arrayContent))


                                    @foreach ($arrayContent as $Key => $attr)
                                        @php

                                            $widget['parent_id'] = 0;
                                            $widget['sort'] = '';

                                            if (is_array($widgets->attr) and isset($widgets->attr[$attr['config']['var']])) {
                                                $widget = $widgets->attr[$attr['config']['var']];
                                            }

                                        @endphp
                                        @if ($attr['type'] == 'images')
                                            <div class="panel-group" id="accordion" role="tablist"
                                                aria-multiselectable="true">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading" role="tab"
                                                        id="heading{{ $attr['config']['var'] }}">

                                                        <a class="btn-block btn" role="button" data-toggle="collapse"
                                                            data-parent="#accordion"
                                                            href="#collapse{{ $attr['config']['var'] }}"
                                                            aria-expanded="true"
                                                            aria-controls="collapse{{ $attr['config']['var'] }}">
                                                            {{ $attr['config']['label'] }}
                                                        </a>

                                                    </div>

                                                    <div id="collapse{{ $attr['config']['var'] }}"
                                                        class="panel-collapse collapse {{-- {{ $menu_info->module == 'category' ? 'in' : '' }} --}}"
                                                        role="tabpanel"
                                                        aria-labelledby="heading{{ $attr['config']['var'] }}">
                                                        <div class="panel-body">

                                                            @for ($i = 0; $i < $attr['config']['count']; $i++)
                                                                <div class="row"
                                                                    style="border-bottom:1px dashed #ccc; padding-bottom:1em;">
                                                                    <div class="col-md-1">
                                                                        <label for="parent"
                                                                            class="col-form-label text-md-left">
                                                                            Delete</label>
                                                                        <input type="checkbox"
                                                                            name="attr[{{ $attr['config']['var'] }}][delete][{{ $i }}]"
                                                                            value="1" class="form-check"
                                                                            id="exampleCheck1">

                                                                    </div>

                                                                    <?php
                                                                    // dd($widget);
                                                                    ?>
                                                                    <div class="col-md-3 ">
                                                                        @if (isset($widget['images'][$i]))
                                                                            @if ($widget['mimeType'] == 'image')

                                                                                <img height="80"
                                                                                    src="{{ url($widget['images'][$i]) }}" />
                                                                                <label for="img"
                                                                                    class="col-form-label text-md-left">

                                                                                </label>

                                                                            @else

                                                                                <img height="80"
                                                                                    src="/{{ asset('images/movie.jpg') }}" />
                                                                                <label for="img"
                                                                                    class="col-form-label text-md-left">
                                                                                    {{ $widget['images'][$i] }}
                                                                                </label>

                                                                            @endif
                                                                        @endif

                                                                    </div>
                                                                    <div class="col-md-3 ">

                                                                        <label for="parent"
                                                                            class="col-form-label text-md-left">@lang('messages.image')</label>
                                                                        <input type="file" class="form-control"
                                                                            name="attr[{{ $attr['config']['var'] }}][images][{{ $i }}]"
                                                                            id="images" placeholder=""
                                                                            value="{{ old('imageUrl') }}">

                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <label for=""
                                                                            class="col-form-label text-md-left">
                                                                            @lang('messages.name')</label>
                                                                        <input type="text" class="form-control"
                                                                            name="attr[{{ $attr['config']['var'] }}][name][{{ $i }}]"
                                                                            id="" placeholder=""
                                                                            value="{{ $widget['name'][$i] ?? ''}}">
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <label for="attr[{{ $attr['config']['var'] }}][follow][{{ $i }}]">follow</label>
                                                                        <input type="checkbox"
                                                                        {{ (isset($widget['follow'][$i]) && $widget['follow'][$i] == '1' ) ? 'checked' : '' }}
                                                                        id="attr[{{ $attr['config']['var'] }}][follow][{{ $i }}]" value="1" name="attr[{{ $attr['config']['var'] }}][follow][{{ $i }}]">

                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <label for=""
                                                                            class="col-form-label text-md-left ">Url</label>
                                                                        <input type="text" class="ltr form-control"
                                                                            name="attr[{{ $attr['config']['var'] }}][url][{{ $i }}]"
                                                                            id="" placeholder=""
                                                                            value="{{ $widget['url'][$i] ?? '' }}">

                                                                    </div>
                                                                </div>
                                                                <br />
                                                            @endfor

                                                            <br />
                                                            <br />


                                                        </div>

                                                    </div>
                                                </div>
                                                {{-- //---------------------- --}}

                                            </div>
                                        @elseif ($attr['type']=='counter')
                                            <div class="panel-group" id="accordion" role="tablist"
                                                aria-multiselectable="true">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading" role="tab"
                                                        id="heading{{ $attr['config']['var'] }}">

                                                        <a class="btn-block btn" role="button" data-toggle="collapse"
                                                            data-parent="#accordion"
                                                            href="#collapse{{ $attr['config']['var'] }}"
                                                            aria-expanded="true"
                                                            aria-controls="collapse{{ $attr['config']['var'] }}">
                                                            {{ $attr['config']['label'] }}
                                                        </a>

                                                    </div>

                                                    <div id="collapse{{ $attr['config']['var'] }}"
                                                        class="panel-collapse collapse {{-- {{ $menu_info->module == 'category' ? 'in' : '' }} --}}"
                                                        role="tabpanel"
                                                        aria-labelledby="heading{{ $attr['config']['var'] }}">
                                                        <div class="panel-body">

                                                            @for ($i = 0; $i < $attr['config']['count']; $i++)
                                                                <div class="row">

                                                                    @php
                                                                        $labelValue = '';
                                                                        $numberValue = '';
                                                                        if (isset($widget['data'][$i]['label'])) {
                                                                            $labelValue = $widget['data'][$i]['label'];
                                                                            $numberValue = $widget['data'][$i]['number'];
                                                                            // dd($widget['data'][$i]['label']);
                                                                        }
                                                                    @endphp
                                                                    <div class="col-md-3 ">
                                                                        <label for="label"
                                                                            class="col-form-label text-md-left">
                                                                            label </label>
                                                                        <input type="text" id="label"
                                                                            class="form-control"
                                                                            name="attr[{{ $attr['config']['var'] }}][data][{{ $i }}][label]"
                                                                            value="{{ $labelValue }}">
                                                                    </div>
                                                                    <div class="col-md-3 ">
                                                                        <label for="number"
                                                                            class="col-form-label text-md-left">
                                                                            number </label>
                                                                        <input type="text" id="number"
                                                                            class="form-control"
                                                                            name="attr[{{ $attr['config']['var'] }}][data][{{ $i }}][number]"
                                                                            value="{{ $numberValue }}">
                                                                    </div>


                                                                </div>
                                                                <br />
                                                            @endfor

                                                            <br />
                                                            <br />


                                                        </div>

                                                    </div>
                                                </div>
                                                {{-- //---------------------- --}}

                                            </div>
                                        @else
                                            <div class="panel-group" id="accordion" role="tablist"
                                                aria-multiselectable="true">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading" role="tab"
                                                        id="heading{{ $attr['config']['var'] }}">

                                                        <a class="btn-block btn" role="button" data-toggle="collapse"
                                                            data-parent="#accordion"
                                                            href="#collapse{{ $attr['config']['var'] }}"
                                                            aria-expanded="true"
                                                            aria-controls="collapse{{ $attr['config']['var'] }}">
                                                            {{ $attr['config']['label'] }}
                                                        </a>

                                                    </div>

                                                    <div id="collapse{{ $attr['config']['var'] }}"
                                                        class="panel-collapse collapse {{-- {{ $menu_info->module == 'category' ? 'in' : '' }} --}}"
                                                        role="tabpanel"
                                                        aria-labelledby="heading{{ $attr['config']['var'] }}">
                                                        <div class="panel-body">

                                                            <div class="row">
                                                                <div class="col-md-6 ">
                                                                    <div class="panel-title">

                                                                        <label for="parent"
                                                                            class="col-form-label text-md-left">select
                                                                            category
                                                                            to show widget
                                                                            {{ $attr['config']['label'] }}</label>
                                                                            {{-- {{ dd($attr) }} --}}
                                                                        <select
                                                                            name="attr[{{ $attr['config']['var'] }}][parent_id]"
                                                                            id="parent_id" class="parent_id"
                                                                            {{-- class="form-control" --}}>
                                                                            <option value="0">show
                                                                                {{ $attr['type'] }} from all
                                                                                categories
                                                                            </option>
                                                                            @foreach ($category as $Key => $fields)
                                                                                <option value="{{ $fields['id'] }}"
                                                                                    {{ $widget['parent_id'] == $fields['id'] ? 'selected' : '' }}>
                                                                                    {!! $fields['title'] !!}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label for="sort"
                                                                        class="col-form-label text-md-left">Sorting</label>

                                                                    <select
                                                                        name="attr[{{ $attr['config']['var'] }}][sort]"
                                                                        id="sort" class="parent_id"
                                                                        {{-- class="form-control" --}}>
                                                                        <option value="publish_date desc"
                                                                            {{ $widget['sort'] == 'publish_date desc' ? 'selected' : '' }}>
                                                                            date desc
                                                                        </option>
                                                                        <option value="publish_date asc"
                                                                            {{ $widget['sort'] == 'publish_date asc' ? 'selected' : '' }}>
                                                                            date asc
                                                                        </option>
                                                                        <option value="viewCount asc"
                                                                            {{ $widget['sort'] == 'viewCount asc' ? 'selected' : '' }}>
                                                                            view Count asc
                                                                        </option>
                                                                        <option value="viewCount desc"
                                                                            {{ $widget['sort'] == 'viewCount desc' ? 'selected' : '' }}>
                                                                            view Count desc
                                                                        </option>
                                                                        <option value="commentCount asc"
                                                                            {{ $widget['sort'] == 'commentCount asc' ? 'selected' : '' }}>
                                                                            comment Count asc
                                                                        </option>
                                                                        <option value="commentCount desc"
                                                                            {{ $widget['sort'] == 'commentCount desc' ? 'selected' : '' }}>
                                                                            comment Count desc
                                                                        </option>

                                                                    </select>
                                                                    <div id="parent_id_val" class="parent_id_val"></div>

                                                                </div>
                                                            </div>
                                                            @isset($attr['config']['child'])
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label
                                                                            for="attr[{{ $attr['config']['var'] }}][child]">@lang('messages.child')</label>
                                                                        <input checked
                                                                            id="attr[{{ $attr['config']['var'] }}][child]"
                                                                            value="true" type="checkbox"
                                                                            name="attr[{{ $attr['config']['var'] }}][child]">
                                                                    </div>
                                                                </div>
                                                            @endisset
                                                            <br />
                                                            <br />
                                                            @isset($attr['config']['isBackground'])
                                                                <div class="row">
                                                                    <?php
                                                                    //dd($widget);
                                                                    ?>
                                                                    <div class="col-md-3 ">
                                                                        @if (isset($widget['background']))
                                                                            <img height="80"
                                                                                src="{{ $widget['background'] }}" />
                                                                            <label for="img"
                                                                                class="col-form-label text-md-left">
                                                                                {{ $widget['background'] }} </label>
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-3 ">
                                                                        <div class="panel-title">

                                                                            <label for="parent"
                                                                                class="col-form-label text-md-left">Select
                                                                                Image</label>
                                                                            <input type="file" class="form-control"
                                                                                name="attr[{{ $attr['config']['var'] }}][background]"
                                                                                id="images" placeholder=""
                                                                                value="{{ old('imageUrl') }}">
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            @endisset


                                                            <br />
                                                            <br />


                                                        </div>

                                                    </div>
                                                </div>
                                                {{-- //---------------------- --}}

                                            </div>
                                        @endif
                                        <input type="hidden" id="type"
                                            name="attr[{{ $attr['config']['var'] }}][type]"
                                            value="{{ $attr['type'] }}">
                                        <input type="hidden" id="count"
                                            name="attr[{{ $attr['config']['var'] }}][count]"
                                            value="{{ $attr['config']['count'] ?? '1' }}">

                                    @endforeach
                                    <button type="submit" class="btn btn-success  mat-btn ">
                                        @lang('messages.edit')
                                    </button>
                                @endif

                            </div>

                        </div>
                    </form>
                @endif
            </div>
            <div class="col-12 col-md-12">
                @lang('messages.category'):
                <pre>&lbrace;&lbrace;--categoryDetail&label=categoryDetail&var=categoryDetail&count=1--&rbrace;&rbrace;    <button class="pull-right" onclick="copyToClipboard('&lbrace;&lbrace;--categoryDetail&label=categoryDetail&var=categoryDetail&count=1--&rbrace;&rbrace;')">Copy</button>
                </pre>
                <pre style="background-color: #fafafa">
&#64;isset($categoryDetail['data'])
    &lt;section class="my-0 py-5 bg-gray">
        &lt;div>
            &lt;div class="flex three">
                &lt;div class="two-third middle flex">
                    &lt;h2>فروشگاه عصر آی تی&lt;/h2>
                    &lbrace;!! $categoryDetail['data']->brief_description !!}
                &lt;/div>
                &lt;div class="third">
                    &lt;img src="&lbrace;&lbrace; $categoryDetail['data']->images['images']['large'] }}" alt="">
                &lt;/div>
            &lt;/div>
        &lt;/div>
    &lt;/section>
&#64;endisset
                </pre>
            </div>

            <div class="col-12 col-md-12">
                @lang('messages.category'):
                <pre>&lbrace;&lbrace;--category&label=category&var=category--&rbrace;&rbrace;    <button class="pull-right" onclick="copyToClipboard('&lbrace;&lbrace;--category&label=category&var=category--&rbrace;&rbrace;')">Copy</button>
                </pre>
                <pre style="background-color: #fafafa">
&#64;isset($category['data'])
    &#64;foreach ($category['data'] as $content)
        &lt;a href="&lbrace;&lbrace; $content->slug }}">
            &lt;div class="hover text-center">
                &#64;if (isset($content->images['images']['small']))
                    &lt;figure class="image">
                    &lt;img src="&lbrace;&lbrace; $content->images['images']['small']  }}"
                            alt="&lbrace;&lbrace; $content->title }}" width="40" height="40"
                            srcset="
                            &lbrace;&lbrace; $content->images['images']['small']  }} &lbrace;&lbrace; env('CATEGORY_SMALL_W') }}w,
                            &lbrace;&lbrace; $content->images['images']['medium'] ?? $content->images['images']['small'] }} &lbrace;&lbrace; env('CATEGORY_MEDIUM_W') }}w">
                                &lt;figcaption>
                        &lt;h3 class="p-0 m-0 text-center"> &lbrace;&lbrace; $content->title }}</h3>
                    &lt;/figcaption>
                &lt;/figure>
            &lt;/div>
        &lt;/a>
    &#64;endforeach
&#64;endisset
                </pre>
            </div>
            <div class="col-6 col-md-6">
                @lang('messages.products') & @lang('messages.child'):
                <pre>&lbrace;&lbrace;--product&label=products&var=products&count=6--&rbrace;&rbrace;
                    <button class="pull-right" onclick="copyToClipboard('&lbrace;&lbrace;--post&label=products&var=products&count=6--&rbrace;&rbrace;')">Copy</button>
                </pre>
                <pre>&lbrace;&lbrace;--product&label=products&var=products&count=6&child=true--&rbrace;&rbrace;
                    <button class="pull-right" onclick="copyToClipboard('&lbrace;&lbrace;--post&label=products&var=products&count=6&child=true--&rbrace;&rbrace;')">Copy</button>
                </pre>
            </div>
            <div class="col-6 col-md-6">
                @lang('messages.article') & @lang('messages.child'):
                <pre>&lbrace;&lbrace;--post&label=articles&var=articles&count=6--&rbrace;&rbrace;
                    <button class="pull-right" onclick="copyToClipboard('&lbrace;&lbrace;--post&label=articles&var=articles&count=6--&rbrace;&rbrace;')">Copy</button>
                </pre>
                <pre>&lbrace;&lbrace;--post&label=articles&var=articles&count=6&child=true--&rbrace;&rbrace;
                    <button class="pull-right" onclick="copyToClipboard('&lbrace;&lbrace;--post&label=articles&var=articles&count=6&child=true--&rbrace;&rbrace;')">Copy</button>
                </pre>
            </div>
            <div class="col-12 col-md-12">
                <pre style="background-color: #fafafa">
&#64;isset($topViewPost['data'])
&#64;foreach ($topViewPost['data'] as $content)
    &lt;div>
        &lt;a href="&lbrace;&lbrace; $content->slug }}">
            &lt;article class="shadow2">
                &#64;if (isset($content->images['images']['medium']))
                    &lt;figure class="image">
                        &lt;img src="&lbrace;&lbrace; $content->images['images']['medium'] }}"
                            width="198" height="100" alt="&lbrace;&lbrace; $content->title }}">
                    &lt;/figure>
                &#64;endif

                &lt;div class="title">&lbrace;&lbrace; $content->title }}&lt;/div>
                &lt;div class="info">
                    &lbrace;!! readMore($content->brief_description, 250) !!}
                &lt;/div>
                &lt;div class="rate mt-1">
                    &#64;if (count($content->comments))
                        &#64;php
                            $rateAvrage = $rateSum = 0;
                        &#64;endphp
                        &#64;foreach ($content->comments as $comment)
                            &#64;php
                                $rateSum = $rateSum + $comment['rate'];
                            &#64;endphp
                        &#64;endforeach
                        &#64;for ($i = $rateSum / count($content->comments); $i >= 1; $i--)
                            &lt;img width="20" height="20"
                                srcset="&lbrace;&lbrace; asset('/img/star1x.png') }} , &lbrace;&lbrace; asset('/img/star2x.png') }} 2x"
                                src="&lbrace;&lbrace; asset('/img/star1x.png') }}"
                                alt="&lbrace;&lbrace; 'star for rating' }}">
                        &#64;endfor
                    &#64;endif
                &lt;/div>

            &lt;/article>
        &lt;/a>
    &lt;/div>
&#64;endforeach
&#64;endisset
                </pre>
            </div>
            <div class="col-12 col-md-12">
                @lang('messages.image') :
                <pre>&lbrace;&lbrace;--images&label=banner&var=banners&count=3--&rbrace;&rbrace;
                    <button class="pull-right" onclick="copyToClipboard('&lbrace;&lbrace;--images&label=banner&var=banners&count=3--&rbrace;&rbrace;    ')">Copy</button>
                </pre>
                <pre style="background-color: #fafafa">
&#64;if (isset($banners) && isset($banners['images']))
    &#64;foreach ($banners['images'] as $k => $content)
        &lt;a href='&lbrace;&lbrace; $adv['url'][$k] &rbrace;&rbrace;' &#64;if (!isset($adv['follow'][$k])) rel="nofollow" &#64;endif>
            &lt;img src="&lbrace;&lbrace;$content&rbrace;&rbrace;" alt="&lbrace;&lbrace; $adv['name'][$k] &rbrace;&rbrace;" &gt;
        &lt;/a>
    &#64;endforeach
&#64;endisset
                </pre>
            </div>
        </div>

    </div>
</div>
<script>
    function copyToClipboard(val) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val(val).select();
        document.execCommand("copy");
        $temp.remove();
        alert('copy: ' + val)
    }

</script>

@endsection
