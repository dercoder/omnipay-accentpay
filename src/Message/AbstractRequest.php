<?php

namespace Omnipay\AccentPay\Message;

/**
 * Class AbstractRequest
 * @package Omnipay\AccentPay\Message
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    /**
     * @var string
     */
    protected $liveEndpoint;

    /**
     * @var string
     */
    protected $testEndpoint;

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
     * @return string
     */
    public function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }
}
