@extends(@env('TEMPLATE_NAME').'.App')

@section('meta-title', __('messages.register').' | درب کالا')
@section('meta-description','فرم ثبت نام ')


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
    'action' => 'register' ,
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
        <h1>@lang('messages.register')</h1>

        <form method="POST" action="">
            @csrf

            <div class="form-group row">
                <label for="mobile" class="col-md-12 col-form-label ">@lang('messages.mobile')</label>

                <div class="col-md-12">
                    <input id="mobile" type="tel" class="rounded h-10 px-2 w-full focus:border-gray-400 ltr @error('mobile') is-invalid @enderror"
                        name="mobile" value="{{ old('mobile') }}" required
                        placeholder="{{ __('messages.example') }}:09331181877" autocomplete="mobile">

                    @error('mobile')
                        <span class="red" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-1">
                <label for="password" class="col-md-12 col-form-label ">@lang('messages.password')</label>

                <div class="col-md-12">
                    <input id="password" type="text" autocomplete="off"  class="rounded h-10 px-2 w-full focus:border-gray-400  @error('password') is-invalid @enderror"
                        name="password" required autocomplete="password">

                    @error('password')
                        <span class="red" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>


            <div class="form-group row">
                <label for="parent_id" class="col-md-12 col-form-label ">@lang('messages.job')</label>

                <div class="col-md-12">
                    <select id="parent_id" class="rounded h-10 px-2 w-full focus:border-gray-400" name="parent_id"  required>
                        @foreach ($category as $Key => $fields)
                            <option value="{{ $fields['id'] }}" {{ (old('parent_id') == $fields['id'])?'selected':''; }}>{!! $fields['symbol'] . $fields['title'] !!}</option>
                        @endforeach
                    </select>
                    {{-- <input id="mobile" type="text" class="form-control ltr @error('mobile') is-invalid @enderror"
                        name="mobile" value="{{ old('mobile') }}" required
                        placeholder="{{ __('messages.example') }}:09331181877" autocomplete="mobile"> --}}

                    @error('parent_id')
                        <span class="red" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>


            <div class="form-group row mb-0 mt-1">
                <div class="col-md-12 pull-right">
                    <div id="loading" ></div>
                    <button type="submit" id="btn-loading" style="display: none" class="text-white bg-blue-700 btn-inherit block  ">
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

    <style>.red{color: red}</style>

@endsection
