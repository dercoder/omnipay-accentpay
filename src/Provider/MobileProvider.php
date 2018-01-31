<?php

namespace Omnipay\AccentPay\Provider;

use Omnipay\Common\Exception\InvalidRequestException;

/**
 * Class MobileProvider
 * @package Omnipay\AccentPay\Provider
 */
class MobileProvider extends AbstractProvider
{
    /**
     * @var string
     */
    protected $path = 'mobile';

    /**
     * @var string
     */
    protected $payoutAction = 'mobile_payout';

    /**
     * @var int
     */
    protected $paymentGroupId = 7;

    /**
     * @param string $phone
     * @return $this
     */
    public function setPhone($phone)
    {
        return $this->setParameter('phone', $phone);
    }

    /**
     * @return string|null
     */
    public function getPhone()
    {
        return $this->getParameter('phone');
    }

    /**
     * @return array
     * @throws InvalidRequestException
     */
    public function getPayoutData()
    {
        $this->validate(
            'phone'
        );

        return array(
            'action' => $this->getPayoutAction(),
            'phone'  => $this->getPhone(),
        );
    }
}
