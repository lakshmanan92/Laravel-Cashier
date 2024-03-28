<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;
use Laravel\Cashier\Exceptions\IncompletePayment;
use Stripe\PaymentIntent;
use Stripe\Stripe;
class PaymentController extends Controller
{
    public function pay(Request $request)
    {
        $user = $request->user();
        $user->createOrGetStripeCustomer();
        $user->updateDefaultPaymentMethod($request->payment_method);
    
        try {
            $user->charge($request->amount, $request->payment_method);
            return redirect()->route('product.list')->with('success', 'Payment successful.');
        } catch (IncompletePayment $exception) {
            $paymentIntent = $exception->payment->asStripePaymentIntent();
            return redirect()->route('handleIncompletePayment', ['paymentIntent' => $paymentIntent->id]);
        }
    }
    public function handleIncompletePayment(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));
        $paymentIntentId = $request->paymentIntent;
        $paymentIntent = \Stripe\PaymentIntent::retrieve($paymentIntentId);
        return view('complete-payment', [
            'paymentIntent' => $paymentIntent,
            'stripeKey' => config('services.stripe.key')
        ]);
    }
}
