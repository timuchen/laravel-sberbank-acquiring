<?php

declare(strict_types=1);

namespace Timuchen\SberbankAcquiring\Models;

class SberbankPayment extends BasePaymentModel
{
    protected $tableNameKey = 'sberbank_payments';

    public $timestamps = false;

    protected $fillable = [
        'order_number',
        'amount',
        'currency',
        'return_url',
        'fail_url',
        'description',
        'client_id',
        'language',
        'page_view',
        'json_params',
        'session_timeout_secs',
        'expiration_date',
        'features',
        'bank_form_url',
    ];

    protected $casts = [
        'json_params' => 'array',
    ];

    protected $acquiringParamsMap = [
        'orderNumber' => 'order_number',
        'amount' => 'amount',
        'currency' => 'currency',
        'returnUrl' => 'return_url',
        'failUrl' => 'fail_url',
        'description' => 'description',
        'language' => 'language',
        'clientId' => 'client_id',
        'pageView' => 'page_view',
        'jsonParams' => 'json_params',
        'sessionTimeoutSecs' => 'session_timeout_secs',
        'expirationDate' => 'expiration_date',
        'features' => 'features',
    ];
}
