<?php

namespace Omnipay\AccentPay\Provider;

use Omnipay\Common\Exception\InvalidRequestException;

/**
 * Class QiwiProvider
 * @package Omnipay\AccentPay\Provider
 */
class QiwiProvider extends AbstractProvider
{
    /**
     * @var string
     */
    protected $path = 'qiwi';

    /**
     * @var string
     */
    protected $payoutAction = 'qiwi_payout';

    /**
     * @var int
     */
    protected $paymentGroupId = 6;

    /**
     * @param string $accountNumber
     * @return $this
     */
    public function setAccountNumber($accountNumber)
    {
        return $this->setParameter('accountNumber', $accountNumber);
    }

    /**
     * @return string|null
     */
    public function getAccountNumber()
    {
        return $this->getParameter('accountNumber');
    }

    /**
     * @return array
     * @throws InvalidRequestException
     */
    public function getPayoutData()
    {
        $this->validate(
            'accountNumber'
        );

        return array(
            'action'         => $this->getPayoutAction(),
            'account_number' => $this->getAccountNumber(),
        );
    }
}
