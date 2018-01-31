<?php

namespace Omnipay\AccentPay\Provider;

use Omnipay\Common\CreditCard;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Exception\InvalidCreditCardException;

/**
 * Class CardProvider
 * @package Omnipay\AccentPay\Provider
 */
class CardProvider extends AbstractProvider
{
    /**
     * @var string
     */
    protected $path = 'card';

    /**
     * @var string
     */
    protected $payoutAction = 'payout';

    /**
     * @var int
     */
    protected $paymentGroupId = 1;

    /**
     * @param CreditCard $card
     * @return $this
     */
    public function setCard(CreditCard $card)
    {
        return $this->setParameter('card', $card);
    }

    /**
     * @return CreditCard|null
     */
    public function getCard()
    {
        return $this->getParameter('card');
    }

    /**
     * @return array
     * @throws InvalidRequestException
     * @throws InvalidCreditCardException
     */
    public function getPayoutData()
    {
        $this->validate(
            'card'
        );

        $card = $this->getCard();
        $card->validate();
        return array(
            'action'    => $this->getPayoutAction(),
            'holder'    => $card->getName(),
            'card'      => $card->getNumber(),
            'exp_month' => $card->getExpiryDate('m'),
            'exp_year'  => $card->getExpiryDate('Y'),
        );
    }
}
