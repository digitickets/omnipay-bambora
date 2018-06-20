<?php

namespace DigiTickets\Bambora\Messages;

use Omnipay\Common\Message\AbstractResponse;

class CompletePurchaseResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        return isset($this->data['trnApproved']) && '1' === $this->data['trnApproved'];
    }

    public function isCancelled()
    {
        return isset($this->data['trnApproved']) && '1' !== $this->data['trnApproved'];
    }

    public function getTransactionReference()
    {
        return isset($this->data['trnId']) ? $this->data['trnId'] : null;
    }

    public function getMessage()
    {
        return isset($this->data['messageText']) ? $this->data['messageText'] : null;
    }

    public function getAuthCode()
    {
        return isset($this->data['authCode']) ? $this->data['authCode'] : null;
    }
}
