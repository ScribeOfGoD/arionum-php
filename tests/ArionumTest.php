<?php

namespace pxgamer\Arionum;

use PHPUnit\Framework\TestCase;

/**
 * Class ArionumTest
 *
 * @coversDefaultClass \pxgamer\Arionum\Arionum
 */
class ArionumTest extends TestCase
{
    // phpcs:disable Generic.Files.LineLength
    const TEST_NODE = 'https://aro.pxgamer.xyz';
    const TEST_ADDRESS = '51sJ4LbdKzhyGy4zJGqodNLse9n9JsVT2rdeH92w7cf3qQuSDJupvjbUT1UBr7r1SCUAXG97saxn7jt2edKb4v4J';
    const TEST_PUBLIC_KEY = 'PZ8Tyr4Nx8MHsRAGMpZmZ6TWY63dXWSCyk7aKeBJ6LL44w5JGSFp82Wb1Drqicuznv1qmRVQMvbmF64AeczjMtV72acGLR9RsiQ2JccemNrSPkKi8KDk72t4';
    const TEST_TRANSACTION_ID = '2bAhimfbpzbKuH2E3uFZjK2cBQ9KrUtSvHPXdnGYSqYRE6tYVkLYa9hqTZpyjp6s2ZVoxpWaz5JvgyL8sYjM8Zsq';
    const TEST_BLOCK_ID = 'ceiirEsfXyQh3Tnyp6RuSnRANAxNW7BvVGxDUzKFcBH9yHfPa1Jq2oPGH7P41X6Puwn2ajtydn1aHSPhV8X8Sg2';
    // phpcs:enable

    /**
     * @var Arionum
     */
    private $arionum;

    /**
     *
     */
    public function setUp()
    {
        $this->arionum = new Arionum();
        $this->arionum->setNodeAddress(self::TEST_NODE);
    }

    /**
     * @covers ::getAddress
     * @throws ApiException
     */
    public function testThrowsExceptionOnInvalidPublicKey()
    {
        $this->expectException(ApiException::class);
        $this->arionum->getAddress('INVALID-PUBLIC-KEY');
    }

    /**
     * @covers ::getAddress
     * @throws ApiException
     */
    public function testGetAddress()
    {
        $data = $this->arionum->getAddress(self::TEST_PUBLIC_KEY);
        $this->assertInternalType('string', $data);
        $this->assertEquals(self::TEST_ADDRESS, $data);
    }

    /**
     * @covers ::getBase58
     * @throws ApiException
     */
    public function testGetBase58()
    {
        $data = $this->arionum->getBase58('dataIsHere');
        $this->assertInternalType('string', $data);
        $this->assertEquals('6e6WaupsT6FzH2', $data);
    }

    /**
     * @covers ::getBalance
     * @throws ApiException
     */
    public function testGetBalance()
    {
        $data = $this->arionum->getBalance(self::TEST_ADDRESS);
        $this->assertInternalType('string', $data);
        $this->assertTrue(is_numeric($data));
    }

    /**
     * @covers ::getPendingBalance
     * @throws ApiException
     */
    public function testGetPendingBalance()
    {
        $data = $this->arionum->getPendingBalance(self::TEST_ADDRESS);
        $this->assertInternalType('string', $data);
        $this->assertTrue(is_numeric($data));
    }

    /**
     * @covers ::getTransactions
     * @throws ApiException
     */
    public function testGetTransactions()
    {
        $data = $this->arionum->getTransactions(self::TEST_ADDRESS);
        $this->assertInternalType('array', $data);
        $this->assertNotEmpty($data);
    }

    /**
     * @covers ::getTransaction
     * @throws ApiException
     */
    public function testGetTransaction()
    {
        $data = $this->arionum->getTransaction(self::TEST_TRANSACTION_ID);
        $this->assertInstanceOf(\stdClass::class, $data);
        $this->assertObjectHasAttribute('version', $data);
    }

    /**
     * @covers ::getPublicKey
     * @throws ApiException
     */
    public function testGetPublicKey()
    {
        $data = $this->arionum->getPublicKey(self::TEST_ADDRESS);
        $this->assertInternalType('string', $data);
        $this->assertTrue(($data === self::TEST_PUBLIC_KEY || $data === ''));
    }

    /**
     * @covers ::generateAccount
     * @throws ApiException
     */
    public function testGenerateAccount()
    {
        $data = $this->arionum->generateAccount();
        $this->assertInstanceOf(\stdClass::class, $data);
        $this->assertObjectHasAttribute('address', $data);
        $this->assertObjectHasAttribute('public_key', $data);
        $this->assertObjectHasAttribute('private_key', $data);
    }

    /**
     * @covers ::getCurrentBlock
     * @throws ApiException
     */
    public function testGetCurrentBlock()
    {
        $data = $this->arionum->getCurrentBlock();
        $this->assertInstanceOf(\stdClass::class, $data);
        $this->assertObjectHasAttribute('id', $data);
        $this->assertObjectHasAttribute('signature', $data);
    }

    /**
     * @covers ::getBlock
     * @throws ApiException
     */
    public function testGetBlock()
    {
        $data = $this->arionum->getBlock(1);
        $this->assertInstanceOf(\stdClass::class, $data);
        $this->assertObjectHasAttribute('id', $data);
        $this->assertObjectHasAttribute('signature', $data);
    }

    /**
     * @covers ::getBlockTransactions
     * @throws ApiException
     */
    public function testGetBlockTransactions()
    {
        $data = $this->arionum->getBlockTransactions(self::TEST_BLOCK_ID);
        $this->assertInternalType('array', $data);
        $this->assertNotEmpty($data);
    }
}
