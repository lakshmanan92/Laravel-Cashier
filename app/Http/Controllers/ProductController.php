<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productList(Request $request)
    {
        $product = Product::get();
        return view('product-list', [
            'product' => $product,
        ]);
    }
    public function productDetail(Request $request,$id){
        $productDetail = Product::find($id);
        $user = $request->user();
        $paymentIntent = $user->createSetupIntent();
        return view('product-detail', [
            'paymentIntent' => $paymentIntent,
            'productDetail' => $productDetail,
            'stripeKey' => config('services.stripe.key')
        ]);
    }
}
