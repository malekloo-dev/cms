@extends(@env('TEMPLATE_NAME').'.App')
@section('bootstrap')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-4dNpRvNX0c/TdYEbYup8qbjvjaMrgUPh+g4I03CnNtANuv+VAvPL6LqdwzZKV38G" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"
        integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous">
    </script>


@endsection
@section('Content')

    <section class="panel ">
        @include('auth.nav')

        <div class="profile">
            <h1 class="full">@lang('messages.profile')</h1>
            <div class="flex one two-700 three-1100">
                <div class="">
                    @lang('messages.store name'):
                    <span class="text-editor">{{ $user->company->name ?? '' }}</span>
                </div>
                <div class=" ">
                    @lang('messages.name'):
                    <span class="text-editor">
                        {{ $user->company->manager ?? '' }} </span>
                </div>
                <div class="">@lang('messages.sale manager'):
                    <span class="text-editor">
                        {{ $user->company->sale_manager ?? '' }}
                    </span>
                </div>
                <div class="">@lang('messages.mobile'):
                    <span class="text-editor">
                        {{ $user->company->mobile ?? '' }}
                    </span>
                </div>
                <div class="">@lang('messages.phone'):
                    <span class="ltr">
                        @isset($user->company->phone)
                            @foreach ($user->company->phone as $item)
                                {{ $item }}
                                @if (!$loop->last)
                                    -
                                @endif
                            @endforeach
                        @endisset
                    </span>
                </div>
                <div class="">@lang('messages.site'): <span>{{ $user->company->site ?? '' }}</span></div>
                <div class="">@lang('messages.email'): <span>{{ $user->company->email ?? '' }}</span></div>
                <div class="">@lang('messages.address'): <span>{{ $user->company->address ?? '' }}</span></div>
                <div class="">@lang('messages.city'): <span>{{ $user->company->city ?? '' }}</span></div>
                <div class="">@lang('messages.province'): <span>{{ $user->company->province ?? '' }}</span></div>

                <div class="">@lang('messages.whatsapp'): <span class="ltr">{{ $user->company->whatsapp }}</span></div>
                <div class="">@lang('messages.telegram'): <span>{{ $user->company->telegram }}</span></div>
                <div class="">@lang('messages.instagram'): <span>{{ $user->company->instagram }}</span></div>
                <div class="">@lang('messages.register date'): <span>{{ convertGToJ($user->date) }}</span></div>

            </div>


        </div>

    </section>

@endsection
