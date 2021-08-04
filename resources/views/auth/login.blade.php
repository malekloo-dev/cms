@extends(@env('TEMPLATE_NAME').'.App')
@section('meta-title', __('messages.login'))


    @push('head')
        {{-- recaptcha --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <script type="text/javascript">


            function callbackThen(response) {
                document.getElementById('loading').style.display = 'none';
                document.getElementById('btn-loading').style.display = 'block';

                // read HTTP status
                console.log(response.status);

                // read Promise object
                response.json().then(function(data) {
                    console.log(data);
                });
            }

            function callbackCatch(error) {
                console.error('Error:', error);
                alert('صفحه را مجدد بارگذاری نمایید.')
            }
        </script>
        {!! htmlScriptTagJsApi([
    'action' => `{{ route('login') }}`,
    'callback_then' => 'callbackThen',
    'callback_catch' => 'callbackCatch',
]) !!}


        <style>
            #loading {
                border: 10px solid #f3f3f3;
                /* Light grey */
                border-top: 10px solid #3498db;
                /* Blue */
                border-radius: 50%;
                width: 60px;
                height: 60px;
                animation: spin 2s linear infinite;
                margin: auto
            }

            @keyframes spin {
                0% {
                    transform: rotate(0deg);
                }

                100% {
                    transform: rotate(360deg);
                }
            }

        </style>
    @endpush


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


            function showPassword() {
                var x = document.getElementById("password");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            }
        </script>
    @endpush
@section('Content')

    <section class="login">
        <form method="POST" action="">
            @csrf

            <div class="form-group">



                <label for="mobile" class="control-label">@lang('messages.mobile')</label>

                <input id="mobile" type="text" class="form-control ltr @error('mobile') is-invalid @enderror" name="mobile"
                    value="{{ old('mobile') }}" required autocomplete="mobile"
                    placeholder="{{ __('messages.example') }}:09331181877" autofocus>

                @error('mobile')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="control-label">@lang('messages.password')</label>

                <input id="password" type="password" class="form-control ltr @error('password') is-invalid @enderror"
                    name="password" value="" required autocomplete="current-password">

                <input type="checkbox" class="" id="show-password" onclick="showPassword()"> <label
                    for="show-password">@lang('messages.Show Password')</label>

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror



            </div>
            <div class="form-group">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">@lang('messages.remember')</label>

            </div>

            <div class="form-group">

                <div id="loading" style="display:block"></div>

                <button type="submit" style="display: none"  id="btn-loading" class="btn btn-info   btn-block">
                    <i class="fa fa-lock"></i> @lang('messages.login')
                </button>


            </div>
        </form>
    </section>
    <section class="extra-link">
        <a href="{{ route('register') }}">@lang('messages.register')</a>

        <a href="{{ route('password.request') }}">@lang('messages.forgot')</a>
    </section>

@endsection
