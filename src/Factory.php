<?php
namespace Kartenmacherei\RestFramework;

use Kartenmacherei\NewRelic\NewRelicFactory;
use Kartenmacherei\RestFramework\Monitoring\MonitoringLocator;
use Kartenmacherei\RestFramework\Monitoring\NewRelicMonitoring;
use Kartenmacherei\RestFramework\Monitoring\VoidTransactionMonitoring;
use Kartenmacherei\RestFramework\Monitoring\TransactionMonitoring;
use Kartenmacherei\RestFramework\Monitoring\TransactionNameMapper;
use Kartenmacherei\RestFramework\Router\RouterChain;

class Factory
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * @return RouterChain
     */
    public function createRouterChain(): RouterChain
    {
        return new RouterChain();
    }

    /**
     * @return ActionMapper
     */
    public function createActionMapper(): ActionMapper
    {
        return new ActionMapper();
    }

    public function createTransactionMonitoring(): TransactionMonitoring
    {
        return $this->createMonitoringLocator()->getTransactionMonitoring();
    }

    /**
     * @codeCoverageIgnore
     */
    public function createConcreteTransactionMonitoring(): TransactionMonitoring
    {
        $appName = $this->config->getApplicationName();
        $newRelicAgent = $this->createNewRelicFactory()->createNewRelicAgent($appName);

        return new NewRelicMonitoring($newRelicAgent);
    }

    public function createVoidTransactionMonitoring(): TransactionMonitoring
    {
        return new VoidTransactionMonitoring();
    }

    public function createTransactionNameMapper(): TransactionNameMapper
    {
        return new TransactionNameMapper($this->config->getTransactionMapping());
    }

    private function createMonitoringLocator(): MonitoringLocator
    {
        return new MonitoringLocator($this->config->isTransactionMonitoringEnabled(), $this);
    }

    private function createNewRelicFactory(): NewRelicFactory
    {
        return new NewRelicFactory();
    }
}
