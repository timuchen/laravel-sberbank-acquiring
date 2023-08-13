<?php

declare(strict_types=1);

namespace Database\Factories;

use Timuchen\SberbankAcquiring\Models\AcquiringPayment;
use Timuchen\SberbankAcquiring\Models\AcquiringPaymentOperation;
use Timuchen\SberbankAcquiring\Models\AcquiringPaymentOperationType;
use Illuminate\Database\Eloquent\Factories\Factory;

class AcquiringPaymentOperationFactory extends Factory
{
    protected $model = AcquiringPaymentOperation::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory()->create()->getKey(),
            'payment_id' => AcquiringPayment::factory()->create()->id,
            'type_id' => AcquiringPaymentOperationType::all()->random()->id,
            'request_json' => json_encode([$this->faker->word => $this->faker->word, $this->faker->word => $this->faker->word]),
            'response_json' => json_encode([$this->faker->word => $this->faker->word, $this->faker->word => $this->faker->word]),
        ];
    }
}


