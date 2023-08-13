<?php

declare(strict_types=1);

use Timuchen\SberbankAcquiring\Models\AcquiringPayment;
use Timuchen\SberbankAcquiring\Models\ApplePayPayment;
use Timuchen\SberbankAcquiring\Models\AcquiringPaymentStatus;
use Timuchen\SberbankAcquiring\Models\AcquiringPaymentSystem;
use Timuchen\SberbankAcquiring\Models\GooglePayPayment;
use Timuchen\SberbankAcquiring\Models\SamsungPayPayment;
use Timuchen\SberbankAcquiring\Models\SberbankPayment;
use Illuminate\Support\Str;

$factory->define(AcquiringPayment::class, function () {
    return [
        'bank_order_id' => Str::random(36),
        'system_id' => AcquiringPaymentSystem::SBERBANK,
        'status_id' => AcquiringPaymentStatus::all()->random()->id,
        'payment_type' => SberbankPayment::class,
        'payment_id' => SberbankPayment::factory()->create()->id,
    ];
});

$factory->state(AcquiringPayment::class, 'sberbank', function () {
    return [
        'system_id' => AcquiringPaymentSystem::SBERBANK,
        'payment_type' => SberbankPayment::class,
        'payment_id' => SberbankPayment::factory()->create()->id,
    ];
});

$factory->state(AcquiringPayment::class, 'applePay', function () {
    return [
        'system_id' => AcquiringPaymentSystem::APPLE_PAY,
        'payment_type' => ApplePayPayment::class,
        'payment_id' => ApplePayPayment::factory()->create()->id,
    ];
});

$factory->state(AcquiringPayment::class, 'samsungPay', function () {
    return [
        'system_id' => AcquiringPaymentSystem::SAMSUNG_PAY,
        'payment_type' => SamsungPayPayment::class,
        'payment_id' => SamsungPayPayment::factory()->create()->id,
    ];
});

$factory->state(AcquiringPayment::class, 'googlePay', function () {
    return [
        'system_id' => AcquiringPaymentSystem::GOOGLE_PAY,
        'payment_type' => GooglePayPayment::class,
        'payment_id' => GooglePayPayment::factory()->create()->id,
    ];
});
