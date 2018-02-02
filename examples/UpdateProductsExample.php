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
# ADD/UPDATE PRODUCTS
#-------------------------------------------------------------------------------

try {
    $request = new Vleks\SDK\Requests\UpdateProducts(array(
        'Product' => array(
            array(
                'SKU'             => 'SDK.P.001',
                'EANList'         => array (
                    'EAN' => array (
                        '1966819785004',
                        '1966819785011',
                        '1966819785028',
                        '1966819785035',
                        '1966819785042',
                        '1966819785059'
                    )
                ),
                'Condition'       => 'NEW',
                'Reference'       => '4922001',
                'MinDeliveryTime' => 24,
                'MaxDeliveryTime' => 48,
                'PurchasePrice'   => array (
                    'Currency' => Vleks\SDK\Enumerables\Currency::EUR,
                    'Amount'   => 12.95
                ),
                'MinPrice'        => array (
                    'Currency' => Vleks\SDK\Enumerables\Currency::EUR,
                    'Amount'   => 23
                ),
                'MaxPrice'        => array (
                    'Currency' => Vleks\SDK\Enumerables\Currency::EUR,
                    'Amount'   => 42.95
                ),
                'SalePrice'       => array (
                    'Currency' => 'EUR',
                    'Amount'   => 25.99
                ),
                'Title'           => 'Opeflex SDK P001',
                'Brand'           => 'Opeflex',
                'ItemType'        => 'Fictive Product',
                'Description'     => '<p>
                    <strong>Lorem ipsum dolor sit amet<strong><br />
                    Consectetur adipiscing elit. Pellentesque et justo risus. Etiam luctus massa sit amet lorem molestie consectetur.
                </p>',
                'Active'          => true,
                'TaxPercentage'   => 21.0,
                'Attributes'      => array (
                    'Attribute' => array (
                        array (
                            'Property' => 'adult',
                            'Value'    => 'no'
                        ),
                        array (
                            'Property' => 'product_link',
                            'Value'    => 'http://www.domain.ltd/product/sdk-p-001.html'
                        ),
                        array (
                            'Property' => 'product_image',
                            'Value'    => 'https://picsum.photos/1000/1000'
                        ),
                        array (
                            'Property' => 'additional_product_image',
                            'Value'    => 'https://picsum.photos/g/1000/1000'
                        ),
                        array (
                            'Property' => 'usp_1',
                            'Value'    => 'Phasellus eu blandit nisl. Sed.'
                        ),
                        array (
                            'Property' => 'usp_2',
                            'Value'    => 'Suspendisse potenti. Vestibulum molestie urna.'
                        ),
                        array (
                            'Property' => 'usp_3',
                            'Value'    => 'Donec egestas felis quis velit.'
                        ),
                        array (
                            'Property' => 'usp_4',
                            'Value'    => 'Suspendisse eu tincidunt ante. Ut.'
                        ),
                        array (
                            'Property' => 'usp_5',
                            'Value'    => 'Praesent ultrices eleifend interdum. Proin.'
                        )
                    )
                ),
                'Stock'           => array (
                    'StockLocation' => array (
                        array (
                            'LocationID'      => '-- LOCATION ID --',
                            'QuantityInStock' => 2
                        )
                    )
                )
            )
        )
    ));
    $result = $client->updateProducts($request);

    if ($result->hasFeeds()) {
        foreach ($result->getFeeds() as $feed) {
            var_dump($feed->getRequestID());
        }
    }
} catch (Vleks\SDK\Exceptions\ClientException $clientException) {
    var_dump($clientException->getMessage());
} catch (Vleks\SDK\Exceptions\ServiceException $serviceException) {
    var_dump($serviceException->getMessage());
}