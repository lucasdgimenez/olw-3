<?php 

namespace App\Services;
use App\Models\Order;
use App\Enums\OrderStatusEnum;
use Database\Seeders\OrderSeeder;

class CheckoutService {

    public function loadCart(): array {
        $cart = Order::with('skus.product', 'skus.features')
            ->where('status', OrderStatusEnum::CART)
            ->where(function($query) {
                $query->where('session_id', session()->getId());
                if (auth()->check()) {
                    $query->orWhere('user_id', auth()->user()->id);
                }
            })->first();

        /*if (!$cart && config('app.env') == 'local') {
            $seed = new OrderSeeder();
            $seed->run(session()->getId());
            return $this->loadCart();
        }*/

        //dd($cart);

        return $cart->toArray();
    }
}
