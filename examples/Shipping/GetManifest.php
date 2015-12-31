<?php
use Distantia\CanadaPostWs\Shipping;
use Distantia\CanadaPostWs\Type\Manifest\ManifestType;
use Distantia\CanadaPostWs\Type\Messages\MessagesType;
use Distantia\CanadaPostWs\WebService;

require_once __DIR__.'/../../vendor/autoload.php';

// Config
define('CANADA_POST_API_CUSTOMER_NUMBER', '2004381');
define('CANADA_POST_API_CONTRACT_ID', '42708517');
define('CANADA_POST_API_KEY', '6e93d53968881714:0bfa9fcb9853d1f51ee57a');

$manifestId = '92021451409891971';

// Initiate Canada Post's API
$Shipping = new Shipping([
    'api_customer_number' => CANADA_POST_API_CUSTOMER_NUMBER,
    'api_key' => CANADA_POST_API_KEY,
    'env' => WebService::ENV_DEV,
    'ssl' => true,
]);

// Send request to get manifests
$manifestResponse = $Shipping->getManifest($manifestId);

// Output result for debug
if ($manifestResponse instanceof ManifestType) {
    var_dump($manifestResponse);
} elseif ($manifestResponse instanceof MessagesType) {
    var_dump($manifestResponse);
} else {
    throw new \Exception('Unexpected response.');
}
