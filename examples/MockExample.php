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
# The Mock Client doesn't require credentials in order to function
#-------------------------------------------------------------------------------

$client = new Vleks\SDK\Mock();

#-------------------------------------------------------------------------------
# ACCEPT ORDERS
#-------------------------------------------------------------------------------

try {
    $request = new Vleks\SDK\Requests\AcceptOrders(array(
        'Order' => array(
            array('OrderID' => '-- ORDER ID --')
        )
    ));
    $result = $client->acceptOrders($request);

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