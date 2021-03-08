@extends(@env('TEMPLATE_NAME').'.App')

@section('Content')

    <section class="login">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">

                <label for="email" class="control-label">@lang('messages.email')</label>

                <input id="email" type="email" class="form-control ltr @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') ? old('email') : 'm@m.m' }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="control-label">@lang('messages.password')</label>

                <input id="password" type="password" class="form-control ltr @error('password') is-invalid @enderror"
                    name="password" value="{{ '12345678' }}" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>


            <div class="form-group">
                <button type="submit" class="btn btn-info   btn-block">
                    <i class="fa fa-lock"></i> @lang('messages.login')
                </button>

                <a class="p-1" href="{{ route('register') }}">@lang('messages.register')</a>


            </div>
        </form>
    </section>
    <style>
        section.login {
            background-color: #fff;
            padding: 1em;
            border-radius: 5px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            margin: 5em auto
        }

    </style>

@endsection
