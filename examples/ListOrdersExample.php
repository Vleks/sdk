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
# LIST ORDERS
#-------------------------------------------------------------------------------

try {
    $request = new Vleks\SDK\Requests\ListOrders();
    $result = $client->listOrders($request);

    if ($result->hasOrders()) {
        foreach ($result->getOrders() as $order) {
            echo 'Order ID: ' . $order->getOrderID() . "\n";
            echo 'Status:   ' . $order->getStatus() . "\n";

            if ($order->hasOrderLines()) {
                echo "\n" . 'Orderline(s):' . "\n";

                $orderLines = $order->getOrderLines();

                foreach ($orderLines->getOrderLine() as $orderLine) {
                    echo '#' . $orderLine->getOrderLineID() . ' (' . $orderLine->getQuantityOrdered() . 'x - ' . $orderLine->getTitle() . ')' . "\n";
                }
            }

            echo "\n----------------------------\n\n";
        }
    }
} catch (Vleks\SDK\Exceptions\ClientException $clientException) {
    var_dump($clientException->getMessage());
} catch (Vleks\SDK\Exceptions\ServiceException $serviceException) {
    var_dump($serviceException->getMessage());
}