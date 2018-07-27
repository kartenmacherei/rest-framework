<?php

declare(strict_types=1);
namespace Kartenmacherei\RestFramework;

class Config
{
    const DISABLE_MONITORING = false;
    const ENABLE_MONITORING = true;

    /**
     * @var string
     */
    private $applicationName;

    /**
     * @var bool
     */
    private $isTransactionMonitoringEnabled;

    /**
     * @var array
     */
    private $transactionNamesMapping;

    /**
     * @param string $applicationName
     * @param bool $isTransactionMonitoringEnabled
     * @param array $transactionNamesMapping
     */
    public function __construct(string $applicationName, bool $isTransactionMonitoringEnabled, array $transactionNamesMapping)
    {
        $this->applicationName = $applicationName;
        $this->isTransactionMonitoringEnabled = $isTransactionMonitoringEnabled;
        $this->transactionNamesMapping = $transactionNamesMapping;
    }

    /**
     * @return string
     */
    public function getApplicationName(): string
    {
        return $this->applicationName;
    }

    /**
     * @return bool
     */
    public function isTransactionMonitoringEnabled(): bool
    {
        return $this->isTransactionMonitoringEnabled;
    }

    public function getTransactionMapping(): array
    {
        return $this->transactionNamesMapping;
    }
}
