<?php

namespace App\Http\Controllers;

use App\Events\OrderCreated;
use App\Models\Order;
use App\Services\CartService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class CheckoutController extends Controller
{
    public function index(CartService $cart)
    {
        return view('checkout.index', [
            'cart' => $cart->getCart(),
        ]);
    }

    public function store(Request $request, CartService $cart): RedirectResponse
    {
        $validated = $request->validate([
            'full_name' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'required|email',
            'shipping_address' => 'required',
            'coupon_code' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $order = $cart->getCart()->order()->save(
            Order::factory()->make($validated)
        );
        OrderCreated::dispatch($order);

        return redirect(URL::signedRoute('orders.complete', ['order' => $order->id]));
    }

    public function show(Request $request, Order $order)
    {
        if (! $request->hasValidSignature()) {
            abort(401);
        }

        return view('checkout.show', compact('order'));
    }
}
