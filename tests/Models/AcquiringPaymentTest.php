<?php

declare(strict_types=1);

namespace Timuchen\SberbankAcquiring\Tests\Models;

use Timuchen\SberbankAcquiring\Models\ApplePayPayment;
use Timuchen\SberbankAcquiring\Models\AcquiringPaymentStatus;
use Timuchen\SberbankAcquiring\Models\AcquiringPaymentSystem;
use Timuchen\SberbankAcquiring\Models\GooglePayPayment;
use Timuchen\SberbankAcquiring\Models\SamsungPayPayment;
use Timuchen\SberbankAcquiring\Models\SberbankPayment;
use Timuchen\SberbankAcquiring\Tests\TestCase;

class AcquiringPaymentTest extends TestCase
{
    /**
     * @test
     */
    public function it_has_operations_relation()
    {
        $acquiringPayment = $this->createAcquiringPayment();
        $acquiringPaymentOperation = $this->createAcquiringPaymentOperation(['payment_id' => $acquiringPayment->id]);

        $this->assertTrue($acquiringPayment->operations->contains($acquiringPaymentOperation));
        $this->assertEquals(1, $acquiringPayment->operations->count());
    }

    /**
     * @test
     */
    public function it_has_system_relation()
    {
        $acquiringPayment = $this->createAcquiringPayment();

        $this->assertInstanceOf(AcquiringPaymentSystem::class, $acquiringPayment->system);
    }

    /**
     * @test
     */
    public function it_has_status_relation()
    {
        $acquiringPayment = $this->createAcquiringPayment();

        $this->assertInstanceOf(AcquiringPaymentStatus::class, $acquiringPayment->status);
    }

    /**
     * @test
     */
    public function it_has_sberbank_payment_morph_relation()
    {
        $acquiringPayment = $this->createAcquiringPayment([]);

        $payment = $acquiringPayment->payment;
        $this->assertInstanceOf(SberbankPayment::class, $payment);
    }

    /**
     * @test
     */
    public function it_has_apple_pay_payment_morph_relation()
    {
        $acquiringPayment = $this->createAcquiringPayment([], 'applePay');

        $payment = $acquiringPayment->payment;
        $this->assertInstanceOf(ApplePayPayment::class, $payment);
    }

    /**
     * @test
     */
    public function it_has_samsung_pay_payment_morph_relation()
    {
        $acquiringPayment = $this->createAcquiringPayment([], 'samsungPay');

        $payment = $acquiringPayment->payment;
        $this->assertInstanceOf(SamsungPayPayment::class, $payment);
    }

    /**
     * @test
     */
    public function it_has_google_pay_payment_morph_relation()
    {
        $acquiringPayment = $this->createAcquiringPayment([], 'googlePay');

        $payment = $acquiringPayment->payment;
        $this->assertInstanceOf(GooglePayPayment::class, $payment);
    }
}
