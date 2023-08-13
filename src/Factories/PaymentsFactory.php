<?php

declare(strict_types=1);

namespace Timuchen\SberbankAcquiring\Factories;

use Timuchen\SberbankAcquiring\Models\AcquiringPayment;
use Timuchen\SberbankAcquiring\Models\AcquiringPaymentOperation;
use Timuchen\SberbankAcquiring\Models\SberbankPayment;
use Timuchen\SberbankAcquiring\Models\ApplePayPayment;
use Timuchen\SberbankAcquiring\Models\GooglePayPayment;
use Timuchen\SberbankAcquiring\Models\SamsungPayPayment;

class PaymentsFactory
{
    /**
     * @return AcquiringPayment
     */
    public function createAcquiringPayment(): AcquiringPayment
    {
        return new AcquiringPayment();
    }

    /**
     * @return SberbankPayment
     */
    public function createSberbankPayment(): SberbankPayment
    {
        return new SberbankPayment();
    }

    /**
     * @return ApplePayPayment
     */
    public function createApplePayPayment(): ApplePayPayment
    {
        return new ApplePayPayment();
    }

    /**
     * @return SamsungPayPayment
     */
    public function createSamsungPayPayment(): SamsungPayPayment
    {
        return new SamsungPayPayment();
    }

    /**
     * @return GooglePayPayment
     */
    public function createGooglePayPayment(): GooglePayPayment
    {
        return new GooglePayPayment();
    }

    /**
     * @return AcquiringPaymentOperation
     */
    public function createPaymentOperation(): AcquiringPaymentOperation
    {
        return new AcquiringPaymentOperation();
    }
}
