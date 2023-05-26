<?php

declare(strict_types=1);

namespace Database\Factories;

use Avlyalin\SberbankAcquiring\Models\ApplePayPayment;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplePayPaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ApplePayPayment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_number' => Str::random(32),
            'description' => $this->faker->sentence,
            'language' => $this->faker->languageCode,
            'additional_parameters' => json_encode([$this->faker->word => $this->faker->word, $this->faker->word => $this->faker->word]),
            'pre_auth' => $this->faker->randomElement(['true', 'false']),
            'payment_token' => Str::random(100),
        ];
    }
}