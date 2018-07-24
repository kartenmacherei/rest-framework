<?php

declare(strict_types=1);
namespace Kartenmacherei\RestFramework\UnitTests\Monitoring;

use Kartenmacherei\RestFramework\Factory;
use Kartenmacherei\RestFramework\Monitoring\DummyTransactionMonitoring;
use Kartenmacherei\RestFramework\Monitoring\MonitoringLocator;
use Kartenmacherei\RestFramework\Monitoring\NewRelicMonitoring;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

/**
 * @covers \Kartenmacherei\RestFramework\Monitoring\MonitoringLocator
 */
class MonitoringLocatorTest extends TestCase
{
    const MONITORING_ENABLED = true;
    const MONITORING_DISABLED = false;

    public function testGetTransactionMonitoringReturnsNewRelicMonitoring()
    {
        $expected = $this->createMock(NewRelicMonitoring::class);

        $factoryMock = $this->getFactoryMock();
        $factoryMock->expects($this->once())
            ->method('createConcreteTransactionMonitoring')
            ->willReturn($expected);

        $monitoringLocator = new MonitoringLocator(self::MONITORING_ENABLED, $factoryMock);

        $this->assertSame($expected, $monitoringLocator->getTransactionMonitoring());
    }

    public function testGetTransactionMonitoringReturnsDummyTransactionMonitoring()
    {
        $expected = $this->createMock(DummyTransactionMonitoring::class);

        $factoryMock = $this->getFactoryMock();
        $factoryMock->expects($this->once())
            ->method('createDummyTransactionMonitoring')
            ->willReturn($expected);

        $monitoringLocator = new MonitoringLocator(self::MONITORING_DISABLED, $factoryMock);

        $this->assertSame($expected, $monitoringLocator->getTransactionMonitoring());
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|Factory
     */
    private function getFactoryMock()
    {
        return $this->createMock(Factory::class);
    }
}
