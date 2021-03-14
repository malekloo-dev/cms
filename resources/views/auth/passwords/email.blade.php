@extends(@env('TEMPLATE_NAME').'.App')

@section('Content')
    <section class="reset">

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @error('email')
            <span class="text-danger mb-2">
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            </span>
        @enderror

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group">
                <label for="email" class="control-label">@lang('messages.email')</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email" autofocus>

            </div>

            <div class="form-group row mt-1 ">
                <div class="btn btn-block">
                    <button type="submit" class="btn btn-info  mat-btn radius-all  mat-elevation-z">
                        @lang('messages.Send Password Reset Link')
                    </button>


                </div>
            </div>
        </form>
    </section>
    <section class="extra-link">
        <div class="m-0 p-0">
            <a href="{{ route('login') }}">@lang('messages.login')</a>
/
            <a href="{{ route('register') }}">@lang('messages.register')</a>

        </div>
        <a href="{{ route('password.request') }}">@lang('messages.forgot')</a>
    </section>
    
@endsection
