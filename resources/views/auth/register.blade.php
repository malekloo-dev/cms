@extends(@env('TEMPLATE_NAME').'.App')

@section('Content')
    <section class="register">
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif

        @if (\Session::has('error'))
            <div class="alert alert-danger">
                <ul>
                    <li>{!! \Session::get('error') !!}</li>
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" >
            @csrf

            <div class="form-group row">
                <label for="name" class="col-md-12 col-form-label">@lang('messages.name')</label>

                <div class="col-md-12">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-12 col-form-label ">@lang('messages.email')</label>

                <div class="col-md-12">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-12 col-form-label ">@lang('messages.password')</label>

                <div class="col-md-12">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm"
                    class="col-md-12 col-form-label ">@lang('messages.confirm') @lang('messages.password')</label>

                <div class="col-md-12">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                        autocomplete="new-password">

                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-12 pull-right">
                    <button type="submit" class="btn btn-success btn-block pull-right mat-btn ">
                        @lang('messages.register')
                    </button>

                </div>
            </div>
        </form>
    </section>
    <section class="extra-link">
        <a href="{{ route('login') }}">@lang('messages.login')</a>

        <a href="{{ route('password.request') }}">@lang('messages.forgot')</a>
    </section>

@endsection
