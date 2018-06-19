<?php

namespace DigiTickets\Bambora\Messages;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    public function isSuccessful()
    {
        return false;
    }

    public function isRedirect()
    {
        return true;
    }

    public function getRedirectUrl()
    {
        $params = http_build_query($this->data);

        $params .= $this->buildHashParameter($params);

        return $this->getRequest()->getEndpoint().'?'.$params;
    }

    public function getRedirectMethod()
    {
        return 'GET';
    }

    public function getRedirectData()
    {
        return null;
    }

    /**
     * @param string $params
     *
     * @return null|string Null if there is no hash key; an md5 string otherwise
     */
    protected function buildHashParameter(string $params)
    {
        $hashKey = $this->getRequest()->getHashKey();
        if (empty($hashKey)) {
            return null;
        }

        // Note, there are no characters between the params query string and the hash key in the call to md5.
        return '&hashValue='.md5($params.$hashKey);
    }
}
