<?php

declare(strict_types=1);
namespace Kartenmacherei\RestFramework\Monitoring;

class TransactionNameMapper
{
    const FALLBACK_TRANSACTION_NAME = 'transaction_name_was_not_set';

    /**
     * @var array
     */
    private $mapping;

    /**
     * @param array $mapping
     */
    public function __construct(array $mapping)
    {
        $this->mapping = $mapping;
    }

    /**
     * @param string $className
     * @return string
     */
    public function getTransactionName(string $className): string
    {
        if (!array_key_exists($className, $this->mapping)) {
            return self::FALLBACK_TRANSACTION_NAME;
        }

        return $this->mapping[$className];
    }
}
