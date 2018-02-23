<?php

namespace Omnipay\AccentPay;

use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\AccentPay\Message\PurchaseRequest;
use Omnipay\AccentPay\Message\CompletePurchaseRequest;
use Omnipay\AccentPay\Message\PayoutRequest;

/**
 * Class Gateway
 * @package Omnipay\AccentPay
 */
class Gateway extends AbstractGateway
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'AccentPay';
    }

    /**
     * @return array
     */
    public function getDefaultParameters()
    {
        return array(
            'siteId'   => '',
            'salt'     => '',
            'testMode' => false,
        );
    }

    /**
     * Get AccentPay Site Id.
     *
     * @return string
     */
    public function getSiteId()
    {
        return $this->getParameter('siteId');
    }

    /**
     * Set AccentPay Site Id.
     *
     * @param string $siteId
     *
     * @return $this
     */
    public function setSiteId($siteId)
    {
        return $this->setParameter('siteId', $siteId);
    }

    /**
     * Get AccentPay Salt.
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->getParameter('salt');
    }

    /**
     * Set AccentPay Salt.
     *
     * @param string $salt
     *
     * @return $this
     */
    public function setSalt($salt)
    {
        return $this->setParameter('salt', $salt);
    }

    /**
     * @param array $parameters
     *
     * @return AbstractRequest|PurchaseRequest
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\AccentPay\Message\PurchaseRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return AbstractRequest|CompletePurchaseRequest
     */
    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\AccentPay\Message\CompletePurchaseRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return AbstractRequest|PayoutRequest
     */
    public function payout(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\AccentPay\Message\PayoutRequest', $parameters);
    }
}
