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
                <label for="name" class="col-md-12 col-form-label">{{ __('Name') }}</label>

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
                <label for="email" class="col-md-12 col-form-label ">{{ __('E-Mail Address') }}</label>

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
                <label for="password" class="col-md-12 col-form-label ">{{ __('Password') }}</label>

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
                    class="col-md-12 col-form-label ">{{ __('Confirm Password') }}</label>

                <div class="col-md-12">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                        autocomplete="new-password">

                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-12 pull-right">
                    <button type="submit" class="btn btn-success btn-block pull-right mat-btn ">
                        {{ __('Register') }}
                    </button>

                </div>
            </div>
        </form>
    </section>
    <style>

        section.register {
            background-color: #fff;
            padding: 1em;
            border-radius: 5px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            margin: 5em auto
        }

    </style>

@endsection
