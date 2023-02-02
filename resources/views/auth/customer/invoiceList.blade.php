@extends(@env('TEMPLATE_NAME').'.App')
@section('meta-title', __('messages.invoices'))

@section('Content')
{{-- <link href="{{ url('/adminAssets/css/font-awesome.min.css') }}" rel="stylesheet"> --}}


<section class="panel">
    @include('auth.customer.nav')

    <div class="list">
        <h1 class="">@lang('messages.invoices') </h1>

        <div class="flex one">

            @foreach ($transactions as $content)

                <div class="item ">
                    <div class="info   ">

                        <div>
                            <a target="_blank" href="{{ url($content->transactionable->slug) }}">
                                {{ $content->transactionable->title }}
                            </a>
                        </div>

                        <div>{{ convertGtoJ($content->created_at) }}</div>
                        <div>@convertCurrency($content->price) @lang('messages.toman')</div>
                        <div>
                            <i class="fa fa-bolt"></i> {{ $content->transactionable->power }} + {{ $content->count }} -> {{ $content->transactionable->power+$content->count }}
                        </div>
                        <div>
                            {{ $content->description }}
                        </div>
                        <div>
                            @if ($content->status == 2)
                                <div class="green">@lang('messages.ok')</div>
                            @else
                                <div class="red">@lang('messages.not ok')</div>
                            @endif
                        </div>

                        <div class="">
                            <a href="{{ route('company.invoice', $content->id) }}"
                                class="btn btn-info btn-sm">@lang('messages.more') <i class="fa fa-receipt"></i></a>
                        </div>
                    </div>

                </div>
            @endforeach

        </div>

        {{-- {{ $user->company->contents()->paginate(10)->links() }} --}}



    </div>
</section>

@endsection
