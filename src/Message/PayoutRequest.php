<?php

namespace Omnipay\AccentPay\Message;

use devcookies\SignatureGenerator;
use Omnipay\AccentPay\Provider\AbstractProvider;
use Omnipay\Common\Exception\InvalidRequestException;
use Guzzle\Http\Exception\BadResponseException;

class PayoutRequest extends AbstractRequest
{
    /**
     * @var string
     */
    protected $liveEndpoint = 'https://gate.accentpay.com';

    /**
     * @var string
     */
    protected $testEndpoint = 'https://gate-sandbox.accentpay.com';

    /**
     * @param AbstractProvider $provider
     * @return $this
     */
    public function setProvider(AbstractProvider $provider)
    {
        return $this->setParameter('provider', $provider);
    }

    /**
     * @return AbstractProvider|null
     */
    public function getProvider()
    {
        return $this->getParameter('provider');
    }

    /**
     * @return array
     * @throws InvalidRequestException
     */
    public function getData()
    {
        $this->validate(
            'siteId',
            'salt',
            'transactionId',
            'amount',
            'currency',
            'description',
            'provider'
        );

        $data = array_merge(array(
            'site_id'     => $this->getSiteId(),
            'external_id' => $this->getTransactionId(),
            'amount'      => $this->getAmountInteger(),
            'currency'    => $this->getCurrency(),
            'comment'     => $this->getDescription(),
        ), $this->getProvider()->getPayoutData());

        if ($clientIp = $this->getClientIp()) {
            $data['customer_ip'] = $clientIp;
        }

        $signer = new SignatureGenerator($this->getSalt());
        $data['signature'] = $signer->assemble($data);

        return $data;
    }

    /**
     * @param array $data
     *
     * @return PayoutResponse
     */
    public function sendData($data)
    {
        $uri = sprintf('%s/%s/json/', $this->getEndpoint(), $this->getProvider()->getPath());
        $headers = array(
            'Content-Type' => 'application/json',
        );

        var_dump($uri, $data);

        try {
            $response = $this->httpClient->post($uri, $headers, $data)->send();
        } catch (BadResponseException $e) {
            $response = $e->getResponse();
        }

        return new PayoutResponse($this, $response->json());
    }
}
