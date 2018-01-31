<?php

namespace Omnipay\AccentPay\Message;

use Omnipay\Common\Message\AbstractResponse;

class FetchTransactionResponse extends AbstractResponse
{
    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return $this->getCode() === 0;
    }

    /**
     * @return int|null
     */
    public function getCode()
    {
        return isset($this->data['code']) ? (int) $this->data['code'] : null;
    }

    /**
     * @return string|null
     */
    public function getMessage()
    {
        return isset($this->data['message']) ? $this->data['message'] : null;
    }

    /**
     * @return string|null
     */
    public function getTransactionId()
    {
        return isset($this->data['external_id']) ? $this->data['external_id'] : null;
    }

    /**
     * @return int|null
     */
    public function getAmount()
    {
        return isset($this->data['amount']) ? (int) $this->data['amount'] : null;
    }

    /**
     * @return string|null
     */
    public function getCurrency()
    {
        return isset($this->data['currency']) ? $this->data['currency'] : null;
    }
}
