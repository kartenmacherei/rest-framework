<?php
namespace Kartenmacherei\RestFramework\UnitTests;

use Kartenmacherei\NewRelic\Ensureance\Exception\EnsureNotEmptyStringException;
use Kartenmacherei\RestFramework\ActionMapper;
use Kartenmacherei\RestFramework\Config;
use Kartenmacherei\RestFramework\Factory;
use Kartenmacherei\RestFramework\Monitoring\TransactionMonitoring;
use Kartenmacherei\RestFramework\Monitoring\TransactionNameMapper;
use Kartenmacherei\RestFramework\Router\RouterChain;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

/**
 * @covers \Kartenmacherei\RestFramework\Factory
 * @uses \Kartenmacherei\RestFramework\Monitoring\MonitoringLocator
 * @uses \Kartenmacherei\RestFramework\Monitoring\TransactionNameMapper
 */
class FactoryTest extends TestCase
{
    /**
     * @var Factory
     */
    private $factory;

    /**
     * @var Config|PHPUnit_Framework_MockObject_MockObject
     */
    private $configMock;

    protected function setUp()
    {
        parent::setUp();

        $this->configMock = $this->getConfigMock();

        $this->factory = new Factory($this->configMock);
    }

    public function testCreateRouterChain()
    {
        $this->assertInstanceOf(RouterChain::class, $this->factory->createRouterChain());
    }

    public function testCreateActionMapper()
    {
        $this->assertInstanceOf(ActionMapper::class, $this->factory->createActionMapper());
    }

    public function testCreateTransactionMonitoring()
    {
        $this->assertInstanceOf(TransactionMonitoring::class, $this->factory->createTransactionMonitoring());
    }

    public function testCreateConcreteTransactionMonitoring()
    {
        $this->expectException(EnsureNotEmptyStringException::class);
        $this->expectExceptionMessage('Expected "application name" to not be empty');

        $this->factory->createConcreteTransactionMonitoring();
    }

    public function testCreateTransactionNameMapper()
    {
        $this->configMock->expects($this->once())
            ->method('getTransactionMapping')
            ->willReturn([]);

        $this->assertInstanceOf(TransactionNameMapper::class, $this->factory->createTransactionNameMapper());
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|Config
     */
    private function getConfigMock()
    {
        return $this->createMock(Config::class);
    }
}
