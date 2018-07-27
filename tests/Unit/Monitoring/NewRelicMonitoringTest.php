<?php

declare(strict_types=1);
namespace Kartenmacherei\RestFramework\UnitTests\Monitoring;

use Kartenmacherei\NewRelic\NewRelic;
use Kartenmacherei\RestFramework\Monitoring\NewRelicMonitoring;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

/**
 * @covers \Kartenmacherei\RestFramework\Monitoring\NewRelicMonitoring
 */
class NewRelicMonitoringTest extends TestCase
{
    const TRANSACTION_NAME = 'test-transaction';

    public function testNameTransaction()
    {
        /** @var NewRelic|PHPUnit_Framework_MockObject_MockObject $newRelicMock */
        $newRelicMock = $this->createMock(NewRelic::class);
        $newRelicMock->expects($this->once())
            ->method('nameTransaction')
            ->with(self::TRANSACTION_NAME);

        $newRelicMonitoring = new NewRelicMonitoring($newRelicMock);
        $newRelicMonitoring->nameTransaction(self::TRANSACTION_NAME);
    }
}
