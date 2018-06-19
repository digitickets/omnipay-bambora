<?php

namespace DigiTickets\Bambora;

use DigiTickets\Bambora\Messages\CompletePurchaseRequest;
use DigiTickets\Bambora\Messages\PurchaseRequest;
use Omnipay\Common\AbstractGateway;

class PaymentPageGateway extends AbstractGateway
{
    /**
     * Get gateway display name
     *
     * This can be used by carts to get the display name for each gateway.
     */
    public function getName()
    {
        return 'Bambora (Payment Page)';
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest(PurchaseRequest::class, $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest(CompletePurchaseRequest::class, $parameters);
    }
}