@if ($detail->attr_type == 'product' )
    <form action="{{ route('customer.cart.store') }}" method="post" class="order-form  ">
        @csrf
        @if (\Session::has('success'))
            <div class="alert alert-success ">
                {!! \Session::get('success') !!}
            </div>
        @endif
        @if (\Session::has('error') )
            <div class="alert alert-danger ">
                {!! \Session::get('error') !!}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                {!! implode('', $errors->all('<div>:message</div>')) !!}
            </div>
        @endif

        <input type="hidden" name="id" value="{{ $detail->id }}">
        <button class="bg-lime-700 text-white  px-3 rounded-md w-full">
            <i class="fa fa-plus"></i>
            ثبت سفارش
        </button>
    </form>

@endif
