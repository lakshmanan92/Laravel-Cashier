@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div class="product">
                                <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=1999&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Product Image">
                                <div class="product-details">
                                    <div class="product-title">{{strtoupper($productDetail->product_name)}}</div>
                                    <div class="product-price">${{$productDetail->product_price}}</div>
                                    <div class="product-description">
                                        <p>{{$productDetail->product_description}}.</p>
                                    </div>
                                    <div class="product-actions">
                                        <form action="{{ route('pay') }}" method="post" id="payment-form">
                                            @csrf
                                            <input type="hidden" name="amount" value="{{$productDetail->product_price}}">
                                            <div id="card-element">
                                                <!-- A Stripe Element will be inserted here. -->
                                            </div>

                                            <!-- Used to display form errors. -->
                                            <div id="card-errors" role="alert"></div>

                                            <button type="submit">Pay ${{ number_format($productDetail->product_price, 2) }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/jquery.min.js')}}"></script>
<script src="https://js.stripe.com/v3/"></script>
<script>
    var stripe = Stripe('{{ $stripeKey }}');
    var elements = stripe.elements();
    var cardElement = elements.create('card');

    cardElement.mount('#card-element');

    var form = document.getElementById('payment-form');

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createPaymentMethod({
            type: 'card',
            card: cardElement,
        }).then(function(result) {
            if (result.error) {
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // Token generated, submit form
                stripeTokenHandler(result.paymentMethod);
            }
        });
    });

    function stripeTokenHandler(paymentMethod) {
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'payment_method');
        hiddenInput.setAttribute('value', paymentMethod.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
    }
</script>
@endsection