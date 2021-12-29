@extends(@env('TEMPLATE_NAME').'.App')
@section('meta-title', __('messages.Products'))

@section('Content')
    {{-- <link href="{{ url('/adminAssets/css/font-awesome.min.css') }}" rel="stylesheet"> --}}


    <section class="panel">
        @include('auth.company.nav')

        <div class="list">
            <h1 class="">@lang('messages.Products')
                <a class="btn btn-success  " id="myBtn" href="#">@lang('messages.add') @lang('messages.product') (@lang('messages.ad'))</a>
            </h1>

            <!-- The Modal -->
            <div id="myModal" class="modal">

                <!-- Modal content -->
                <div class="modal-content">
                    <form action="{{ route('company.products.create') }}">
                        <label class="text-align-right bold sm:mb-2" for="">نوع آگهی را انتخاب کنید</label>
                        <select name="attr" class="sm:mb-2" id="">
                            @foreach ($attributes as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <button class="btn-success">مرحله بعد</button>
                        <button class="close" type="button">انصراف</button>
                    </form>
                </div>
            </div>

            <script>
                // Get the modal
                var modal = document.getElementById("myModal");

                // Get the button that opens the modal
                var btn = document.getElementById("myBtn");

                // Get the <span> element that closes the modal
                var span = document.getElementsByClassName("close")[0];

                // When the user clicks on the button, open the modal
                btn.onclick = function() {
                    modal.style.display = "block";
                }

                // When the user clicks on <span> (x), close the modal
                span.onclick = function() {
                    modal.style.display = "none";
                }

                // When the user clicks anywhere outside of the modal, close it
                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                }
            </script>
            <style>
                /* The Modal (background) */
                .modal {
                    display: none;
                    /* Hidden by default */
                    position: fixed;
                    /* Stay in place */
                    z-index: 1;
                    /* Sit on top */
                    padding-top: 100px;
                    /* Location of the box */
                    left: 0;
                    top: 0;
                    width: 100%;
                    /* Full width */
                    height: 100%;
                    /* Full height */
                    overflow: auto;
                    /* Enable scroll if needed */
                    background-color: rgb(0, 0, 0);
                    /* Fallback color */
                    background-color: rgba(0, 0, 0, 0.4);
                    /* Black w/ opacity */
                }

                /* Modal Content */
                .modal-content {
                    background-color: #fefefe;
                    margin: auto;
                    padding: 20px;
                    border: 1px solid #888;
                    width: 80%;
                    -webkit-animation-name: slideIn;
                    -webkit-animation-duration: 0.4s;
                    animation-name: slideIn;
                    animation-duration: 0.4s
                }

                /* The Close Button */
                .close {
                    /* color: #aaaaaa;
                    float: right;
                    font-size: 28px;
                    font-weight: bold; */
                }

                .close:hover,
                .close:focus {
                    color: #000;
                    text-decoration: none;
                    cursor: pointer;
                }

                /* Add Animation */
                @-webkit-keyframes slideIn {
                    from {
                        bottom: -300px;
                        opacity: 0
                    }

                    to {
                        bottom: 0;
                        opacity: 1
                    }
                }

                @keyframes slideIn {
                    from {
                        bottom: -300px;
                        opacity: 0
                    }

                    to {
                        bottom: 0;
                        opacity: 1
                    }
                }

                @-webkit-keyframes fadeIn {
                    from {
                        opacity: 0
                    }

                    to {
                        opacity: 1
                    }
                }

                @keyframes fadeIn {
                    from {
                        opacity: 0
                    }

                    to {
                        opacity: 1
                    }
                }

            </style>



            @isset($user->company->contents)

                <div class="flex one two-500 three-700">

                    @foreach ($user->company->contents()->orderBy('id','desc')->paginate(9) as $content)

                        <div class="item  ">
                            <div class="info  one text-center shadow ">
                                @if (isset($content->images['images']))
                                    <div class="">
                                        <a target="_blank" class="bold" href="{{ url($content->slug) }}">
                                            <img height="100" alt="{{ $content->title }}"
                                            src="{{ $content->images['images']['small'] }}">
                                        </a>
                                    </div>
                                @endif
                                <div>
                                    <a target="_blank" class="bold" href="{{ url($content->slug) }}">
                                        {{ $content->title }} <i class="fa fa-external-link-alt"></i>
                                    </a>
                                </div>
                                <div class="font-09">دسته بندی:
                                    <a target="_blank"
                                        href="{{ url($content->category->slug) }}">{{ $content->category->title }} <i class="fa fa-external-link-alt"></i></a>
                                </div>
                                <div>
                                    @lang('messages.view'): {{ $content->viewCount }}
                                </div>
                                <div>
                                    @lang('messages.Comments'): {{ $content->comments->count() }}
                                </div>
                                <div>
                                    <i class="fa fa-bolt"></i> {{ $content->power ?? 0 }}
                                </div>


                                <div class="">
                                    <a href="{{ route('company.products.powerUp', $content->id) }}"
                                        class="btn btn-info btn-sm"><i class="fa fa-bolt"></i> @lang('messages.upgrade power')</a>


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

                        </div>
                    @endforeach

                </div>
                {{ $user->company->contents()->paginate(10)->links() }}
            @endisset


        </div>
    </section>

@endsection
