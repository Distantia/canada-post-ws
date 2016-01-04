<?php
use Distantia\CanadaPostWs\Shipping;
use Distantia\CanadaPostWs\Type\Messages\MessagesType;
use Distantia\CanadaPostWs\Type\Shipment\ShipmentInfoType;
use Distantia\CanadaPostWs\WebService;

require_once __DIR__.'/../../vendor/autoload.php';

// Config
define('CANADA_POST_API_CUSTOMER_NUMBER', '2004381');
define('CANADA_POST_API_CONTRACT_ID', '42708517');
define('CANADA_POST_API_KEY', '6e93d53968881714:0bfa9fcb9853d1f51ee57a');

$shipmentId = '90011451428208409';

// Initiate Canada Post's API
$Shipping = new Shipping([
    'api_customer_number' => CANADA_POST_API_CUSTOMER_NUMBER,
    'api_key' => CANADA_POST_API_KEY,
    'env' => WebService::ENV_DEV,
    'ssl' => true,
]);

// Send request to get shipment
$shipmentResponse = $Shipping->getShipment($shipmentId);

// Output result for debug
if ($shipmentResponse instanceof ShipmentInfoType) {
    var_dump($shipmentResponse);
    $Links = $shipmentResponse->getLinks();

    if ($Links) {
        foreach ($Links as $Link) {
           var_dump($Link->processLink(CANADA_POST_API_KEY, true));
        }
    }
} elseif ($shipmentResponse instanceof MessagesType) {
    var_dump($shipmentResponse);
} else {
    throw new \Exception('Unexpected response.');
}
