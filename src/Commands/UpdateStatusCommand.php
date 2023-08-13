<?php

declare(strict_types=1);

namespace Timuchen\SberbankAcquiring\Commands;

use Timuchen\SberbankAcquiring\Client\Client;
use Timuchen\SberbankAcquiring\Events\UpdateStatusCommandHasFailed;
use Timuchen\SberbankAcquiring\Models\AcquiringPaymentStatus;
use Timuchen\SberbankAcquiring\Repositories\AcquiringPaymentRepository;
use Illuminate\Console\Command;

class UpdateStatusCommand extends Command
{
    /**
     * Статусы по-умолчанию
     */
    public const STATUSES = [
        AcquiringPaymentStatus::NEW,
        AcquiringPaymentStatus::REGISTERED,
        AcquiringPaymentStatus::HELD,
        AcquiringPaymentStatus::ACS_AUTH,
    ];

    /**
     * @var string
     */
    protected $description = 'Update payments statuses.';

    /**
     * @var string
     */
    protected $signature = 'sberbank-acquiring:update-statuses {--id=* : Only payments with specified status id will be updated}';

    /**
     * @var Client
     */
    private $client;

    /**
     * @var AcquiringPaymentRepository
     */
    private $paymentRepository;

    /**
     * UpdateStatusCommand constructor.
     *
     * @param Client $client
     * @param AcquiringPaymentRepository $paymentRepository
     */
    public function __construct(Client $client, AcquiringPaymentRepository $paymentRepository)
    {
        parent::__construct();
        $this->client = $client;
        $this->paymentRepository = $paymentRepository;
    }

    public function handle()
    {
        $this->comment('Start updating payments statuses...');

        $exceptions = [];

        $statuses = $this->getStatuses();
        $payments = $this->paymentRepository->getByStatus($statuses);

        foreach ($payments as $payment) {
            try {
                $this->client->getOrderStatusExtended($payment->id);
            } catch (\Throwable $e) {
                $this->error("Update payment with id $payment->id failed because: {$e->getMessage()}");
                $exceptions[] = $e;
            }
        }

        if (!empty($exceptions)) {
            event(new UpdateStatusCommandHasFailed($exceptions));
            return 1;
        }
    }

    private function getStatuses(): array
    {
        $inputStatuses = $this->option('id');
        return empty($inputStatuses) ? self::STATUSES : $inputStatuses;
    }
}
