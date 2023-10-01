@if ($detail->attr_type == 'product' )
    <form action="{{ route('customer.cart.store') }}" method="post" class="order-form flex one ">
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
        <button class="btn btn-buy px-3   border-radius-5">
            <i class="fa fa-plus"></i>
            ثبت سفارش
        </button>
    </form>

@endif
