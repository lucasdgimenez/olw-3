<?php

namespace App\Livewire;
use App\Services\CheckoutService;
use App\Enums\CheckoutStepsEnum;
use Livewire\Component;
use App\Livewire\Forms\AddressForm;
use App\Livewire\Forms\UserForm;

class Checkout extends Component
{
    public array $cart = [];
    public int $step = CheckoutStepsEnum::INFORMATION->value;
    public UserForm $user;
    public AddressForm $address;

    public function mount(CheckoutService $checkoutService) {
        $this->cart = $checkoutService->loadCart();
    }

    public function findAddress() {
        $this->address->findAddress();
    }

    public function submitInformationStep()
    {
        $this->user->validate();
        $this->address->validate();
        $this->step = CheckoutStepsEnum::SHIPPING->value;
    }

    public function submitShippingStep()
    {
        $this->step = CheckoutStepsEnum::PAYMENT->value;
    }

    public function render()
    {
        return view('livewire.checkout');
    }
}
