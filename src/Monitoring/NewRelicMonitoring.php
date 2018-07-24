<?php

declare(strict_types=1);
namespace Kartenmacherei\RestFramework\Monitoring;

use Kartenmacherei\NewRelic\NewRelic;

class NewRelicMonitoring implements TransactionMonitoring
{
    /**
     * @var NewRelic
     */
    private $newRelic;

    /**
     * @var TransactionNameMapper
     */
    private $transactionNameMapper;

    /**
     * @param NewRelic $newRelic
     * @param TransactionNameMapper $transactionNameMapper
     */
    public function __construct(NewRelic $newRelic, TransactionNameMapper $transactionNameMapper)
    {
        $this->newRelic = $newRelic;
        $this->transactionNameMapper = $transactionNameMapper;
    }

    public function nameTransaction(string $transactionName)
    {
        $this->newRelic->nameTransaction($transactionName);
    }
}
