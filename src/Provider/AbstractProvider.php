<?php

namespace Omnipay\AccentPay\Provider;

use Symfony\Component\HttpFoundation\ParameterBag;
use Omnipay\Common\Exception\InvalidRequestException;

/**
 * Class AbstractProvider
 * @package Omnipay\AccentPay\Provider
 */
abstract class AbstractProvider
{
    /**
     * @var ParameterBag
     */
    protected $parameters;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var string
     */
    protected $payoutAction;

    /**
     * @var int
     */
    protected $paymentGroupId;

    /**
     * AbstractProvider constructor.
     */
    public function __construct()
    {
        $this->parameters = new ParameterBag();
    }

    /**
     * Get all parameters as an associative array.
     *
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters->all();
    }

    /**
     * Set a single parameter.
     *
     * @param string $key   The parameter key
     * @param mixed  $value The value to set
     * @return AbstractProvider|$this Provides a fluent interface
     */
    protected function setParameter($key, $value)
    {
        $this->parameters->set($key, $value);
        return $this;
    }

    /**
     * Get a single parameter.
     *
     * @param string $key The parameter key
     * @return mixed
     */
    protected function getParameter($key)
    {
        return $this->parameters->get($key);
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getPayoutAction()
    {
        return $this->payoutAction;
    }

    /**
     * @return int
     */
    public function getPaymentGroupId()
    {
        return $this->paymentGroupId;
    }

    /**
     * @return array
     */
    abstract public function getPayoutData();

    /**
     * Validate the request.
     *
     * This method is called internally by gateways to avoid wasting time with an API call
     * when the request is clearly invalid.
     *
     * @param string ... a variable length list of required parameters
     * @throws InvalidRequestException
     */
    public function validate()
    {
        foreach (func_get_args() as $key) {
            $value = $this->parameters->get($key);
            if (!isset($value)) {
                throw new InvalidRequestException("The $key parameter is required");
            }
        }
    }
}
