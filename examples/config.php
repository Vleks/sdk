<?php

#-------------------------------------------------------------------------------
# ERROR REPORTING
#-------------------------------------------------------------------------------

ini_set ('error_reporting', E_ALL);
ini_set ('display_errors', 'On');
ini_set ('log_errors', 'On');
ini_set ('error_log', 'php-errors.log');

#-------------------------------------------------------------------------------
# ENVIRONMENT
#-------------------------------------------------------------------------------

date_default_timezone_set('Europe/Amsterdam');

#-------------------------------------------------------------------------------
# AUTOLOADING
#-------------------------------------------------------------------------------

require realpath(dirname(__DIR__)) . '/vendor/autoload.php';

#-------------------------------------------------------------------------------
# SETUP VLEKS.COM API PARAMETERS
#-------------------------------------------------------------------------------

define('VLEKS_MERCHANT_ID', '-- YOUR MERCHANT ID --');

define('VLEKS_API_CLUSTER', '-- YOUR CLUSTER URL --');
define('VLEKS_API_PUBLIC_KEY', '-- YOUR PUBLIC KEY --');
define('VLEKS_API_PRIVATE_KEY', '-- YOUR PRIVATE KEY --');
