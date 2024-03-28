@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Complete Payment</div>

                <div class="card-body">
                    <form id="complete-payment-form">
                        <div class="form-group row">
                            <label for="payment_intent" class="col-md-4 col-form-label text-md-right">Payment Intent ID:</label>

                            <div class="col-md-6">
                                <input id="payment_intent" type="text" class="form-control" name="payment_intent" value="{{ $paymentIntent->id }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="{{route('product.list')}}" id="complete-payment-button" class="btn btn-primary">
                                    Complete Payment
</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
