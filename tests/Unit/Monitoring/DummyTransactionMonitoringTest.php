<?php

declare(strict_types=1);
namespace Kartenmacherei\RestFramework\UnitTests\Monitoring;

use Kartenmacherei\RestFramework\Monitoring\DummyTransactionMonitoring;
use PHPUnit\Framework\TestCase;
/**
 * @covers \Kartenmacherei\RestFramework\Monitoring\DummyTransactionMonitoring
 */
class DummyTransactionMonitoringTest extends TestCase
{
    public function testNameTransaction()
    {
        $dummyTransactionMonitoring = new DummyTransactionMonitoring();
        $this->assertNull($dummyTransactionMonitoring->nameTransaction('foo'));
    }
}
