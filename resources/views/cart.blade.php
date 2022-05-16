@extends('layout')

@section('title', 'Shopping Cart')

@section('extra-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/docs-searchbar.js/dist/cdn/docs-searchbar.min.css" />
@endsection

@section('content')

<div class="breadcrumbs">
    <div class="container">
        <div>
            <a href="{{ route('home') }}">Page d'acceuil</a>
            <i class="fa fa-chevron-right breadcrumb-separator"></i>
            <span class="visited">Panier</span>
        </div>

        @include('partials.search-form')
    </div>
</div> <!-- end breadcrumbs -->

<div class="cart-section container">
    <div>
        @if (count($errors))
        <ul class="validation-error-msg">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif

        @if (Cart::count())
        <h2>{{ Cart::count() }} produit(s) dans votre panier</h2>

        <div class="cart-table">
            @foreach (Cart::content() as $item)
            <div class="cart-table-row">
                <div class="cart-table-row-left">
                    <a href="{{ route('shop.show', $item->model->id) }}">
                        <img src="{{ $item->model->imgPath() }}" alt="{{ $item->model->name }}" class="cart-table-img">
                    </a>
                    <div class="cart-item-details">
                        <div class="cart-table-item">
                            <a href="{{ route('shop.show', $item->model->id) }}">{{ $item->model->name }}</a>
                        </div>
                        <div class="cart-table-description">{{ $item->model->details }}</div>

                        @if (! $item->model->isAvailable())
                        <span class="badge badge-danger">N'est pas disponible</span>
                        @endif
                    </div>
                </div>
                <div class="cart-table-row-right">
                    <div class="quantity-section">
                        {{-- Update quantity form --}}
                        <form class="quantity-form" action="{{ route('cart.update', $item->model) }}" method="post">
                            @csrf
                            @method('PATCH')

                            <input type="hidden" name="row_id" value="{{ $item->rowId }}">
                            <input type="number" name="quantity" class="quantity" value="{{ $item->qty }}" min="1"
                                max="{{ $item->model->quantity }}">
                        </form>

                        <div>{{ $item->subtotal() }} MAD</div>
                    </div>

                    <div class="cart-table-actions">
                        {{-- Add to wishlist form --}}
                        <form class="heart-item-form" action="{{ route('wishlist.store') }}" method="post">
                            @csrf

                            <input type="hidden" name="row_id" value="{{ $item->rowId }}">
                            <input type="hidden" name="id" value="{{ $item->model->id }}">
                            <input type="hidden" name="name" value="{{ $item->model->name }}">
                            <input type="hidden" name="price" value="{{ $item->model->price }}">
                            <button type="submit" class="button-icon" title="Add to Wishlist">
                                <i class="far fa-heart"></i>
                            </button>
                        </form>

                        {{-- Remove form cart form --}}
                        <form class="remove-item-form" action="{{ route('cart.destroy', $item->rowId) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <button type="submit" title="Remove from Cart"><span>x</span></button>
                        </form>
                    </div>
                </div>
            </div> <!-- end cart-table-row -->
            @endforeach
        </div> <!-- end cart-table -->

        <div class="cart-totals">
            <div class="cart-totals-left">
                {{-- @if (! session()->has('coupon'))
                <div class="have-coupon-container">
                    <span class="have-coupon">Have a Coupon?</span>

                    <form id="coupon-form" action="{{ route('coupon.store') }}" method="post">
                        @csrf

                        <input type="text" name="code">
                        <button type="submit" class="button-black">Apply</button>
                    </form>
                </div> <!-- end have-coupon-container -->
                @endif
            </div> --}}

            <div class="cart-totals-right">
                <div class="totals-left">
                    Subtotal: <br>
                    {{-- Tax: <span class="small-text">({{ config('cart.tax') }}%)</span> <br>
                    <div class="hr"></div> --}}
                    {{-- New Subtotal: <br>
                    @if ($discount)
                    Discount: <span class="small-text">{{ $discountPercent ? '(' .$discountPercent. '%)' : '' }}</span>
                    <form class="remove-coupon-form" action="{{ route('coupon.destroy') }}" method="post">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="button-icon-red">Remove</button>
                    </form>
                    <br>
                    @endif --}}
                    <span class="checkout-totals-total">Total:</span>
                </div>

                <div class="totals-right">

                    {{$subtotal }} MAD<br>
                    {{-- {{ presentPrice($tax) }} <br> --}}
                    <div class="hr"></div>
                    {{ $newSubtotal}} MAD <br>
                    @if ($discount)
                    {{$discount}} MAD <br>
                    @endif
                    <span class="checkout-totals-total">{{$total }} MAD</span>
                </div>
            </div>
        </div> <!-- end cart-totals -->

        <div class="cart-buttons">
            <a href="{{ route('shop.index') }}" class="button button-white">Continue l'achat</a>
            <a href="{{ auth()->user() ? route('checkout.detailsIndex') : route('loginToCheckout') }}"
                class="button button-green proceed-to-checkout-button">Terminer Votre achat</a>
            {{-- <a href="#" class="button button-green proceed-to-checkout-button">Terminer Votre achat</a> --}}
        </div>
        @else
        <div class="empty">Aucun produit dans votre panier</div>
        <div class="spacer"></div>
        <a href="{{ route('shop.index') }}" class="button button-white ">Continue l'achat</a>
        <div class="spacer"></div>
        @endif
    </div>
</div>

</div> <!-- end cart-section -->

@include('partials.might-like')

@endsection


@section('extra-js')

<script src="{{ asset('js/app.js') }}"></script>

<script>
    (function() {
            var quantityInputs = document.querySelectorAll('.quantity');
            var events = ['change', 'keydown'];

            events.forEach(function(event) {
                quantityInputs.forEach(function(input) {
                    input.addEventListener(event, function(e) {
                        var form = e.target.form;

                        if (! Boolean(form.getElementsByClassName('quantity-submit')[0])) {
                            var div = document.createElement('div');
                            div.innerHTML = '<button type="submit" class="button-blue quantity-submit">modifier</button>';

                            form.append(div);
                        }
                    });
                });
            }); 
        }());

        function showSubmitBtn() {
            console.log(e);
        }

</script>

@include('partials.js.search-section')
@endsection