<?php

declare(strict_types=1);

namespace Timuchen\SberbankAcquiring\Tests\Models;

use Timuchen\SberbankAcquiring\Models\AcquiringPayment;
use Timuchen\SberbankAcquiring\Models\AcquiringPaymentOperationType;
use Timuchen\SberbankAcquiring\Tests\TestCase;

class AcquiringPaymentOperationTest extends TestCase
{
    /**
     * @test
     */
    public function it_has_user_relation()
    {
        $user = $this->createUser();
        $acquiringPaymentOperation = $this->createAcquiringPaymentOperation(['user_id' => $user->getKey()]);

        $this->assertInstanceOf(config('sberbank-acquiring.user.model'), $acquiringPaymentOperation->user);
    }

    /**
     * @test
     */
    public function it_has_payment_relation()
    {
        $acquiringPayment = $this->createAcquiringPayment();
        $acquiringPaymentOperation = $this->createAcquiringPaymentOperation(['payment_id' => $acquiringPayment->id]);

        $this->assertInstanceOf(AcquiringPayment::class, $acquiringPaymentOperation->payment);
    }

    /**
     * @test
     */
    public function it_has_type_relation()
    {
        $acquiringPaymentOperation = $this->createAcquiringPaymentOperation();

        $this->assertInstanceOf(AcquiringPaymentOperationType::class, $acquiringPaymentOperation->type);
    }
}
