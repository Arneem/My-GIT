<?php


interface PaymentGateway
{
    public function process(float $amount);
}

class PayPalPaymentGateway
{
    public function processPayment(float $amount)
    {
        echo "Платеж на сумму $amount руб. с помощью PayPal успешно проведен.\n";
    }
}

class StripePaymentGateway
{
    public function makePayment(float $amount)
    {
        echo "Платеж на сумму $amount руб. с помощью Stripe успешно проведен.\n";
    }
}

class PayPalAdapter implements PaymentGateway
{
    private PayPalPaymentGateway $paypalGateway;

    public function __construct(PayPalPaymentGateway $paypalGateway)
    {
        $this->paypalGateway = $paypalGateway;
    }

    public function process(float $amount)
    {
        $this->paypalGateway->processPayment($amount);
    }
}
///
class StripeAdapter implements PaymentGateway
{
    private StripePaymentGateway $stripeGateway;

    public function __construct(StripePaymentGateway $stripeGateway)
    {
        $this->stripeGateway = $stripeGateway;
    }

    public function process(float $amount)
    {
        $this->stripeGateway->makePayment($amount);
    }
}

// Пример использования
$paypalGateway = new PayPalPaymentGateway();
$paypalAdapter = new PayPalAdapter($paypalGateway);
$paypalAdapter->process(100.00); // Используем PayPal через адаптер

$stripeGateway = new StripePaymentGateway();
$stripeAdapter = new StripeAdapter($stripeGateway);
$stripeAdapter->process(150.00); // Используем Stripe через адаптер
