<?php

namespace Omnipay\AccentPay\Message;

use devcookies\SignatureGenerator;
use Omnipay\AccentPay\Provider\AbstractProvider;
use Omnipay\Common\Exception\InvalidRequestException;
use Guzzle\Http\Exception\BadResponseException;

class FetchTransactionRequest extends AbstractRequest
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
            'transactionId'
        );

        $data = array(
            'action'      => 'order_info',
            'type_id'     => 1,
            'site'        => $this->getSiteId(),
            'external_id' => $this->getTransactionId(),
        );

        $signer = new SignatureGenerator($this->getSalt());
        $data['signature'] = $signer->assemble($data);

        return $data;
    }

    /**
     * @param array $data
     *
     * @return FetchTransactionResponse
     */
    public function sendData($data)
    {
        $uri = sprintf('%s/op/json/', $this->getEndpoint());
        $headers = array(
            'Content-Type' => 'application/json',
        );

        try {
            $response = $this->httpClient->post($uri, $headers, $data)->send();
        } catch (BadResponseException $e) {
            $response = $e->getResponse();
        }

        return new FetchTransactionResponse($this, $response->json());
    }
}
