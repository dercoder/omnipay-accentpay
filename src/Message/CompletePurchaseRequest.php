<?php

namespace Omnipay\AccentPay\Message;

use devcookies\SignatureGenerator;
use Omnipay\Common\Exception\InvalidRequestException;

class CompletePurchaseRequest extends AbstractRequest
{
    /**
     * @return array
     * @throws InvalidRequestException
     */
    public function getData()
    {
        $data = $this->httpRequest->request->all();

        if (!isset($data['signature'])) {
            throw new InvalidRequestException('Signature missing');
        }

        $signature = $data['signature'];
        unset($data['signature']);

        $signer = new SignatureGenerator($this->getSalt());

        if ($signer->assemble($data) !== $signature) {
            throw new InvalidRequestException('Invalid signature');
        }

        return $data;
    }

    /**
     * @param array $data
     *
     * @return CompletePurchaseResponse
     */
    public function sendData($data)
    {
        return new CompletePurchaseResponse($this, $data);
    }
}
