<?php

namespace Omnipay\AccentPay\Provider;

use Omnipay\Common\Exception\InvalidRequestException;

/**
 * Class YandexMoneyProvider
 * @package Omnipay\AccentPay\Provider
 */
class YandexMoneyProvider extends AbstractProvider
{
    /**
     * @var string
     */
    protected $path = 'yandex';

    /**
     * @var string
     */
    protected $payoutAction = 'ym_payout';

    /**
     * @var int
     */
    protected $paymentGroupId = 3;

    /**
     * @param string $customerPurse
     * @return $this
     */
    public function setCustomerPurse($customerPurse)
    {
        return $this->setParameter('customerPurse', $customerPurse);
    }

    /**
     * @return string|null
     */
    public function getCustomerPurse()
    {
        return $this->getParameter('customerPurse');
    }

    /**
     * @return array
     * @throws InvalidRequestException
     */
    public function getPayoutData()
    {
        $this->validate(
            'customerPurse'
        );

        return array(
            'action'         => $this->getPayoutAction(),
            'customer_purse' => $this->getCustomerPurse(),
        );
    }
}
