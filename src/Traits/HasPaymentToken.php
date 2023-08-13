<?php

declare(strict_types=1);

namespace Timuchen\SberbankAcquiring\Traits;

trait HasPaymentToken
{
    /**
     * @param string $token
     *
     * @return mixed
     */
    public function setPaymentToken(string $token): void
    {
        $this->payment_token = $token;
    }

    /**
     * @return string|null
     */
    public function getPaymentToken(): ?string
    {
        return $this->payment_token;
    }
}
