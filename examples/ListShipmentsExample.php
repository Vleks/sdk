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
# LIST SHIPMENTS
#-------------------------------------------------------------------------------

try {
    $request = new Vleks\SDK\Requests\ListShipments(array(
        'Shipment' => array(
            array('OrderID' => '-- ORDER ID --')
        )
    ));
    $result = $client->listShipments($request);

    if ($result->hasShipments()) {
        foreach ($result->getShipments() as $shipment) {
            var_dump($shipment->getShipmentID() . ':' . $shipment->getOrderID());
        }
    }
} catch (Vleks\SDK\Exceptions\ClientException $clientException) {
    var_dump($clientException->getMessage());
} catch (Vleks\SDK\Exceptions\ServiceException $serviceException) {
    var_dump($serviceException->getMessage());
}