<?php
namespace Timuchen\SberbankAcquiring\Providers;

use Timuchen\SberbankAcquiring\Client\ApiClient;
use Timuchen\SberbankAcquiring\Client\ApiClientInterface;
use Timuchen\SberbankAcquiring\Client\Client;
use Timuchen\SberbankAcquiring\Client\Curl\Curl;
use Timuchen\SberbankAcquiring\Client\Curl\CurlInterface;
use Timuchen\SberbankAcquiring\Client\HttpClient;
use Timuchen\SberbankAcquiring\Client\HttpClientInterface;
use Timuchen\SberbankAcquiring\Commands\UpdateStatusCommand;
use Timuchen\SberbankAcquiring\Factories\PaymentsFactory;
use Timuchen\SberbankAcquiring\Models\AcquiringPayment;
use Timuchen\SberbankAcquiring\Models\AcquiringPaymentStatus;
use Timuchen\SberbankAcquiring\Repositories\AcquiringPaymentRepository;
use Timuchen\SberbankAcquiring\Repositories\AcquiringPaymentStatusRepository;
use Illuminate\Support\ServiceProvider;

class AcquiringServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/sberbank-acquiring.php',
            'sberbank-acquiring'
        );

        $this->app->register(EventServiceProvider::class);

        $this->registerBindings();

        $this->registerCommands();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/sberbank-acquiring.php' => config_path('sberbank-acquiring.php'),
        ], 'config');
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
    }

    /**
     * Регистрация биндингов
     */
    private function registerBindings()
    {
        $this->app->bind(CurlInterface::class, Curl::class);
        $this->app->bind(HttpClientInterface::class, HttpClient::class);
        $this->app->bind(ApiClientInterface::class, function ($app) {
            $httpClient = $app->make(HttpClientInterface::class);
            return new ApiClient(['httpClient' => $httpClient]);
        });
        $this->app->singleton(PaymentsFactory::class, function ($app) {
            return new PaymentsFactory();
        });
        $this->app->singleton(AcquiringPaymentRepository::class, function ($app) {
            return new AcquiringPaymentRepository(new AcquiringPayment());
        });
        $this->app->singleton(AcquiringPaymentStatusRepository::class, function ($app) {
            return new AcquiringPaymentStatusRepository(new AcquiringPaymentStatus());
        });
        $this->app->bind(Client::class, Client::class);
    }

    private function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                UpdateStatusCommand::class,
            ]);
        }
    }
}
