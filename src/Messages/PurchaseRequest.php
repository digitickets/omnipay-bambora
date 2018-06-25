<?php

namespace DigiTickets\Bambora\Messages;

use Omnipay\Common\Message\AbstractRequest;

class PurchaseRequest extends AbstractRequest
{
    /**
     * @var string There is only 1 endpoint, and it doesn't matter whether it's a live transaction or a test one.
     */
    protected $endpoint = 'https://web.na.bambora.com/scripts/payment/payment.asp';

    public function getMerchantId()
    {
        return $this->getParameter('merchantId');
    }

    public function setMerchantId($value)
    {
        return $this->setParameter('merchantId', $value);
    }

    public function getTrnAmount()
    {
        return $this->getAmount();
    }

    public function getTrnOrderNumber()
    {
        return $this->getTransactionId();
    }

    public function getTrnType()
    {
        return 'P';
    }

    public function getHashKey()
    {
        return $this->getParameter('hashKey');
    }

    public function setHashKey($value)
    {
        return $this->setParameter('hashKey', $value);
    }

    public function getHashExpiryMinutes()
    {
        return $this->getParameter('hashExpiryMinutes');
    }

    public function setHashExpiryMinutes($value)
    {
        if ($value != (int) $value || $value < 1) {
            throw new \InvalidArgumentException('Hash expiry minutes must be a positive integer');
        }

        return $this->setParameter('hashExpiryMinutes', $value);
    }

    protected function calculateHashExpiryDate()
    {
        // This is my best guess for the correct timezone to use.
        $expiryDate = new \DateTime('now', new \DateTimeZone('America/Vancouver'));
        $expiryDate = $expiryDate->add(new \DateInterval(sprintf('PT%dM', $this->getHashExpiryMinutes())));

        // Format is YYYYMMDDHH24MI.
        return $expiryDate->format('YmdHi');
    }

    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data);
    }

    public function getData()
    {
        $this->validate('merchantId', 'amount');

        $data = [];
        $data['merchant_id'] = $this->getMerchantId();
        $data['trnAmount'] = $this->getTrnAmount();
        $data['trnOrderNumber'] = $this->getTrnOrderNumber();
        $data['trnType'] = $this->getTrnType();
        $data['approvedPage'] = $this->getReturnUrl();
        $data['declinedPage'] = $this->getNotifyUrl() ?: $this->getReturnUrl();

        // If they are using a hash key and there's an expiry interval, then calculate and set the hash expiry date.
        if ($this->getHashKey() && $this->getHashExpiryMinutes()) {
            $data['hashExpiry'] = $this->calculateHashExpiryDate();
        }

        if ($this->getCard()) {
            $data['ordName'] = $this->getCard()->getName();
            $data['ordEmailAddress'] = $this->getCard()->getEmail();
            $data['ordAddress1'] = $this->getCard()->getAddress1();
            $data['ordAddress2'] = $this->getCard()->getAddress2();
            $data['ordPostalCode'] = $this->getCard()->getPostcode();
        }

        return $data;
    }

    public function getEndpoint()
    {
        return $this->endpoint;
    }
}
