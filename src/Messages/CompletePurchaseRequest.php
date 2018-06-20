<?php

namespace DigiTickets\Bambora\Messages;

class CompletePurchaseRequest extends PurchaseRequest
{
    public function getData()
    {
        // Other requests seem to return $this->httpRequest->request->all(), but I just couldn't get it to work.
        return $this->httpRequest->query->all();
    }

    public function sendData($data)
    {
        return $this->response = new CompletePurchaseResponse($this, $data);
    }
}
