<?php

declare(strict_types=1);
namespace Kartenmacherei\RestFramework\UnitTests\Monitoring;

use Kartenmacherei\RestFramework\Monitoring\TransactionNameMapper;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\Monitoring\TransactionNameMapper
 */
class TransactionNameMapperTest extends TestCase
{
    const MAPPING = [
        'foo' => 'bar',
        'baz' => 'qux',
    ];

    public function testGetTransactionName()
    {
        $transactionNameMapper = new TransactionNameMapper(self::MAPPING);

        $this->assertSame('bar', $transactionNameMapper->getTransactionName('foo'));
        $this->assertSame('qux', $transactionNameMapper->getTransactionName('baz'));
        $this->assertSame('transaction_name_was_not_set', $transactionNameMapper->getTransactionName('foobarbaz'));
    }
}
