<?php

#-------------------------------------------------------------------------------
# INCLUDE THE CONFIGURATION FILE
#
# This file contains some default environment configuration which are used to
# ensure your examples will run.
#-------------------------------------------------------------------------------

require 'config.php';

#-------------------------------------------------------------------------------
# SETUP CLIENT
#
# Edit your credentials in config.php to use the examples.
#-------------------------------------------------------------------------------

$client = new Vleks\SDK\Client(
    VLEKS_API_PUBLIC_KEY, VLEKS_API_PRIVATE_KEY,
    VLEKS_MERCHANT_ID, VLEKS_API_CLUSTER
);

#-------------------------------------------------------------------------------
# LIST PRODUCTS
#-------------------------------------------------------------------------------

try {
    $request = new Vleks\SDK\Requests\ListProducts(array (
        'Limit' => 100
    ));
    $result = $client->listProducts($request);

    if ($result->hasProducts()) {
        foreach ($result->getProducts() as $product) {
            var_dump($product->getVleksID() . ':' . $product->getSKU() . ':' . $product->getTitle());
        }
    }
} catch (Vleks\SDK\Exceptions\ClientException $clientException) {
    var_dump($clientException->getMessage());
} catch (Vleks\SDK\Exceptions\ServiceException $serviceException) {
    var_dump($serviceException->getMessage());
}