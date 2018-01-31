# Vleks SDK for PHP

## Installation

It's recommended that you use [Composer](https://getcomposer.org/) to install the SDK.

```
composer require vleks/sdk
```

This will install the Vleks SDK.<br />
PHP 5.6 or newer is required.

## Usage

Create an index.php file with the following contents:

```php
<?php
use Vleks\SDK\Client;
use Vleks\SDK\Requests\ListProducts as ListProductsRequest;
use Vleks\SDK\Exceptions\ClientException;
use Vleks\SDK\Exceptions\ServiceException;

require 'vendor/autoload.php';

$publicKey  = '-- YOUR PUBLIC KEY --';
$privateKey = '-- YOUR PRIVATE KEY --';
$merchantId = '-- YOUR MERCHANT ID --';
$clusterUrl = '-- YOUR CLUSTER URL --'

$vleksClient = new Client($publicKey, $privateKey, $merchantId, $clusterUrl);

try {
    $request = new ListProductsRequest();
    $result  = $vleksClient->listProducts($request);

    print_r ($result->getProducts());
} catch (ClientException $clientException) {
    echo 'A Client error occurred: ' . $clientException->getMessage();
} catch (ServiceException $servicException) {
    echo 'A Service error occurred: ' . $servicException->getMessage();
}
```

See the contents of [the examples directory](examples/) for more information.

## Tests

To execute the test suite, you'll need PHPUnit.

```
$ phpunit
```

## License

The Vleks SDK for PHP is licensed under the MIT licence.<br />
See the [license file](LICENCE.md) for more information.
