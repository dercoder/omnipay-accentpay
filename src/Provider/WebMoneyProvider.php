<?php

namespace Omnipay\AccentPay\Provider;

use Omnipay\Common\Exception\InvalidRequestException;

/**
 * Class QiwiProvider
 *
 * @package Omnipay\AccentPay\Provider
 */
class WebMoneyProvider extends AbstractProvider
{
    /**
     * @var string
     */
    protected $path = 'webmoney';

    /**
     * @var string
     */
    protected $payoutAction = 'wmpayout';

    /**
     * @var int
     */
    protected $paymentGroupId = 2;

    /**
     * @param string $customerPurse
     *
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
     * @param string $paymentTypeId
     *
     * @return $this
     */
    public function setPaymentTypeId($paymentTypeId)
    {
        return $this->setParameter('paymentTypeId', $paymentTypeId);
    }

    /**
     * @return string|null
     */
    public function getPaymentTypeId()
    {
        return $this->getParameter('paymentTypeId');
    }

    /**
     * @return array
     * @throws InvalidRequestException
     */
    public function getPayoutData()
    {
        $this->validate(
            'customerPurse',
            'paymentTypeId'
        );

        return array(
            'action'          => $this->getPayoutAction(),
            'customer_purse'  => $this->getCustomerPurse(),
            'payment_type_id' => $this->getPaymentTypeId(),
        );
    }
}
