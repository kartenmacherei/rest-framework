<?php

declare(strict_types=1);
namespace Kartenmacherei\RestFramework\UnitTests\Monitoring;

use Kartenmacherei\RestFramework\Config;
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
    /**
     * @var Factory|PHPUnit_Framework_MockObject_MockObject
     */
    private $factoryMock;

    /**
     * @var Config|PHPUnit_Framework_MockObject_MockObject
     */
    private $configMock;

    /**
     * @var MonitoringLocator
     */
    private $monitoringLocator;

    protected function setUp()
    {
        parent::setUp();

        $this->factoryMock = $this->createMock(Factory::class);
        $this->configMock = $this->createMock(Config::class);

        $this->monitoringLocator = new MonitoringLocator($this->configMock, $this->factoryMock);
    }

    public function testGetTransactionMonitoringReturnsNewRelicMonitoring()
    {
        $expected = $this->createMock(NewRelicMonitoring::class);

        $this->configMock->expects($this->once())
            ->method('isTransactionMonitoringEnabled')
            ->willReturn(true);

        $this->factoryMock->expects($this->once())
            ->method('createConcreteTransactionMonitoring')
            ->willReturn($expected);

        $this->assertSame($expected, $this->monitoringLocator->getTransactionMonitoring());
    }

    public function testGetTransactionMonitoringReturnsDummyTransactionMonitoring()
    {
        $expected = $this->createMock(DummyTransactionMonitoring::class);

        $this->configMock->expects($this->once())
            ->method('isTransactionMonitoringEnabled')
            ->willReturn(false);

        $this->factoryMock->expects($this->once())
            ->method('createDummyTransactionMonitoring')
            ->willReturn($expected);

        $this->assertSame($expected, $this->monitoringLocator->getTransactionMonitoring());
    }
}
