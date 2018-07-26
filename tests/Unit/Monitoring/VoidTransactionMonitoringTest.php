<?php

declare(strict_types=1);
namespace Kartenmacherei\RestFramework\UnitTests\Monitoring;

use Kartenmacherei\RestFramework\Monitoring\VoidTransactionMonitoring;
use PHPUnit\Framework\TestCase;
/**
 * @covers \Kartenmacherei\RestFramework\Monitoring\VoidTransactionMonitoring
 */
class VoidTransactionMonitoringTest extends TestCase
{
    public function testNameTransaction()
    {
        $voidTransactionMonitoring = new VoidTransactionMonitoring();
        $this->assertNull($voidTransactionMonitoring->nameTransaction('foo'));
    }
}
