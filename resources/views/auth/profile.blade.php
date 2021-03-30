@extends(@env('TEMPLATE_NAME').'.App')
@section('Content')

    <section class="panel ">
        @include('auth.nav')

        <div class="profile">
            <h1 class="full">@lang('messages.profile')</h1>
            <div class="flex one two-700 three-1100">
                <div class="">
                    @lang('messages.store name'):
                    <span class="text-editor" data-field='name'
                        data-label="@lang('messages.store name')">{{ $user->company->name ?? '' }}</span>
                </div>
                <div class=" ">
                    @lang('messages.name'):
                    <span class="text-editor" data-field="manager"
                        data-label="@lang('messages.name')">{{ $user->company->manager ?? '' }}</span>
                </div>
                <div class="">@lang('messages.sale manager'):
                    <span class="text-editor" data-field="sale_manager"
                        data-label="@lang('messages.sale manager')">{{ $user->company->sale_manager ?? '' }}</span>
                </div>
                <div class="">@lang('messages.mobile'):
                    <span class="text-editor" data-field="mobile"
                        data-label="@lang('messages.mobile')">{{ $user->company->mobile ?? '' }}</span>
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
                <div class="">@lang('messages.site'):
                    <span class="text-editor" data-field="site"
                        data-label="@lang('messages.site')">{{ $user->company->site ?? '' }}</span>
                </div>

                <div class="">@lang('messages.email'): <span class="text-editor" data-field="email"
                        data-label="@lang('messages.email')">{{ $user->company->email ?? '' }}</span>
                </div>

                <div class="">@lang('messages.address'): <span class="text-editor" data-field="address"
                        data-label="@lang('messages.address')">{{ $user->company->address ?? '' }}</span></div>

                <div class="">@lang('messages.city'): <span class="text-editor" data-field="city"
                        data-label="@lang('messages.city')">{{ $user->company->city ?? '' }}</span>
                </div>

                <div class="">@lang('messages.province'): <span class="text-editor" data-field="province"
                        data-label="@lang('messages.province')">{{ $user->company->province ?? '' }}</span></div>

                <div class="">@lang('messages.whatsapp'): <span class="ltr text-editor" data-field="whatsapp"
                        data-label="@lang('messages.whatsapp')">{{ $user->company->whatsapp ?? '' }}</span>
                </div>

                <div class="">@lang('messages.telegram'): <span class="text-editor" data-field="telegram"
                        data-label="@lang('messages.telegram')">{{ $user->company->telegram ?? '' }}</span></div>

                <div class="">@lang('messages.instagram'): <span class="text-editor" data-field="instagram"
                        data-label="@lang('messages.instagram')">{{ $user->company->instagram ?? '' }}</span></div>

                <div class="">@lang('messages.register date'): <span>{{ convertGToJ($user->date) }}</span></div>

            </div>


        </div>

    </section>

@endsection

@section('footer')
    <script>
        $.each($('.profile .text-editor'), function(i, n) {
            $(this).append(
                '<img class="fa-edit" style="padding:0 0.5em" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAABmJLR0QA/wD/AP+gvaeTAAACxUlEQVQ4jZ3ST2hcVRTH8e959735E0V3rmwpuOomWUygCsGW2IYxUxcWkjShxYCTl1WQoRtxlYUoqBsZSe1tUsVgF01L/0hc1WZqqOgipNiAq64KWbhIUmn+jPPuPd3Ma0NMTNKzutzD+fA7lyu8WEkcx58AReCytfZ82jAvog0NDb0vIheAg0Cpvb09mJubq+0brFQq+ba2tq+iKJr03kfAW83W0RTdF9ja2toLfOG974qiaMh7nwHeTNFCofD3nsCenp5MR0fHl0EQ/KCqS8CZJlr23ueAIwCq+tKu4MjISDaTyVwDBoCatfb7QqFQ34R+6JzLi8gREflGdsPq9fo1oEtV+7z3D4Ig+FpEPgDKwOfA/SiKjjcajU5r7dUdEw4ODuaA68AJoNd7v2CMmRGRAvCqtfbjNKmqvmat/Qwg3AnLZDLXgU6gF3hgjKkBrwN319fXzw0PD/eLyCXn3KNsNvtTOvuflSuVSn51dfUGcExEelV1AZgBDjSxUj6fPwOcB3601p7dPB9sg90CjgF9SZLcB24DB0RkNgzDky0tLaeBMWDeOffR1kDPEsZx3ALcBN4G+pxz8801D4nIrDGm2znXp6pWROaTJOmamJhY2goGAKOjo2GKqWqPMeZPY8yvwCFgRlWLjUajX1Ut8IeqvrMd9gxcXFzsBI6rajkMwwXn3AxwUETuACeBARH5Fvg9m80WrbWPt8M2v2EJeJLL5a547weAV4BfVPU9EekHLgC/JUlSrFar/+yEwfNvUwJuV6vVOvBpHMfLwHeqehqwInLPGNNtrX3yfxhAUC6XDwNvqOrP6eXy8vJFVR0UkYvA7Nra2rtjY2O7YgChiJQARKQYx7GKSLeqngBeVtV7GxsbpcnJydW9YOnKpeb5FHBKVR8Cl4DplZWV2tTU1L97xdKES6paA6ZVdXp8fPyv/QBb6ylonDPZbLKXSwAAAABJRU5ErkJggg==">'
            )
        });

        $('.profile .text-editor').click(function() {

            $('.profile-editor-modal input[type=text]').attr('name', '');
            $('.profile-editor-modal label').html('');
            var field = $(this).data('field');
            var label = $(this).data('label');
            var val = $(this).text();
            $('#edit-profile').modal('show');
            $('.profile-editor-modal input[type=text]').attr('name', field);
            $('.profile-editor-modal input[type=text]').val(val);
            $('.profile-editor-modal label').html(label);

        });


        $('#edit-profile form').submit(function(e) {
            // e.preventDefault();
            e.stopPropagation();

            alert(1);

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('company.profile.update') }}",
                data: {
                    '_token': $('meta[name="_token"]').attr('content'),
                    'fileName': fileName,
                    'image': base64data
                },
                success: function(data) {
                    $modal.modal('hide');
                    $('.company-logo svg').hide();
                    $('.company-logo img').show();
                    $('.company-logo img').attr('src', data.url);

                    // alert("success upload image");
                }
            });
        });

    </script>


    <div class="modal fade profile-editor-modal" id="edit-profile" style="" id="modal" tabindex="-1" role="dialog"
        aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="#" >
                                    <label for=""></label>
                                    <input type="text" name="">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('messages.cancel')</button>
                    <button type="submit" class="btn btn-primary" id="edit">@lang('messages.edit')</button>
                </div>
            </div>
        </div>
    </div>
@endsection
