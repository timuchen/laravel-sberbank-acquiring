<?php

declare(strict_types=1);

namespace Timuchen\SberbankAcquiring\Tests\Factories;

use Timuchen\SberbankAcquiring\Factories\PaymentsFactory;
use Timuchen\SberbankAcquiring\Models\AcquiringPayment;
use Timuchen\SberbankAcquiring\Models\AcquiringPaymentOperation;
use Timuchen\SberbankAcquiring\Models\ApplePayPayment;
use Timuchen\SberbankAcquiring\Models\AcquiringPaymentOperationType;
use Timuchen\SberbankAcquiring\Models\AcquiringPaymentStatus;
use Timuchen\SberbankAcquiring\Models\AcquiringPaymentSystem;
use Timuchen\SberbankAcquiring\Models\GooglePayPayment;
use Timuchen\SberbankAcquiring\Models\SamsungPayPayment;
use Timuchen\SberbankAcquiring\Models\SberbankPayment;
use Timuchen\SberbankAcquiring\Tests\TestCase;

class PaymentsFactoryTest extends TestCase
{
    /**
     * @var PaymentsFactory
     */
    private $factory;

    protected function setUp(): void
    {
        parent::setUp();
        $this->factory = new PaymentsFactory();
    }

    /**
     * @test
     */
    public function it_creates_new_acquiring_payment_model()
    {
        $acquiringPayment = $this->factory->createAcquiringPayment();

        $this->assertInstanceOf(AcquiringPayment::class, $acquiringPayment);
        $this->assertFalse($acquiringPayment->exists);
    }

    /**
     * @test
     */
    public function it_creates_new_sberbank_payment_model()
    {
        $sberbankPayment = $this->factory->createSberbankPayment();

        $this->assertInstanceOf(SberbankPayment::class, $sberbankPayment);
        $this->assertFalse($sberbankPayment->exists);
    }

    /**
     * @test
     */
    public function it_creates_new_apple_pay_payment_model()
    {
        $applePayPayment = $this->factory->createApplePayPayment();

        $this->assertInstanceOf(ApplePayPayment::class, $applePayPayment);
        $this->assertFalse($applePayPayment->exists);
    }

    /**
     * @test
     */
    public function it_creates_new_samsung_pay_payment_model()
    {
        $samsungPayPayment = $this->factory->createSamsungPayPayment();

        $this->assertInstanceOf(SamsungPayPayment::class, $samsungPayPayment);
        $this->assertFalse($samsungPayPayment->exists);
    }

    /**
     * @test
     */
    public function it_creates_new_google_pay_payment_model()
    {
        $googlePayPayment = $this->factory->createGooglePayPayment();

        $this->assertInstanceOf(GooglePayPayment::class, $googlePayPayment);
        $this->assertFalse($googlePayPayment->exists);
    }

    /**
     * @test
     */
    public function it_creates_acquiring_payment_operation_model()
    {
        $operation = $this->factory->createPaymentOperation();

        $this->assertInstanceOf(AcquiringPaymentOperation::class, $operation);
        $this->assertFalse($operation->exists);
    }
}
