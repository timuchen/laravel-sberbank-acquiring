<?php

declare(strict_types=1);

namespace Timuchen\SberbankAcquiring\Models;

use Timuchen\SberbankAcquiring\Interfaces\HasPaymentToken as HasPaymentTokenInterface;
use Timuchen\SberbankAcquiring\Traits\HasPaymentToken;

class ApplePayPayment extends BasePaymentModel implements HasPaymentTokenInterface
{
    use HasPaymentToken;

    protected $tableNameKey = 'apple_pay_payments';

    public $timestamps = false;

    protected $hidden = [
        'payment_token',
    ];

    protected $fillable = [
        'order_number',
        'description',
        'language',
        'additional_parameters',
        'pre_auth',
    ];

    protected $casts = [
        'additional_parameters' => 'array',
    ];

    protected $acquiringParamsMap = [
        'orderNumber' => 'order_number',
        'description' => 'description',
        'language' => 'language',
        'additionalParameters' => 'additional_parameters',
        'preAuth' => 'pre_auth',
    ];

    protected static function newFactory()
    {
        return ApplePayPaymentFactory::new();
    }
}
