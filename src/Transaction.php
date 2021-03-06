<?php

namespace pxgamer\Arionum;

/**
 * Class Transaction
 */
class Transaction
{
    /**
     * The value to send in the transaction.
     * @var float
     */
    public $val;
    /**
     * The destination address.
     * @var string
     */
    public $dst;
    /**
     * The sender's public key.
     * @var string
     */
    public $public_key;
    /**
     * The transaction signature.
     * It's recommended that the transaction is signed to avoid sending your private key to the node.
     * @var string
     */
    public $signature;
    /**
     * The sender's private key. Only required if no signature is provided.
     * @var string
     */
    public $private_key;
    /**
     * The transaction date in unix timestamp format.
     * This is required when the transaction is pre-signed.
     * @var int
     * @see https://epochconverter.com
     */
    public $date;
    /**
     * A message to be included with the transaction. Maximum 128 chars.
     * @var string
     */
    public $message;
    /**
     * The version of the transaction.
     * @var int
     */
    public $version = 1;

    /**
     * @param float $value
     * @return $this
     */
    public function setValue(float $value): Transaction
    {
        $this->val = $value;

        return $this;
    }

    /**
     * @param string $destinationAddress
     * @return $this
     */
    public function setDestinationAddress(string $destinationAddress): Transaction
    {
        $this->dst = $destinationAddress;

        return $this;
    }

    /**
     * @param string $publicKey
     * @return $this
     */
    public function setPublicKey(string $publicKey): Transaction
    {
        $this->public_key = $publicKey;

        return $this;
    }

    /**
     * @param string $signature
     * @return $this
     */
    public function setSignature(string $signature): Transaction
    {
        $this->signature = $signature;

        return $this;
    }

    /**
     * @param string $privateKey
     * @return $this
     */
    public function setPrivateKey(string $privateKey): Transaction
    {
        $this->private_key = $privateKey;

        return $this;
    }

    /**
     * @param int $date
     * @return $this
     */
    public function setDate(int $date): Transaction
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @param string $message
     * @return $this
     */
    public function setMessage(string $message): Transaction
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @param int $version
     * @return $this
     */
    public function setVersion(int $version): Transaction
    {
        $this->version = $version;

        return $this;
    }
}
