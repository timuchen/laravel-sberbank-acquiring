<?php
namespace Timuchen\SberbankAcquiring\Tests;

use Timuchen\SberbankAcquiring\Providers\AcquiringServiceProvider;
use Timuchen\SberbankAcquiring\Models\AcquiringPayment;
use Timuchen\SberbankAcquiring\Models\AcquiringPaymentOperation;
use Timuchen\SberbankAcquiring\Models\ApplePayPayment;
use Timuchen\SberbankAcquiring\Models\GooglePayPayment;
use Timuchen\SberbankAcquiring\Models\SamsungPayPayment;
use Timuchen\SberbankAcquiring\Models\SberbankPayment;
use Illuminate\Foundation\Application;
use Orchestra\Testbench\TestCase as Orchestra;
use ReflectionClass;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        \Illuminate\Database\Eloquent\Factories\Factory::guessFactoryNamesUsing(
            function (string $modelName) {
                return 'Database\Factories\\' . class_basename($modelName) . 'Factory';
            }
        );

        $this->setUpDatabase($this->app);
    }

    protected function getPackageProviders($app)
    {
        return [AcquiringServiceProvider::class];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    /**
     * @param Application $app
     */
    private function setUpDatabase(Application $app)
    {
        $this->loadMigrationsFrom(__DIR__ . '/../vendor/laravel/laravel/database/migrations');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    protected function createUser(array $attributes = [])
    {
        $userModel = config('sberbank-acquiring.user.model');
        return $userModel::factory()->create($attributes);
    }

    protected function createAcquiringPayment(array $attributes = [], ...$states): AcquiringPayment
    {
        return AcquiringPayment::factory()->states($states)->create($attributes);
    }

    protected function createSberbankPayment(array $attributes = []): SberbankPayment
    {
        return SberbankPayment::factory()->create($attributes);
    }

    protected function createApplePayPayment(array $attributes = []): ApplePayPayment
    {
        return ApplePayPayment::factory()->create($attributes);
    }

    protected function createSamsungPayPayment(array $attributes = []): SamsungPayPayment
    {
        return SamsungPayPayment::factory()->create($attributes);
    }

    protected function createGooglePayPayment(array $attributes = []): GooglePayPayment
    {
        return GooglePayPayment::factory()->create($attributes);
    }

    protected function createAcquiringPaymentOperation(array $attributes = []): AcquiringPaymentOperation
    {
        return AcquiringPaymentOperation::factory()->create($attributes);
    }

    protected function mockAcquiringPayment(string $method, $returnValue)
    {
        $acquiringPayment = \Mockery::mock(AcquiringPayment::class . "[$method]");
        $acquiringPayment->shouldReceive($method)->andReturn($returnValue);
        return $acquiringPayment;
    }

    protected function mockSberbankPayment(string $method, $returnValue)
    {
        $sberbankPayment = \Mockery::mock(SberbankPayment::class . "[$method]");
        $sberbankPayment->shouldReceive($method)->andReturn($returnValue);
        return $sberbankPayment;
    }

    protected function mockAcquiringPaymentOperation(string $method, $returnValue)
    {
        $operation = \Mockery::mock(AcquiringPaymentOperation::class . "[$method]");
        $operation->shouldReceive($method)->andReturn($returnValue);
        return $operation;
    }

    /**
     * Записывает значение в свойство объекта
     *
     * @param $object
     * @param $property
     * @param $value
     */
    protected function setProtectedProperty($object, $property, $value)
    {
        $reflection = new ReflectionClass($object);
        $reflection_property = $reflection->getProperty($property);
        $reflection_property->setAccessible(true);
        $reflection_property->setValue($object, $value);
    }
}

