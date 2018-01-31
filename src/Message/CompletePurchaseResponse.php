<?php

namespace Omnipay\AccentPay\Message;

use Omnipay\Common\Message\AbstractResponse;

class CompletePurchaseResponse extends AbstractResponse
{
    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return $this->getCode() === 4;
    }

    /**
     * @return int|null
     */
    public function getCode()
    {
        return $this->getStatusId();
    }

    /**
     * @return string|null
     */
    public function getMessage()
    {
        switch ($this->getCode()) {
            case 2:
                return 'External processing';
            case 3:
                return 'Awaiting confirmation';
            case 4:
                return 'Success';
            case 5:
                return 'Void';
            case 6:
                return 'Processor decline';
            case 7:
                return 'Fraudstop decline';
            case 8:
                return 'MPI decline';
            case 10:
                return 'System failure';
            case 11:
                return 'Unsupported protocol operation';
            case 12:
                return 'Protocol configuration error';
            case 13:
                return 'Transaction is expired';
            case 14:
                return 'Transaction rejected by user';
            case 15:
                return 'Internal error';
            default:
                return null;
        }
    }

    /**
     * @return int|null
     */
    public function getTypeId()
    {
        return isset($this->data['type_id']) ? (int) $this->data['type_id'] : null;
    }

    /**
     * @return int|null
     */
    public function getStatusId()
    {
        return isset($this->data['status_id']) ? (int) $this->data['status_id'] : null;
    }

    /**
     * @return string|null
     */
    public function getTransactionId()
    {
        return isset($this->data['external_id']) ? $this->data['external_id'] : null;
    }

    /**
     * @return string|null
     */
    public function getTransactionReference()
    {
        return isset($this->data['transaction_id']) ? $this->data['transaction_id'] : null;
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

    /**
     * @return int|null
     */
    public function getRealAmount()
    {
        return isset($this->data['real_amount']) ? (int) $this->data['real_amount'] : null;
    }

    /**
     * @return string|null
     */
    public function getRealCurrency()
    {
        return isset($this->data['real_currency']) ? $this->data['real_currency'] : null;
    }
}
