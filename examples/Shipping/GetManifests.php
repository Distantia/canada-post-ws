<?php
use Distantia\CanadaPostWs\Shipping;
use Distantia\CanadaPostWs\Type\Manifest\ManifestsType;
use Distantia\CanadaPostWs\Type\Messages\MessagesType;
use Distantia\CanadaPostWs\WebService;

require_once __DIR__.'/../../vendor/autoload.php';

// Config
define('CANADA_POST_API_CUSTOMER_NUMBER', '2004381');
define('CANADA_POST_API_CONTRACT_ID', '42708517');
define('CANADA_POST_API_KEY', '6e93d53968881714:0bfa9fcb9853d1f51ee57a');

$startDate = new \DateTime('-5 days');
$endDate = new \DateTime();

// Initiate Canada Post's API
$Shipping = new Shipping([
    'api_customer_number' => CANADA_POST_API_CUSTOMER_NUMBER,
    'api_key' => CANADA_POST_API_KEY,
    'env' => WebService::ENV_DEV,
    'ssl' => true,
]);

// Send request to get manifests
$manifestsResponse = $Shipping->getManifests($startDate, $endDate);

// Output result for debug
if ($manifestsResponse instanceof ManifestsType) {
    var_dump($manifestsResponse);
} elseif ($manifestsResponse instanceof MessagesType) {
    var_dump($manifestsResponse);
} else {
    throw new \Exception('Unexpected response.');
}
