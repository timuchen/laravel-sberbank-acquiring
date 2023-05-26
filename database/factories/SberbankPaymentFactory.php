<?php

declare(strict_types=1);

namespace Database\Factories;

use Avlyalin\SberbankAcquiring\Models\SberbankPayment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SberbankPaymentFactory extends Factory
{
    protected $model = SberbankPayment::class;

    public function definition()
    {
        return [
            'order_number' => Str::random(32),
            'amount' => $this->faker->numberBetween(),
            'currency' => $this->faker->numberBetween(100, 999),
            'return_url' => $this->faker->url,
            'fail_url' => $this->faker->url,
            'description' => $this->faker->sentence,
            'language' => $this->faker->languageCode,
            'client_id' => Str::random(20),
            'page_view' => $this->faker->randomElement(['MOBILE', 'DESKTOP']),
            'json_params' => json_encode([$this->faker->word => $this->faker->word, $this->faker->word => $this->faker->word]),
            'session_timeout_secs' => $this->faker->randomNumber(9),
            'expiration_date' => $this->faker->dateTimeBetween('+1 hour', '+2 hour'),
            'features' => Str::random(10),
            'bank_form_url' => $this->faker->url,
        ];
    }
}

