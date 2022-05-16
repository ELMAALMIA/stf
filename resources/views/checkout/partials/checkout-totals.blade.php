<div class="checkout-totals">
    <div class="checkout-totals-left">
        Subtotal <br>
        {{-- Tax({{ config('cart.tax') }}%) <br> --}}
        {{-- <div class="hr"></div>
        Totale <br> --}}
        @if ($discount)
        Discount ({{ $discountPercent ? $discountPercent.'%' : $discount}} MAD)
        <form class="remove-coupon-form" action="{{ route('coupon.destroy') }}" method="post">
            @csrf
            @method('DELETE')

            <button type="submit" class="button-icon">Remove</button>
        </form>
        <br>
        @endif
        <span class="checkout-totals-total">Total</span>
    </div>

    <div class="checkout-totals-right">
        {{$subtotal }} MAD <br>
        {{-- {{ presentPrice($tax) }} <br> --}}
        <div class="hr"></div>
        {{-- {{ $newSubtotal}} MAD <br> --}}
        {{-- @if ($discount)
        -{{ presentPrice($discount) }} <br>
        @endif --}}
        <span class="checkout-totals-total">{{ $total }}</span>
    </div>
</div> <!-- end checkout-totals -->