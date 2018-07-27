<?php

declare(strict_types=1);
namespace Kartenmacherei\RestFramework\Monitoring;

interface TransactionMonitoring
{
    public function nameTransaction(string $transactionName);
}
