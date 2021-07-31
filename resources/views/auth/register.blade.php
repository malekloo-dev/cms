@extends(@env('TEMPLATE_NAME').'.App')

@section('meta-title', __('messages.register'))


    @push('scripts')
        <script>
            //only number
            function setInputFilter(textbox, inputFilter) {
                ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {

                    textbox.addEventListener(event, function() {
                        this.value = this.value.replace('۰', '0');
                        this.value = this.value.replace('۱', '1');
                        this.value = this.value.replace('۲', '2');
                        this.value = this.value.replace('۳', '3');
                        this.value = this.value.replace('۴', '4');
                        this.value = this.value.replace('۵', '5');
                        this.value = this.value.replace('۶', '6');
                        this.value = this.value.replace('۷', '7');
                        this.value = this.value.replace('۸', '8');
                        this.value = this.value.replace('۹', '9');


                        if (inputFilter(this.value)) {
                            this.oldValue = this.value;
                            this.oldSelectionStart = this.selectionStart;
                            this.oldSelectionEnd = this.selectionEnd;
                        } else if (this.hasOwnProperty("oldValue")) {

                            this.value = this.oldValue;

                            this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);

                        } else {
                            this.value = "";

                        }
                    });
                });
            }

            setInputFilter(document.getElementById("mobile"), function(value) {
                return /^-?\d*$/.test(value);
            });


            setInputFilter(document.getElementById("password"), function(value) {
                return /$/.test(value);
            });


            ///////////////////////////////////////////////////////////////////////////////

        </script>

    @endpush

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

        <form method="POST" action="{{ route('register') }}">
            @csrf



            <div class="form-group row">
                <label for="mobile" class="col-md-12 col-form-label ">@lang('messages.mobile')</label>

                <div class="col-md-12">
                    <input id="mobile" type="text" class="form-control ltr @error('mobile') is-invalid @enderror"
                        name="mobile" value="{{ old('mobile') }}" required
                        placeholder="{{ __('messages.example') }}:09331181877" autocomplete="mobile">

                    @error('mobile')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-12 col-form-label ">@lang('messages.password')</label>

                <div class="col-md-12">
                    <input id="password" type="text" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
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
