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

    public function getApprovedPage()
    {
        return $this->getParameter('ApprovedPage');
    }

    public function getDeclinedPage()
    {
        return $this->getParameter('DeclinedPage');
    }

    public function getHashValue()
    {
        return $this->getParameter('HashValue');
    }

    public function getHashExpiry()
    {
        return $this->getParameter('HashExpiry');
    }

    public function sendData($data)
    {
error_log('sendData: '.var_export($data, true));
        return $this->response = new PurchaseResponse($this, $data);
    }

    public function getData()
    {
error_log('getData...');
        $this->validate('merchantId', 'amount');

        $data = [];
        $data['merchant_id'] = $this->getMerchantId();
        $data['trnAmount'] = $this->getTrnAmount();
        $data['trnOrderNumber'] = $this->getTrnOrderNumber();
        $data['trnType'] = $this->getTrnType();
        $data['approvedPage'] = $this->getApprovedPage();
        $data['declinedPage'] = $this->getDeclinedPage();
        $data['hashValue'] = $this->getHashValue();
        $data['hashExpiry'] = $this->getHashExpiry();

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