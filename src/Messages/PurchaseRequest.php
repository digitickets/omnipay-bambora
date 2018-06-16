<?php

namespace DigiTickets\Bambora\Messages;

use Omnipay\Common\Message\AbstractRequest;

class PurchaseRequest extends AbstractRequest
{
    public function sendData($data)
    {
error_log('sendData: '.var_export($data, true));
        return;
    }

    public function getData()
    {
error_log('getData...');
        return [];
    }
}