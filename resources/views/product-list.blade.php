@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Product List') }}
                    <div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($product as $productValue)
                                <div class="col-md-4">
                                    <div class="product">
                                        <a href="{{url('product-detail/'.$productValue->id)}}"><img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=1999&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Product Image"></a>
                                        <div class="product-details">
                                            <div class="product-title">{{strtoupper($productValue->product_name)}}</div>
                                            <div class="product-price">${{$productValue->product_price}}</div>
                                        </div>
                                        <div>
                                            <a href="{{url('product-detail/'.$productValue->id)}}" class="btn btn-danger btn-sm" style="float: right;margin-top: -23px;">Buy Now</a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <!-- Add more product columns here if needed -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
        </script>
        @endsection