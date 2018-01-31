<?php

namespace Omnipay\AccentPay\Message;

use devcookies\SignatureGenerator;
use Omnipay\Common\Exception\InvalidRequestException;

class PurchaseRequest extends AbstractRequest
{
    /**
     * @var string
     */
    protected $liveEndpoint = 'https://terminal.accentpay.com';

    /**
     * @var string
     */
    protected $testEndpoint = 'https://terminal-sandbox.accentpay.com';

    /**
     * @param bool $iFrame
     * @return $this
     */
    public function setIFrame($iFrame)
    {
        return $this->setParameter('iFrame', $iFrame);
    }

    /**
     * @return bool|null
     */
    public function getIFrame()
    {
        return $this->getParameter('iFrame');
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
            'currency'
        );

        $data = array(
            'site_id'     => $this->getSiteId(),
            'external_id' => $this->getTransactionId(),
            'amount'      => $this->getAmountInteger(),
            'currency'    => $this->getCurrency(),
        );

        if ($description = $this->getDescription()) {
            $data['description'] = $description;
        }

        if ($returnUrl = $this->getReturnUrl()) {
            $data['success_url'] = $returnUrl;
        }

        if ($cancelUrl = $this->getCancelUrl()) {
            $data['decline_url'] = $cancelUrl;
        }

        if (!is_null($iFrame = $this->getIFrame())) {
            $data['iframe'] = $iFrame;
        }

        $signer = new SignatureGenerator($this->getSalt());
        $data['signature'] = $signer->assemble($data);

        return $data;
    }

    /**
     * @param array $data
     * @return PurchaseResponse
     */
    public function sendData($data)
    {
        return new PurchaseResponse($this, $data);
    }
}
