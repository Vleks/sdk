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
# ADD SHIPMENT TO ORDER
#-------------------------------------------------------------------------------

try {
    $request = new Vleks\SDK\Requests\AddShipments(array (
        'Shipment' => array (
            array (
                'OrderID'    => '-- ORDER ID --',
                'Transport'  => array (
                    'TransporterCode' => Vleks\SDK\Enumerables\Transporter::DHL,
                    'TrackAndTrace'   => '-- TRACK AND TRACE CODE --'
                ),
                'Address'    => array (
                    'Firstname'   => '-- FIRSTNAME --',
                    'Surname'     => '-- SURNAME --',
                    'StreetName'  => '-- STREETNAME --',
                    'HouseNumber' => '-- HOUSENUMBER --',
                    'PostalCode'  => '-- POSTALCODE --',
                    'City'        => '-- CITY --',
                    'CountryCode' => Vleks\SDK\Enumerables\CountryCode::NL
                ),
                'OrderLines' => array (
                    'OrderLine' => array (
                        array (
                            'OrderLineID'     => '-- ORDERLINE ID --',
                            'QuantityShipped' => 1
                        )
                    )
                )
            )
        )
    ));
    $result = $client->addShipments($request);

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