<?php

declare(strict_types=1);
namespace Kartenmacherei\RestFramework\Monitoring;

class VoidTransactionMonitoring implements TransactionMonitoring
{
    public function nameTransaction(string $transactionName)
    {
    }
}
