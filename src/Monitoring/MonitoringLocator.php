<?php

declare(strict_types=1);
namespace Kartenmacherei\RestFramework\Monitoring;

use Kartenmacherei\RestFramework\Factory;

class MonitoringLocator
{
    /**
     * @var bool
     */
    private $isTransactionMonitoringEnabled;

    /**
     * @var Factory
     */
    private $factory;

    /**
     * @param bool $isTransactionMonitoringEnabled
     * @param Factory $factory
     */
    public function __construct(bool $isTransactionMonitoringEnabled, Factory $factory)
    {
        $this->isTransactionMonitoringEnabled = $isTransactionMonitoringEnabled;
        $this->factory = $factory;
    }

    public function getTransactionMonitoring(): TransactionMonitoring
    {
        if ($this->isTransactionMonitoringEnabled) {
            return $this->factory->createConcreteTransactionMonitoring();
        }

        return $this->factory->createVoidTransactionMonitoring();
    }
}
