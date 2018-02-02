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
# CHECK FEED RESULTS
#-------------------------------------------------------------------------------

try {
    $request = new Vleks\SDK\Requests\FeedResult(array (
        'Feed' => array (
            array ('RequestID' => '-- FEED REQUEST ID --'),
            array ('RequestID' => '-- FEED REQUEST ID --')
        )
    ));
    $result = $client->getFeedResult($request);

    if ($result->hasFeeds()) {
        foreach ($result->getFeeds() as $feed) {
            var_dump ($feed->getRequestID());

            if ($feed->hasResponse()) {
                foreach ($feed->getResponse() as $response) {
                    var_dump ($response->getMessage());
                }
            }
        }
    }
} catch (Vleks\SDK\Exceptions\ClientException $clientException) {
    var_dump($clientException->getMessage());
} catch (Vleks\SDK\Exceptions\ServiceException $serviceException) {
    var_dump($serviceException->getMessage());
}