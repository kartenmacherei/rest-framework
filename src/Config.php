<?php

declare(strict_types=1);
namespace Kartenmacherei\RestFramework;

class Config
{
    const FALLBACK_TRANSACTION_NAME = 'transaction_name_was_not_set';
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

    /**
     * @param string $className
     * @return string
     */
    public function getTransactionName(string $className): string
    {
        if (!array_key_exists($className, $this->transactionNamesMapping)) {
            return self::FALLBACK_TRANSACTION_NAME;
        }

        return $this->transactionNamesMapping[$className];
    }
}
