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
     * @param NewRelic $newRelic
     */
    public function __construct(NewRelic $newRelic)
    {
        $this->newRelic = $newRelic;
    }

    public function nameTransaction(string $transactionName)
    {
        $this->newRelic->nameTransaction($transactionName);
    }
}
