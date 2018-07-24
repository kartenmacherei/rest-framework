<?php

declare(strict_types=1);
namespace Kartenmacherei\RestFramework\UnitTests;

use Kartenmacherei\RestFramework\Config;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\Config
 */
class ConfigTest extends TestCase
{
    const APPLICATION_NAME = 'app-name';
    const TRANSACTION_MAPPING = ['foo' => 'bar', 'baz' => 'qux'];
    const MONITORING_ENABLED = true;

    public function testGetters()
    {
        $config = new Config(
            self::APPLICATION_NAME,
            self::MONITORING_ENABLED,
            self::TRANSACTION_MAPPING
        );

        $this->assertSame(self::APPLICATION_NAME, $config->getApplicationName());
        $this->assertSame(self::MONITORING_ENABLED, $config->isTransactionMonitoringEnabled());
        $this->assertSame(self::TRANSACTION_MAPPING, $config->getTransactionMapping());
    }
}
