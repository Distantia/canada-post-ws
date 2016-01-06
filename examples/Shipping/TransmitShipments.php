<?php
use Distantia\CanadaPostWs\Shipping;
use Distantia\CanadaPostWs\Type\Manifest\AddressDetailsType;
use Distantia\CanadaPostWs\Type\Manifest\GroupIdListType;
use Distantia\CanadaPostWs\Type\Manifest\ManifestAddressType;
use Distantia\CanadaPostWs\Type\Manifest\ManifestsType;
use Distantia\CanadaPostWs\Type\Manifest\ShipmentTransmitSetType;
use Distantia\CanadaPostWs\Type\Messages\MessagesType;
use Distantia\CanadaPostWs\WebService;

require_once __DIR__.'/../../vendor/autoload.php';

// Config
define('CANADA_POST_API_CUSTOMER_NUMBER', '2004381');
define('CANADA_POST_API_CONTRACT_ID', '42708517');
define('CANADA_POST_API_KEY', '6e93d53968881714:0bfa9fcb9853d1f51ee57a');

// Shipment object to create
$ShipmentTransmitSet = new ShipmentTransmitSetType();

$GroupIds = new GroupIdListType();
$GroupIds->setGroupId('4326432');

$ShipmentTransmitSet->addGroupId($GroupIds);
$ShipmentTransmitSet->setRequestedShippingPoint('H2B1A0');
$ShipmentTransmitSet->setCpcPickupIndicator(true);
$ShipmentTransmitSet->setDetailedManifests(true);
$ShipmentTransmitSet->setMethodOfPayment('Account');

$ManifestAddress = new ManifestAddressType();
$ManifestAddress->setManifestCompany('MajorShop');
$ManifestAddress->setPhoneNumber('514 829 5879');

$AddressDetails = new AddressDetailsType();
$AddressDetails->setAddressLine1('1230 Tako RD.');
$AddressDetails->setCity('Ottawa');
$AddressDetails->setProvState('ON');
$AddressDetails->setCountryCode('CA');
$AddressDetails->setPostalZipCode('H2B1A0');

$ManifestAddress->setAddressDetails($AddressDetails);

$ShipmentTransmitSet->setManifestAddress($ManifestAddress);

// Initiate Canada Post's API
$Shipping = new Shipping([
    'api_customer_number' => CANADA_POST_API_CUSTOMER_NUMBER,
    'api_key' => CANADA_POST_API_KEY,
    'env' => WebService::ENV_DEV,
    'ssl' => true,
]);

// Send request to transmit shipments
$transmitShipmentsResponse = $Shipping->transmitShipments($ShipmentTransmitSet);

// Output result for debug
if ($transmitShipmentsResponse instanceof ManifestsType) {
    var_dump($transmitShipmentsResponse);
} elseif ($transmitShipmentsResponse instanceof MessagesType) {
    var_dump($transmitShipmentsResponse);
} else {
    throw new \Exception('Unexpected response.');
}
