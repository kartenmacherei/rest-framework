<?php
namespace Kartenmacherei\RestFramework\UnitTests;

use Kartenmacherei\RestFramework\Token;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\Token
 */
class TokenTest extends TestCase
{
    public function testReturnsInitialStringValue()
    {
        $token = new Token('foo');
        $this->assertSame('foo', $token->asString());
    }

    public function testCreatesRandomValue()
    {
        $token1 = new Token();
        $this->assertSame(32, strlen($token1->asString()));

        $token2 = new Token();
        $this->assertSame(32, strlen($token2->asString()));

        $this->assertNotEquals($token1->asString(), $token2->asString());
    }
}
