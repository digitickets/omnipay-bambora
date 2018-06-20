# omnipay-bambora

**Bambora driver for the Omnipay PHP payment processing library**

Omnipay implementation of the Bambora payment gateway.

It is based on the TD implementation of Bambora.

[![Build Status](https://travis-ci.org/digitickets/omnipay-bambora.png?branch=master)](https://travis-ci.org/digitickets/omnipay-bambora)
[![Latest Stable Version](https://poser.pugx.org/digitickets/omnipay-bambora/version.png)](https://packagist.org/packages/omnipay/bambora)
[![Total Downloads](https://poser.pugx.org/digitickets/omnipay-bambora/d/total.png)](https://packagist.org/packages/digitickets/omnipay-bambora)

This driver supports the Bambora payment page. Transaction information is sent via a URL.

## Installation

**Important: Driver requires [PHP's Intl extension](http://php.net/manual/en/book.intl.php) to be installed.**

The Verifone Omnipay driver is installed via [Composer](http://getcomposer.org/). To install, simply add it
to your `composer.json` file:

```json
{
    "require": {
        "digitickets/omnipay-bambora": "~1.0"
    }
}
```

And run composer to update your dependencies:

    $ curl -s http://getcomposer.org/installer | php
    $ php composer.phar update

## What's Included

This driver handles transaction being processed by the Payment Page of Bambora.

You can pass in a hash key, which effectively switches on the hashValue parameter in the URL to Payment Page.

If you pass in a hash key, you can also pass in an expiry TTL, which is an integer number of minutes.
If present, it will add the hashExpiry parameter to the above URL.

## What's Not Included

It does not use the Bambora API for making payments.

It does not handle refunds.

## Basic Usage

For general Omnipay usage instructions, please see the main [Omnipay](https://github.com/omnipay/omnipay)
repository.

## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you believe you have found a bug in this driver, please report it using the [GitHub issue tracker](https://github.com/digitickets/omnipay-bambora/issues),
or better yet, fork the library and submit a pull request.
