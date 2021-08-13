@extends(@env('TEMPLATE_NAME').'.App')
@section('meta-title', __('messages.Products'))

@section('Content')
{{-- <link href="{{ url('/adminAssets/css/font-awesome.min.css') }}" rel="stylesheet"> --}}


<section class="panel">
    @include('auth.company.nav')

    <div class="list">
        <h1 class="">@lang('messages.Products') <a class="btn btn-success btn-sm pull-left"
                href="{{ route('company.products.create') }}">@lang('messages.add')</a></h1>

        @isset($user->company->contents)


            @foreach ($user->company->contents()->paginate(10) as $content)

                <div class="item">
                    <div class="info  one six-500">
                        @if (isset($content->images['thumb']))
                            <div>
                                <img height="100" alt="{{ $content->title }}" src="{{ $content->images['thumb'] }}">
                            </div>
                        @endif
                        <div>
                            <a target="_blank" href="{{ url($content->slug) }}">
                                {{ $content->title }}
                            </a>
                        </div>
                        <div>
                            <a target="_blank"
                                href="{{ url($content->category->slug) }}">{{ $content->category->title }}</a>
                        </div>
                        <div>
                            @lang('messages.view'): {{ $content->viewCount }}
                        </div>
                        <div>
                            @lang('messages.Comments'): {{ $content->comments->count() }}
                        </div>
                        <div>
                            <i class="fa fa-bolt"></i>{{ $content->power ?? 0 }}
                        </div>
                    </div>
                    <div class="">
                        <a href="{{ route('company.products.powerUp', $content->id) }}" class="btn btn-info btn-sm"><i
                                class="fa fa-bolt"></i> @lang('messages.upgrade power')</a>



                        <a href="{{ route('company.products.update', $content->id) }}"
                            class="btn btn-warning btn-sm">@lang('messages.edit')</a>


                        <form action="{{ route('company.products.destroy', $content->id) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button onclick="return confirm(__('messages.Are you sure?'))"
                                class="btn btn-danger btn-sm">@lang('messages.delete')</button>
                        </form>

                    </div>
                </div>
            @endforeach
            {{ $user->company->contents()->paginate(10)->links() }}
        @endisset


    </div>
</section>

@endsection
