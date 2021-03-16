@extends(@env('TEMPLATE_NAME').'.App')
@section('bootstrap')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.rtl.min.css" integrity="sha384-4dNpRvNX0c/TdYEbYup8qbjvjaMrgUPh+g4I03CnNtANuv+VAvPL6LqdwzZKV38G" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>

@endsection
@section('Content')

    <section class="panel">
        @include('auth.nav')

        <div>
            <h1>@lang('messages.profile')</h1>
            <div>@lang('messages.store name'): {{ $user->company->name }}</div>
            <div>@lang('messages.mobile'): {{ $user->company->mobile }}</div>
            <div>@lang('messages.site'): {{ $user->company->site }}</div>
            <div>@lang('messages.email'): {{ $user->company->email }}</div>
            <div>@lang('messages.name'): {{ $user->name }}</div>
            <div>@lang('messages.register date'): {{ convertGToJ($user->date) }}</div>

            <div class="col col-3">
                <form>
                    <div class="">
                      <label for="exampleInputEmail1" class="form-label">Email address</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                      <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="">
                      <label for="exampleInputPassword1" class="form-label">Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class=" form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1">
                      <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
            </div>
        </div>
    </section>

@endsection
