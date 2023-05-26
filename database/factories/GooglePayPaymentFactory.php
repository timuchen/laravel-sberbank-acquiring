<?php

declare(strict_types=1);

namespace Database\Factories;

use Avlyalin\SberbankAcquiring\Models\GooglePayPayment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class GooglePayPaymentFactory extends Factory
{
    protected $model = GooglePayPayment::class;

    public function definition()
    {
        return [
            'order_number' => Str::random(32),
            'description' => $this->faker->sentence,
            'language' => $this->faker->languageCode,
            'additional_parameters' => json_encode([$this->faker->word => $this->faker->word, $this->faker->word => $this->faker->word]),
            'pre_auth' => $this->faker->randomElement(['true', 'false']),
            'client_id' => Str::random(30),
            'ip' => $this->faker->ipv6,
            'amount' => $this->faker->numberBetween(),
            'currency_code' => (string)$this->faker->numberBetween(100, 999),
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'return_url' => $this->faker->url,
            'fail_url' => $this->faker->url,
            'payment_token' => Str::random(100),
        ];
    }
}

