<?php

declare(strict_types=1);
namespace Kartenmacherei\RestFramework\Monitoring;

use Kartenmacherei\RestFramework\Config;
use Kartenmacherei\RestFramework\Factory;

class MonitoringLocator
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @var Factory
     */
    private $factory;

    /**
     * @param Config $config
     * @param Factory $factory
     */
    public function __construct(Config $config, Factory $factory)
    {
        $this->config = $config;
        $this->factory = $factory;
    }

    public function getTransactionMonitoring(): TransactionMonitoring
    {
        if ($this->config->isTransactionMonitoringEnabled()) {
            return $this->factory->createConcreteTransactionMonitoring();
        }

        return $this->factory->createDummyTransactionMonitoring();
    }
}
